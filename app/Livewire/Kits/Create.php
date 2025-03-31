<?php

namespace App\Livewire\Kits;

use App\Models\StarterKit;
use App\Rules\PubliclyAvailbleGitHubRepo;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public string $name = '';

    public string $github_url = '';

    public string $templating_engine = '';

    public string $inertia = '';

    public string $panel_builder = '';

    public string $authentication = '';

    public string $css_framework = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'github_url' => ['required', 'url', 'unique:starter_kits,repo_url', 'max:255', new PubliclyAvailbleGitHubRepo],
            'templating_engine' => ['required', 'string', 'max:255', 'in:livewire,blade,react,vue,svelte,other'],
            'inertia' => ['required', 'string', 'max:255', 'in:yes,no'],
            'panel_builder' => ['required', 'string', 'max:255', 'in:yes,no'],
            'authentication' => ['required', 'string', 'max:255', 'in:yes,no'],
            'css_framework' => ['required', 'string', 'max:255', 'in:tailwind,bootstrap,other'],
        ];
    }

    public function messages()
    {
        return [
            'github_url.unique' => 'This starter kit has already been submitted.',
        ];
    }

    public function submit()
    {
        $this->validate();

        $kit = StarterKit::create([
            'display_name' => $this->name,
            'repo_url' => $this->github_url,
            'templating_engine' => $this->templating_engine,
            'inertia' => $this->inertia === 'yes',
            'panel_builder' => $this->panel_builder === 'yes',
            'authentication' => $this->authentication === 'yes',
            'css_framework' => $this->css_framework,
        ]);

        // todo: dispatch job to process starter kit

        Flux::toast(
            variant: 'success',
            heading: 'Starter kit submitted',
            text: 'We are processing your starter kit and will notify you when it is ready.',
        );

        return $this->redirect(route('kits.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.kits.create');
    }
}
