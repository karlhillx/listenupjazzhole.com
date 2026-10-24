@props([
    'locale' => 'de',
    'title' => '',
    'canonical' => '/',
    'hreflang' => [],
])

@php
    app()->setLocale($locale);
    $isDe = $locale === 'de';
    $home = $isDe ? '/de' : '/';
    $alternates = collect($hreflang)->except('x-default')->all();
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,follow">
        <title>{{ $title }} — Listen Up, Jazzhole!</title>
        <link rel="canonical" href="{{ url($canonical) }}">
        @foreach ($hreflang as $lang => $href)
            <link rel="alternate" hreflang="{{ $lang }}" href="{{ url($href) }}">
        @endforeach
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
            href="https://fonts.bunny.net/css?family=bebas-neue:400|caveat:600|schibsted-grotesk:400,500,600,700"
            rel="stylesheet"
        >
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="site legal-page">
        <header class="legal-top">
            <div class="legal-top__inner">
                <a class="legal-brand" href="{{ url($home) }}">
                    Listen Up, <span>Jazzhole!</span>
                </a>
                <x-lang-switcher :locale="$locale" :alternates="$alternates" />
            </div>
        </header>

        <main class="legal-main">
            <div class="legal-wrap">
                <p class="section__eyebrow">{{ $isDe ? 'Rechtliches' : 'Legal' }}</p>
                <h1 class="legal-title">{{ $title }}</h1>
                {{ $slot }}
            </div>
        </main>

        <x-site-footer :locale="$locale" :alternates="$alternates" />
    </body>
</html>
