@extends('layouts.app')

@section('body::classes', '!bg-neutral-100 dark:!bg-neutral-900')

@section('content')
    
    <div class="max-w-6xl mx-auto my-10 !space-y-4">
        <flux:heading size="xl" class="!text-3xl">Starter Kits</flux:heading>
        <flux:subheading size="lg">
            Starter kits are pre-configured Laravel projects that you can use to start your next project.
        </flux:subheading>
        <flux:separator />
    </div>
    
    <div class="max-w-6xl mx-auto flex gap-8 my-10">

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
                <flux:checkbox label="Svelte" value="svelte" />
                <flux:checkbox label="Other" value="other" />

            </flux:card>
        </div>

        <div class="flex-1 space-y-4">
            @foreach ($kits as $kit)
                <flux:card class="space-y-4">
                    <flux:heading size="lg">
                        <div class="flex items-center space-x-4">
                            <flux:avatar class="!size-8 flex-shrink-0" src="{{ $kit->user->avatar }}" />
                            <div>
                                <a href="{{ route('users.show', $kit->user) }}"
                                    class="text-red-500 underline">{{ $kit->vendor }}</a>
                                /
                                <a href="{{ route('kits.show', [$kit->user, $kit]) }}"
                                    class="text-red-500 underline">{{ $kit->name }}</a>
                            </div>
                        </div>
                    </flux:heading>
                    <div class="prose dark:prose-invert max-w-none">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi quos voluptatum rerum sed quibusdam
                        eveniet earum molestiae omnis ad, aliquam distinctio quam provident blanditiis expedita? Natus, in
                        rem! Ea, cupiditate?
                    </div>
                </flux:card>
            @endforeach

            {{ $kits->links() }}
        </div>

    </div>
@endsection
