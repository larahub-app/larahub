<?php

namespace App\Jobs;

use App\Models\Package;
use App\Models\User;
use App\Services\GitHub;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class ProcessSubmittedPackage implements ShouldQueue
{
    use Queueable;

    protected $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg'];

    /**
     * Create a new job instance.
     */
    public function __construct(protected Package $package)
    {
        //
    }

    public function handle(GitHub $github): void
    {
        $repoUrlParts = explode('/', $this->package->repo_url);

        // we need to validate the parts of the url
        if (count($repoUrlParts) !== 5) {
            // parts should be: 0) https, 1) github.com, 2) username, 3) repo-name, 4) null or extra parts
            throw new \Exception('Invalid repo url');
        }

        // we need to extract the username from the repo url
        $username = $repoUrlParts[3];

        // we need to extract the repo name from the repo url
        $repoName = $repoUrlParts[4];

        $repo = $github->repo($username, $repoName);

        $user = User::where('username', $username)->first();

        $developer = $github->user($username);

        if (! $user) {
            $user = User::create([
                'username' => Str::slug($developer->username),
                'name' => $developer->name,
                'email' => $developer->email,
                'avatar' => $developer->avatar,
                'bio' => $developer->bio,
                'website' => $developer->website,
                'auth_provider' => null,
                'auth_token' => null,
                'auth_type' => 'user',
                'laravel_employee' => false,
                'unclaimed' => true,
                'claimed_at' => null,
                'meta' => json_encode($developer->meta),
            ]);
        }

        $this->package->update([
            'user_id' => $user->id,
            'name' => $repo->name,
            'vendor' => $username,
            'display_name' => $repo->name,
            'description' => $repo->description,
            'official' => ($username === 'laravel'),
            'website' => $repo->homepage,
            'stars_count' => $repo->stargazers_count,
            'last_synced_at' => now(),
            'default_branch' => $repo->default_branch,
            'processed_at' => now(),
        ]);

        $readme = $this->parseReadme($github->readme($username, $repoName));

        $this->package->update([
            'parsed_readme' => $readme,
            'readme_last_parsed_at' => now(),
        ]);
    }

    protected function parseReadme(string $readme): string
    {
        // todo: parse the readme and rewrite urls to be relative to the package url
        // when we take it in, it will be in markdown format
        $readme = $this->replaceImageUrls($readme);

        $readme = Markdown::convert($readme)->getContent();

        $readme = $this->removeAnchors($readme);

        // we need to rewrite the urls to be relative to the package url
        return $readme;
    }

    protected function removeAnchors(string $readme): string
    {
        // remove all anchor tags with class="anchor", replace with an empty string
        // this is to remove the anchor links that github adds to the readme
        // @source https://github.dev/tighten/novapackages
        return preg_replace('/<a .*?class=\"anchor\".*?>.*?<\/a>/i', '', $readme);
    }

    protected function replaceImageUrls(string $markdown): string
    {
        // Look for all of relative url's with valid image types in the markdown and noamalize them with fully
        // qualified url's using the package repo url
        $regex = $this->imageRegexPatterns();

        return preg_replace($regex, '[$1]('.$this->package->repo_url.'/raw/'.$this->package->default_branch.'/'.'$2'.')', $markdown);
    }

    public function imageRegexPatterns()
    {
        return array_map(function ($extension) {
            return '/\[(.*?)\]\(((?!http).*?\.'.$extension.')\)/i';
        }, $this->imageExtensions);
    }
}
