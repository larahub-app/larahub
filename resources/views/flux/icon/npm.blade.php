@php $attributes = $unescapedForwardedAttributes ?? $attributes; @endphp

@props([
    'variant' => 'outline',
])

@php
    $classes = Flux::classes('shrink-0')->add(
        match ($variant) {
            'outline' => '[:where(&)]:size-6',
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
        },
    );
@endphp

<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 15 15" fill="none"
    xmlns="http://www.w3.org/2000/svg" width="30" height="30">
    <path d="M4.5 10.5v2h2v-2h8v-6H.5v6h4zm0 0v-6m4 0v6M6.5 6v3m-4-3v4.5m8-4.5v4.5m2-4.5v4.5" stroke="currentColor">
    </path>
</svg>
