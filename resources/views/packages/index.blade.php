@extends('layouts.app')

@section('body::classes', '!bg-neutral-100 dark:!bg-neutral-900')

@section('content')
    <div class="max-w-6xl mx-auto flex gap-8 my-12">

        <div class="w-64 space-y-4 sticky top-20">

            <flux:input placeholder="Search..." icon="magnifying-glass" />

            <flux:card class="space-y-4">
                <flux:heading size="lg">Filters</flux:heading>
                
                <flux:heading size="lg">Type</flux:heading>
                <flux:checkbox label="Offical" value="offical" />
                <flux:checkbox label="Community" value="community" />

                <flux:separator />

                <flux:heading size="lg">Stack</flux:heading>
                <flux:checkbox label="Livewire" value="livewire" />
                <flux:checkbox label="Inertia" value="inertia" />
                <flux:checkbox label="React" value="react" />
                <flux:checkbox label="Vue" value="vue" />
                <flux:checkbox label="Blade" value="blade" />
                
                <flux:separator />

                <flux:heading size="lg">Category</flux:heading>
                <flux:checkbox label="Frontend" value="frontend" />
                <flux:checkbox label="Backend" value="backend" />
                <flux:checkbox label="Full Stack" value="full-stack" />

            </flux:card>
        </div>

        <div class="flex-1 space-y-4">
            @foreach($packages as $package)
                <flux:card class="space-y-4">  
                    <flux:heading size="lg">
                        <div class="flex items-center space-x-4">
                            <flux:avatar class="!size-8 flex-shrink-0" src="{{ $package->user->avatar }}" />
                            <div>
                                <a href="{{ route('users.show', $package->user) }}" class="text-red-500 underline">{{ $package->vendor }}</a> 
                                / 
                                <a href="{{ route('packages.show', [$package->user, $package]) }}" class="text-red-500 underline">{{ $package->name }}</a>
                            </div>
                        </div>
                    </flux:heading>
                    <div class="prose dark:prose-invert max-w-none">
                        {{ str($package->description)->limit(250) }}
                    </div>
                </flux:card>
            @endforeach

            {{ $packages->links() }}
        </div>

    </div>
@endsection
