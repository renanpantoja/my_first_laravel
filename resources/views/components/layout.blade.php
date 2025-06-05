<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ expression('page.title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @Vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 text-white font-hanken-grotesk pb-10">
    <div>
        <nav class="px-10 flex justify-between items-center bg-black py-4 border-b border-white/30">
            <div>
                <a href="/">
                    <img width="200px" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="/">{{ expression('nav.jobs') }}</a>
                <a href="/jobs/salaries">{{ expression('nav.salaries') }}</a>
                <a href="/employers">{{ expression('nav.companies') }}</a>
            </div>


            <div class="space-x-6 font-bold flex">
            @auth
                <a href="{{ route('api.token.show') }}" class="text-sm text-gray-700 underline">API Token</a>
                <a href="/my-jobs">{{ expression('nav.myjobs') }}</a>
                <a href="/jobs/create">{{ expression('nav.postjobs') }}</a>
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button>{{ expression('nav.logout') }}</button>
                </form>
            @endauth

            @guest
                <a href="/register">{{ expression('nav.register') }}</a>
                <a href="/login">{{ expression('nav.login') }}</a>
            @endguest
            
                <button
                    id="lang-toggle"
                    class="bg-white text-black font-bold py-2 px-4 rounded inline-flex items-center"
                    onclick="document.getElementById('lang-menu').classList.toggle('hidden')">
                    {{ strtoupper(app()->getLocale()) }}
                    <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path d="M5.516 7.548l4.484 4.482 4.484-4.482L16 8.516 10 14.516 4 8.516z"/>
                    </svg>
                </button>
                <ul
                    id="lang-menu"
                    class="absolute right-0 mt-2 w-28 bg-white text-black rounded shadow-lg hidden z-50">
                    <li><a href="/lang/en" class="block px-4 py-2 hover:bg-gray-200">EN</a></li>
                    <li><a href="/lang/pt" class="block px-4 py-2 hover:bg-gray-200">PT</a></li>
                </ul>
            </div>
        </nav>

        <main class="px-10 mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>