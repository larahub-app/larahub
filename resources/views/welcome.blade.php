@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="relative isolate overflow-hidden bg-gradient-to-b from-red-100/20">
            <div class="mx-auto max-w-7xl pb-24 pt-10 sm:pb-32 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-8 lg:py-40">
                <div class="px-6 lg:px-0 lg:pt-4">
                    <div class="mx-auto max-w-2xl">
                        <div class="max-w-lg">
                            <h1 class="mt-10 text-pretty text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                                {{ config('app.name') }}</h1>
                            <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                                Your home for Laravel <a href="#" class="text-red-600 underline">packages</a>, <a href="#" class="text-red-600 underline">starter kits</a>, <a href="#" class="text-red-600 underline">recipes</a> and more.
                            </p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <flux:button href="https://github.com/larahub-app/larahub" target="_blank" icon="github" variant="primary">
                                    View on GitHub
                                </flux:button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-20 sm:mt-24 md:mx-auto md:max-w-2xl lg:mx-0 lg:mt-0 lg:w-screen">
                    <div class="absolute inset-y-0 right-1/2 -z-10 -mr-10 w-[200%] skew-x-[-30deg] bg-white shadow-xl shadow-red-600/10 ring-1 ring-red-50 md:-mr-20 lg:-mr-36"
                        aria-hidden="true"></div>
                    <div class="shadow-lg md:rounded-3xl">
                        <div
                            class="bg-red-500 [clip-path:inset(0)] md:[clip-path:inset(0_round_theme(borderRadius.3xl))]">
                            <div class="absolute -inset-y-px left-1/2 -z-10 ml-10 w-[200%] skew-x-[-30deg] bg-red-100 opacity-20 ring-1 ring-inset ring-white md:ml-20 lg:ml-36"
                                aria-hidden="true"></div>
                            <div class="relative px-6 pt-8 sm:pt-16 md:pl-16 md:pr-0">
                                <div class="mx-auto max-w-2xl md:mx-0 md:max-w-none">
                                    <div class="w-screen overflow-hidden rounded-tl-xl bg-gray-900">
                                        <div class="flex bg-gray-800/40 ring-1 ring-white/5">
                                            <div class="-mb-px flex text-sm/6 font-medium text-gray-400">
                                                <div
                                                    class="border-b border-r border-b-white/20 border-r-white/10 bg-white/5 px-4 py-2 text-white">
                                                    NotificationSetting.jsx</div>
                                                <div class="border-r border-gray-600/10 px-4 py-2">App.jsx</div>
                                            </div>
                                        </div>
                                        <div class="px-6 pb-14 pt-6">
                                            <!-- Your code example -->
                                        </div>
                                    </div>
                                </div>
                                <div class="pointer-events-none absolute inset-0 ring-1 ring-inset ring-black/10 md:rounded-3xl"
                                    aria-hidden="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 -z-10 h-24 bg-gradient-to-t from-white sm:h-32"></div>
        </div>
    </div>

    <main class="h-[3000px]">
        <section class="max-w-4xl mx-auto flex gap-6 my-12">
            
        </section>
    </main>
@endsection