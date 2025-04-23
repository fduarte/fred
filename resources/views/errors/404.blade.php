<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark']) data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css'])
    </head>
    <body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
        <div class="h-screen w-screen bg-blue-700 flex flex-col justify-center items-center flex-wrap">
            <div class="font-sans text-white text-6xl">404</div>
            <p class="mt-4 text-xl md:text-2xl italic text-pink-200">{{ $message }}</p>
            <p class="mt-4 text-xs md:text-sm text-pink-200 text-left">― Monty Python's Flying Circus.</p>
        </div>

        <div class="absolute w-screen bottom-0 mb-6 text-white text-center font-sans text-xl">
            <span class="opacity-50 text-pink-200">Take me back to</span>
            <a class="border-b text-pink-200" href="{{ config('app.url') }}">real life</a>
        </div>
    </body>
</html>
