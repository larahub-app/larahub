<?php

namespace App\Services;

use App\DTO\GitHubUser;
use App\DTO\Repository;
use Github\Api\Repo;
use Github\Api\User;
use Github\Client;

class GitHub
{
    public function __construct(protected Client $client)
    {
        //
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function repo(string $username, string $repoName): Repository
    {
        /** @var Repo $api */
        $api = $this->client()->api('repo');

        $repo = $api->show($username, $repoName);

        return new Repository(
            $repo['id'],
            $repo['name'],
            $repo['full_name'],
            $repo['private'],
            $repo['html_url'],
            $repo['description'] ?? null,
            $repo['fork'],
            $repo['contributors_url'],
            $repo['homepage'],
            $repo['forks_count'],
            $repo['stargazers_count'],
            $repo['open_issues_count'],
            $repo['is_template'],
            $repo['topics'],
            $repo['archived'],
            $repo['default_branch'],
        );
    }

    public function user(string $username): GitHubUser
    {
        /** @var User $api */
        $api = $this->client()->api('user');

        $user = $api->show($username);

        $twitter = $user['twitter_username'] ? 'https://x.com/'.$user['twitter_username'] : null;

        return new GitHubUser(
            $username,
            $user['name'] ?? null,
            $user['email'] ?? null,
            $user['avatar_url'],
            $user['bio'] ?? null,
            $user['blog'] ?? null,
            $twitter,
            $user,
        );
    }

    public function readme(string $username, string $repoName): string
    {
        /** @var Repo $api */
        $api = $this->client()->api('repo');

        return $api->readme($username, $repoName);
    }
}
