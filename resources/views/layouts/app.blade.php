<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    
</head>
<body class="bg-neutral-100 antialiased text-gray-900 selection:bg-red-300 selection:text-black">
    <header class="sticky top-0 bg-white">

        <div class="h-1.5 bg-red-500 w-full"></div>

        <div class="flex items-center p-6">
            <a href="/" class="text-2xl font-black tracking-wide  font-sans p-1 rounded">
                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="size-10">
            </a>
            <div class="flex items-center justify-center gap-4 flex-1">
            
                <flux:button href="#" variant="ghost" class="text-xl font-semibold hover:text-red-600">
                    Packages
                </flux:button>

                <flux:button href="#" variant="ghost" class="text-xl font-semibold hover:text-red-600">
                    Starter Kits
                </flux:button>
                
                <flux:button href="#" variant="ghost" class="text-xl font-semibold hover:text-red-600">
                    Recipes
                </flux:button>
                
                <flux:button href="#" variant="ghost" class="text-xl font-semibold hover:text-red-600">
                    Docs
                </flux:button>

            </div>
            <div class="flex items-center gap-4">
                @guest
                    <flux:button href="{{ route('login') }}" icon="github" class="text-xl font-semibold hover:text-red-600">
                        Login
                    </flux:button>
                @endguest

                @auth
                    <flux:dropdown position="bottom" align="end">
                        <flux:profile avatar="{{ auth()->user()->avatar }}" />
                    
                        <flux:navmenu>
                            <flux:navmenu.item href="#">
                                <div>
                                    <p class="text-sm text-gray-500 block">Signed in as</p>
                                    <p class="font-bold block">{{ auth()->user()->name }}</p>
                                </div>
                            </flux:navmenu.item>
                            <flux:menu.separator />
                            <flux:navmenu.item href="{{ route('settings') }}" icon="user">
                                Manage Account
                            </flux:navmenu.item>
                            <flux:navmenu.item onclick="event.preventDefault(); document.getElementById('logout-form').submit();" icon="arrow-right-start-on-rectangle">Logout</flux:navmenu.item>
                        </flux:navmenu>
                    </flux:dropdown>
                @endauth
            </div>
        </div>

    </header>

    @yield('content')

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @persist('toast')
        <flux:toast />
    @endpersist

    @fluxScripts
</body>
</html>