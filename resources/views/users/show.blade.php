@extends('layouts.app')

@section('body::classes', '!bg-neutral-100 dark:!bg-neutral-800')

@section('content')

    <section class="max-w-5xl mx-auto p-12 space-y-8">

        <flux:card>
            <div class="flex gap-8 sele">
                <flux:avatar src="{{ $user->avatar }}" class="size-32 flex-shrink-0" />
                <div class="flex flex-col !space-y-4">
                    <flux:heading size="lg" class="!text-3xl">
                        {{ $user->name }}
                    </flux:heading>
                    <flux:subheading class="text-[1.0rem]">
                        {{ $user->bio }}
                    </flux:subheading>
                    <div class="flex gap-2">
                        <flux:button size="sm" icon="github" target="_blank" href="https://github.com/{{ $user->username }}">
                            GitHub
                        </flux:button>
                        @if ($user->website)
                            <flux:button size="sm" icon="link" target="_blank" href="{{ $user->website }}">Website</flux:button>
                        @endif
                        @if ($user->twitter)
                            <flux:button size="sm" icon="x" target="_blank" href="{{ $user->twitter }}">Twitter</flux:button>
                        @endif
                        @if ($user->bluesky)
                            <flux:button size="sm" icon="bluesky" target="_blank" href="{{ $user->bluesky }}">Bluesky</flux:button>
                        @endif
                    </div>
                </div>                
            </div>
            
        </flux:card>

        <flux:tabs variant="segmented">
            <flux:tab href="#" icon="archive-box">Packages</flux:tab>
            <flux:tab href="#" icon="square-3-stack-3d">Starter Kits</flux:tab>
            <flux:tab href="#" icon="code-bracket">Recipes</flux:tab>
        </flux:tabs>

    </section>

@endsection
