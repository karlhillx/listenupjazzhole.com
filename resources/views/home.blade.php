@php
    $album = $tour['album'];
    $video = $tour['video'];
    $dates = collect($tour['dates']);
    $tourStartsAt = \Illuminate\Support\Carbon::parse($tour['starts_at']);
    $tourHasStarted = $tourStartsAt->isPast();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="Listen Up, Jazzhole! Tour 2027 — Jeff Aug / Murat Parlak Quintet debut album For the Love of Nine, out 5 February 2027 on Stockfisch Records."
        >
        <meta property="og:title" content="Listen Up, Jazzhole! Tour 2027">
        <meta
            property="og:description"
            content="Jeff Aug / Murat Parlak Quintet — debut album For the Love of Nine and European tour."
        >
        <meta property="og:image" content="{{ url('/img/cover.jpg') }}">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">

        <title>Listen Up, Jazzhole! — Jeff Aug / Murat Parlak Quintet Tour 2027</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
            href="https://fonts.bunny.net/css?family=bebas-neue:400|caveat:600|schibsted-grotesk:400,500,600,700"
            rel="stylesheet"
        >

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="site">
        <header class="hero">
            <div class="hero__media" aria-hidden="true">
                <picture>
                    <source srcset="/img/band-navy.webp" type="image/webp">
                    <img
                        src="/img/band-navy.png"
                        alt=""
                        width="1024"
                        height="682"
                        fetchpriority="high"
                    >
                </picture>
            </div>
            <div class="hero__wash" aria-hidden="true"></div>
            <div class="hero__geo" aria-hidden="true"></div>

            <div class="hero__inner">
                <h1 class="brand">
                    Listen Up,<br>
                    <span class="brand__hole">Jazzhole!</span>
                </h1>
                <p class="hero__lede">
                    <strong>Jeff Aug / Murat Parlak Quintet</strong> — debut album
                    <em>For the Love of Nine</em> and a European run built for curious ears.
                </p>
                @unless ($tourHasStarted)
                    <div
                        class="countdown"
                        data-countdown
                        data-countdown-target="{{ $tourStartsAt->toIso8601String() }}"
                        aria-live="polite"
                    >
                        <a class="countdown__label" href="#tour">Tour opens in</a>
                        <div class="countdown__track" role="timer" aria-atomic="true">
                            @foreach (['days' => 'Days', 'hours' => 'Hrs', 'minutes' => 'Min', 'seconds' => 'Sec'] as $unit => $label)
                                <div class="countdown__cell" data-countdown-unit="{{ $unit }}">
                                    <span class="countdown__value" data-countdown-value>
                                        <span class="countdown__digit" data-countdown-digit>00</span>
                                    </span>
                                    <span class="countdown__unit">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endunless
                <div class="hero__cta">
                    <a class="btn btn--signal" href="#watch">Watch</a>
                    <a class="btn btn--ghost" href="#tour">Tour dates</a>
                    <a class="btn btn--ghost" href="#album">The album</a>
                    <a
                        class="btn btn--ghost btn--social"
                        href="{{ $tour['social']['facebook'] }}"
                        rel="noopener noreferrer"
                    >
                        <span class="btn__icon" aria-hidden="true">@include('partials.facebook-icon')</span>
                        <span>Facebook</span>
                    </a>
                    <a
                        class="btn btn--ghost btn--social"
                        href="{{ $tour['social']['instagram'] }}"
                        rel="noopener noreferrer"
                    >
                        <span class="btn__icon" aria-hidden="true">@include('partials.instagram-icon')</span>
                        <span>Instagram</span>
                    </a>
                </div>
            </div>
        </header>

        <main>
            <section
                class="watch"
                id="watch"
                aria-labelledby="watch-title"
                data-watch
                data-video-id="{{ $video['id'] }}"
            >
                <div class="section watch__layout">
                    <div class="watch__copy">
                        <p class="section__eyebrow">Official video</p>
                        <h2 class="section__title" id="watch-title">Hear the room</h2>
                        <p class="section__lede">
                            The Listen Up, Jazzhole! film — watch inline, open the cinema view, or take it to YouTube.
                        </p>
                        <div class="watch__actions">
                            <button type="button" class="btn btn--signal" data-watch-open-cinema>
                                Cinema mode
                            </button>
                            <a
                                class="btn btn--ink"
                                href="{{ $video['url'] }}"
                                rel="noopener noreferrer"
                            >
                                YouTube
                            </a>
                        </div>
                    </div>

                    <div
                        class="watch__stage"
                        data-watch-stage
                        tabindex="0"
                        role="group"
                        aria-label="{{ $video['title'] }}"
                    >
                        <div class="watch__frame" data-watch-frame data-title="{{ $video['title'] }}">
                            <picture>
                                <source srcset="{{ $video['poster_webp'] }}" type="image/webp">
                                <img
                                    class="watch__poster"
                                    src="{{ $video['poster'] }}"
                                    alt=""
                                    width="1280"
                                    height="720"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>
                        </div>

                        <button
                            type="button"
                            class="watch__play"
                            data-watch-play
                            aria-label="Play {{ $video['title'] }}"
                        >
                            <span class="watch__play-ring" aria-hidden="true"></span>
                            <span class="watch__play-core" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="28" height="28" focusable="false">
                                    <path fill="currentColor" d="M8.2 5.4v13.2L19.2 12 8.2 5.4z" />
                                </svg>
                            </span>
                            <span class="watch__play-label">Play</span>
                        </button>

                        <div class="watch__caption" aria-hidden="true">
                            <span>Listen Up, Jazzhole!</span>
                        </div>
                    </div>
                </div>
            </section>

            <dialog class="watch-dialog" data-watch-dialog aria-label="Cinema mode">
                <div class="watch-dialog__chrome">
                    <p class="watch-dialog__title">{{ $video['title'] }}</p>
                    <button type="button" class="watch-dialog__close" data-watch-close aria-label="Close cinema mode">
                        Close
                    </button>
                </div>
                <div class="watch-dialog__stage">
                    <div class="watch-dialog__frame" data-watch-dialog-frame data-title="{{ $video['title'] }}"></div>
                </div>
            </dialog>

            <section class="album" id="album" aria-labelledby="album-title">
                <div class="section album__grid">
                    <picture>
                        <source srcset="/img/cover.webp" type="image/webp">
                        <img
                            class="album__art"
                            src="/img/cover.jpg"
                            alt="Album cover for For the Love of Nine by Jeff Aug / Murat Parlak Quintet"
                            width="1024"
                            height="1024"
                            loading="lazy"
                        >
                    </picture>
                    <div>
                        <p class="section__eyebrow">Debut album</p>
                        <h2 class="section__title" id="album-title">{{ $album['title'] }}</h2>
                        <p class="section__lede">
                            Fifteen years in the making. Recorded at Stockfisch Studio in Northeim —
                            acoustic instrumental music with the intimacy of chamber music and the
                            voltage of jazz, fusion, and progressive rock.
                        </p>
                        <p class="album__meta">
                            {{ $album['release_label'] }} ·
                            <a href="{{ $album['label_url'] }}" rel="noopener noreferrer">{{ $album['label'] }}</a>
                        </p>
                        <div class="hero__cta" style="margin-top: 1.5rem;">
                            <a class="btn btn--signal" href="{{ url('/') }}">listenupjazzhole.com</a>
                        </div>
                    </div>
                </div>
            </section>

            <section id="tour" aria-labelledby="tour-title">
                <div class="section">
                    <p class="section__eyebrow">{{ $tour['name'] }} Tour</p>
                    <h2 class="section__title" id="tour-title">On the road in {{ $tour['year'] }}</h2>
                    <p class="section__lede">
                        Germany, Czechia, Slovakia, and Austria — fifteen nights for the new quintet.
                    </p>

                    <ol class="dates">
                        @foreach ($dates as $show)
                            @php
                                $when = \Illuminate\Support\Carbon::parse($show['date']);
                            @endphp
                            <li>
                                <time class="dates__date" datetime="{{ $when->toDateString() }}">
                                    {{ $when->format('j M') }}
                                </time>
                                <span class="dates__place">
                                    {{ $show['city'] }}, {{ $show['country'] }}
                                </span>
                                <span class="dates__venue">{{ $show['venue'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            <section class="story" id="story" aria-labelledby="story-title">
                <div class="section story__grid">
                    <div class="story__copy">
                        <p class="section__eyebrow">The project</p>
                        <h2 class="section__title" id="story-title">Fifteen years to find common ground</h2>
                        <p>
                            After a tour with Allan Holdsworth in 2012, guitarist
                            <a href="https://www.jeffaug.com" rel="noopener noreferrer">Jeff Aug</a>
                            and pianist
                            <a href="http://www.murat-parlak.de/" rel="noopener noreferrer">Murat Parlak</a>
                            started writing what was meant to be Aug’s eighth acoustic
                            instrumental album. Some of the new pieces asked for a larger room.
                        </p>
                        <p>
                            The Jeff Aug / Murat Parlak Quintet answers that ask: fingerstyle steel-string
                            guitar and piano joined by violin, cello, drums and percussion — melodic,
                            cinematic, and hard to pin to one genre.
                        </p>
                        <p>
                            “It took 15 years to make this happen,” Aug says, “but if it were easy,
                            I guess everyone would do it.”
                        </p>
                    </div>
                    <picture>
                        <source srcset="/img/band-color.webp" type="image/webp">
                        <img
                            class="story__photo"
                            src="/img/band-color.png"
                            alt="Jeff Aug / Murat Parlak Quintet in the studio"
                            width="1024"
                            height="682"
                            loading="lazy"
                        >
                    </picture>
                </div>
            </section>

            <section id="lineup" aria-labelledby="lineup-title">
                <div class="section">
                    <p class="section__eyebrow">Lineup</p>
                    <h2 class="section__title" id="lineup-title">The quintet</h2>
                    <p class="section__lede">
                        Players from the
                        <a href="https://www.anneclarkofficial.com/" rel="noopener noreferrer">Anne Clark Band</a>
                        and beyond — jazz, rock, classical, and Stockfisch studio roots in one ensemble.
                    </p>
                    <ul class="lineup">
                        @foreach ($tour['lineup'] as $member)
                            <li>
                                <span class="lineup__name">{{ $member['name'] }}</span>
                                <span class="lineup__role">{{ $member['role'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="contact" id="contact" aria-labelledby="contact-title">
                <div class="section">
                    <p class="section__eyebrow">Professional contacts</p>
                    <h2 class="section__title" id="contact-title">Booking &amp; press</h2>
                    <p class="section__lede">
                        For tour inquiries and media, reach the team below.
                    </p>
                    <ul class="contacts">
                        @foreach ($tour['contacts'] as $contact)
                            <li>
                                <span class="contacts__role">{{ $contact['role'] }}</span>
                                <a
                                    class="contacts__name"
                                    href="{{ $contact['url'] }}"
                                    rel="noopener noreferrer"
                                >{{ $contact['name'] }}</a>
                                <a
                                    class="contacts__url"
                                    href="{{ $contact['url'] }}"
                                    rel="noopener noreferrer"
                                >{{ preg_replace('#^https?://(www\.)?#', '', rtrim($contact['url'], '/')) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="site-footer__inner">
                <p>
                    {{ $album['artist'] }} · {{ $album['title'] }} ·
                    <a href="{{ $album['label_url'] }}" rel="noopener noreferrer">{{ $album['label'] }}</a>
                    <span aria-hidden="true">·</span>
                    <a href="{{ url('/impressum') }}">Impressum</a>
                    <span aria-hidden="true">·</span>
                    <a href="{{ url('/datenschutz') }}">Datenschutz</a>
                </p>
                <div class="site-footer__end">
                    <p class="site-footer__contacts">
                        <a href="{{ $tour['contacts']['booking']['url'] }}" rel="noopener noreferrer">Maximum Booking</a>
                        <span aria-hidden="true">·</span>
                        <a href="{{ $tour['contacts']['press']['url'] }}" rel="noopener noreferrer">Hot Mistake PR</a>
                    </p>
                    <div class="site-footer__social">
                        <a
                            class="social-link"
                            href="{{ $tour['social']['facebook'] }}"
                            rel="noopener noreferrer"
                            aria-label="Listen Up Jazzhole on Facebook"
                        >
                            <span class="social-link__mark" aria-hidden="true">@include('partials.facebook-icon')</span>
                            <span class="social-link__label">Facebook</span>
                        </a>
                        <a
                            class="social-link"
                            href="{{ $tour['social']['instagram'] }}"
                            rel="noopener noreferrer"
                            aria-label="Listen Up Jazzhole on Instagram"
                        >
                            <span class="social-link__mark" aria-hidden="true">@include('partials.instagram-icon')</span>
                            <span class="social-link__label">Instagram</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
