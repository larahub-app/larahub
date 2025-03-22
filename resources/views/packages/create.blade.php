@extends('layouts.app')

@section('body::classes', '!bg-neutral-100 dark:!bg-neutral-900')

@section('content')

    <div class="max-w-2xl mx-auto my-12">
        @livewire('packages.create')
    </div>
@endsection
