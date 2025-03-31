@extends('layouts.app')

@section('body::classes', '!bg-neutral-100 dark:!bg-neutral-900')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8 my-12">

        <flux:card>
            <div class="flex gap-8 select-none">
                <flux:avatar src="{{ $package->user->avatar }}" class="size-32 flex-shrink-0" />
                <div class="flex flex-col !space-y-4">
                    <flux:heading size="lg" class="!text-3xl">
                        <a href="{{ route('users.show', $package->user) }}"
                            class="text-red-500 underline">{{ $package->vendor }}</a>
                        /
                        {{ $package->name }}
                    </flux:heading>
                    <flux:subheading class="text-[1.0rem]">
                        {{ $package->description }}
                    </flux:subheading>
                    <div class="flex gap-2">
                        <flux:button size="sm" icon="github" href="{{ $package->repo_url }}">
                            GitHub
                        </flux:button>
                        @if ($package->installation_method == 'composer')
                            <flux:button size="sm" icon="packagist" href="{{ $package->repo_url }}">
                                Packagist
                            </flux:button>
                        @endif
                        @if ($package->installation_method == 'npm')
                            <flux:button size="sm" icon="npm" href="{{ $package->repo_url }}">
                                NPM
                            </flux:button>
                        @endif
                        @if ($package->website)
                            <flux:button size="sm" icon="link" href="{{ $package->website }}">Website</flux:button>
                        @endif
                    </div>
                </div>
            </div>

        </flux:card>

        <flux:tabs variant="segmented">
            <flux:tab href="{{ route('packages.show', [$package->user, $package->name]) }}" icon="home">Readme</flux:tab>
            <flux:tab href="{{ route('packages.show.starter-kits', [$package->user, $package->name]) }}"
                icon="square-3-stack-3d">Starter Kits</flux:tab>
            <flux:tab href="#" icon="code-bracket">Recipes</flux:tab>
            <flux:tab href="#" icon="square-2-stack">Related</flux:tab>
            <flux:tab href="#" icon="newspaper">Articles</flux:tab>
        </flux:tabs>

        @yield('page')

    </div>
@endsection
