<?php

namespace App\Livewire\Packages;

use App\Jobs\ProcessSubmittedPackage;
use App\Models\Package;
use App\Rules\PubliclyAvailbleGitHubRepo;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $github_url;

    public $package_type;

    public $installation_method;

    public function rules()
    {
        return [
            'github_url' => ['required', 'url', 'max:255', 'unique:packages,repo_url', new PubliclyAvailbleGitHubRepo],
            'package_type' => ['required', 'string', 'max:255', 'in:php,javascript,other'],
            'installation_method' => ['required', 'string', 'max:255', 'in:composer,npm,other'],
        ];
    }

    public function messages()
    {
        return [
            'github_url.unique' => 'This package has already been submitted.',
        ];
    }

    public function submit()
    {
        // todo: add authorization check

        $this->validate();

        $package = Package::create([
            'submitter_id' => Auth::id(),
            'repo_url' => $this->github_url,
            'type' => $this->package_type,
            'installation_method' => $this->installation_method,
        ]);

        ProcessSubmittedPackage::dispatch($package);

        Flux::toast(
            variant: 'success',
            heading: 'Package submitted',
            text: 'We are processing your package and will notify you when it is ready.',
        );

        return $this->redirect(route('packages.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.packages.create');
    }
}
