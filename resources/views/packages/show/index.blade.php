@extends('packages.show.layout')

@section('page')
    <flux:card class="prose dark:prose-invert max-w-none prose-red overflow-hidden px-10">
        {!! $package->parsed_readme !!}
    </flux:card>
@endsection
