@props([
    'locale' => 'de',
    'title' => '',
    'canonical' => '/',
    'hreflang' => [],
])

@php
    $isDe = $locale === 'de';
    $tour = config('tour');
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
                <a class="legal-brand" href="{{ url('/') }}">
                    Listen Up, <span>Jazzhole!</span>
                </a>
                <nav class="legal-lang" aria-label="{{ $isDe ? 'Sprache' : 'Language' }}">
                    @foreach ($hreflang as $lang => $href)
                        @if ($lang !== 'x-default')
                            <a
                                href="{{ url($href) }}"
                                lang="{{ $lang }}"
                                @if ($lang === $locale) aria-current="page" @endif
                            >{{ strtoupper($lang) }}</a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </header>

        <main class="legal-main">
            <div class="legal-wrap">
                <p class="section__eyebrow">{{ $isDe ? 'Rechtliches' : 'Legal' }}</p>
                <h1 class="legal-title">{{ $title }}</h1>
                {{ $slot }}
            </div>
        </main>

        <footer class="site-footer">
            <div class="site-footer__inner">
                <p>
                    <a href="{{ url('/') }}">listenupjazzhole.com</a>
                    <span aria-hidden="true">·</span>
                    <a href="{{ url($isDe ? '/impressum' : '/imprint') }}">{{ $isDe ? 'Impressum' : 'Imprint' }}</a>
                    <span aria-hidden="true">·</span>
                    <a href="{{ url($isDe ? '/datenschutz' : '/privacy') }}">{{ $isDe ? 'Datenschutz' : 'Privacy' }}</a>
                </p>
                <p class="site-footer__contacts">
                    <a href="{{ $tour['contacts']['booking']['url'] }}" rel="noopener noreferrer">Maximum Booking</a>
                    <span aria-hidden="true">·</span>
                    <a href="{{ $tour['contacts']['press']['url'] }}" rel="noopener noreferrer">Hot Mistake PR</a>
                </p>
            </div>
        </footer>
    </body>
</html>
