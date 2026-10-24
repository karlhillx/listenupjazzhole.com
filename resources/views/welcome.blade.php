<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Listen Up Jazz Hole — live jazz, late nights, and a room that listens back.">

        <title>{{ config('app.name', 'Listen Up Jazz Hole') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=anton:400|source-serif-4:400,600" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="pulse" aria-hidden="true"></div>
        <main class="stage">
            <h1 class="brand">Listen Up<br>Jazz Hole</h1>
            <p class="lede">A proof-of-concept room for live jazz — site online, stack ready, more coming soon.</p>
            <a class="cta" href="mailto:hello@listenupjazzhole.com">Say hello</a>
        </main>
    </body>
</html>
