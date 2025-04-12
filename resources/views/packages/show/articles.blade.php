@extends('packages.show.layout')

@section('page')
    <div class="flex-1 space-y-8">

        <div class="flex items-center space-x-2 max-w-2xl">

            <flux:input.group>
                <flux:input placeholder="Search articles" type="search" />
                <flux:dropdown>
                    <flux:button icon:trailing="chevron-down">Sort by</flux:button>
                    <flux:menu>
                        <flux:menu.radio.group wire:model="sortBy">
                            <flux:menu.radio checked>Latest</flux:menu.radio>
                            <flux:menu.radio>Oldest</flux:menu.radio>
                            <flux:menu.radio>Most popular</flux:menu.radio>
                        </flux:menu.radio.group>
                    </flux:menu>
                </flux:dropdown>
            </flux:input.group>

            <flux:button variant="primary" >
                Submit Article
            </flux:button>

        </div>

        @if ($articles->isEmpty())

            <flux:card class="text-center">
                <flux:heading size="lg">No articles found.</flux:heading>
                <flux:subheading>
                    Be the first to submit an article for this package.
                </flux:subheading>
            </flux:card>

        @else
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                @foreach ($articles as $article)
                    <div class="relative flex flex-1">
                        <a href="{{ $article->url }}" target="_blank" class="flex-1 rounded-xl">
                            <flux:card class="space-y-4 flex flex-1 flex-col h-full justify-between">
                                <div class="flex-1">
                                    <flux:heading size="lg" class="text-red-500 underline line-clamp-2">
                                        {{ $article->url }}
                                    </flux:heading>
                                    @if ($article->description)
                                        <p>
                                            {{ str($article->description)->limit(250) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex items-center space-x-2">
                                    <flux:avatar class="!size-6 flex-shrink-0" src="{{ $article->submitter->avatar }}" />
                                    <p class="text-sm text-gray-500 tabular-nums">
                                        Posted {{ $article->created_at->diffForHumans() }} by
                                        {{ $article->submitter->name }}
                                    </p>
                                </div>
                            </flux:card>
                        </a>
                    </div>
                @endforeach
            </div>

            <flux:pagination :paginator="$articles" />
        @endif

    </div>
@endsection
