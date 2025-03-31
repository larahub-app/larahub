@extends('layouts.app')

@section('body::classes', '!bg-neutral-100 dark:!bg-neutral-900')

@section('content')

    <div class="max-w-6xl mx-auto my-10 !space-y-4">
        <flux:heading size="xl" class="!text-3xl">Packages</flux:heading>
        <flux:subheading size="lg">
            Packages are bundles of code that you can use to add functionality to your Laravel application.
        </flux:subheading>
        <flux:separator />
    </div>

    @livewire('packages.index')
    
@endsection
