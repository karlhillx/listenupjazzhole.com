@php
    $locale = $locale ?? 'en';
    $alternates = $alternates ?? ['de' => '/de', 'en' => '/', 'x-default' => '/'];
    app()->setLocale($locale);

    $album = $tour['album'];
    $video = $tour['video'];
    $dates = collect($tour['dates']);
    $tourStartsAt = \Illuminate\Support\Carbon::parse($tour['starts_at']);
    $tourHasStarted = $tourStartsAt->isPast();
    $homePath = $locale === 'de' ? '/de' : '/';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ __('site.meta.description') }}">
        <meta property="og:title" content="{{ __('site.meta.title') }}">
        <meta property="og:description" content="{{ __('site.meta.og_description') }}">
        <meta property="og:image" content="{{ url('/img/cover.jpg') }}">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="{{ $locale === 'de' ? 'de_DE' : 'en_US' }}">
        <meta name="twitter:card" content="summary_large_image">

        <title>{{ __('site.meta.title') }}</title>
        <link rel="canonical" href="{{ url($homePath) }}">
        @foreach ($alternates as $lang => $href)
            <link rel="alternate" hreflang="{{ $lang }}" href="{{ url($href) }}">
        @endforeach

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
                <div class="hero__top">
                    <p class="hero__tagline">
                        Listen Up, <span class="hero__tagline-mark">Jazzhole!</span>
                    </p>
                    <x-lang-switcher
                        class="lang-switch--hero"
                        :locale="$locale"
                        :alternates="$alternates"
                    />
                </div>

                <div class="hero__stack">
                    <h1 class="hero__band">Jeff Aug / Murat Parlak Quintet</h1>
                    <p class="hero__lede">
                        {!! __('site.hero.lede', ['album' => '<em>'.e($album['title']).'</em>']) !!}
                    </p>
                    @unless ($tourHasStarted)
                        <div
                            class="countdown"
                            data-countdown
                            data-countdown-target="{{ $tourStartsAt->toIso8601String() }}"
                            aria-live="polite"
                        >
                            <a class="countdown__label" href="#tour">{{ __('site.hero.tour_opens') }}</a>
                            <div class="countdown__track" role="timer" aria-atomic="true">
                                @foreach ([
                                    'days' => __('site.hero.days'),
                                    'hours' => __('site.hero.hours'),
                                    'minutes' => __('site.hero.minutes'),
                                    'seconds' => __('site.hero.seconds'),
                                ] as $unit => $label)
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
                        <a class="btn btn--signal" href="#watch">{{ __('site.hero.watch') }}</a>
                        <a class="btn btn--ghost" href="#tour">{{ __('site.hero.tour_dates') }}</a>
                        <a class="btn btn--ghost" href="#album">{{ __('site.hero.the_album') }}</a>
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
                        <p class="section__eyebrow">{{ __('site.watch.eyebrow') }}</p>
                        <h2 class="section__title" id="watch-title">{{ __('site.watch.title') }}</h2>
                        <p class="section__lede">{{ __('site.watch.lede') }}</p>
                        <div class="watch__actions">
                            <button type="button" class="btn btn--signal" data-watch-open-cinema>
                                {{ __('site.watch.cinema') }}
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
                            aria-label="{{ __('site.watch.play') }} {{ $video['title'] }}"
                        >
                            <span class="watch__play-ring" aria-hidden="true"></span>
                            <span class="watch__play-core" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="28" height="28" focusable="false">
                                    <path fill="currentColor" d="M8.2 5.4v13.2L19.2 12 8.2 5.4z" />
                                </svg>
                            </span>
                            <span class="watch__play-label">{{ __('site.watch.play') }}</span>
                        </button>

                        <div class="watch__caption" aria-hidden="true">
                            <span>Listen Up, Jazzhole!</span>
                        </div>
                    </div>
                </div>
            </section>

            <dialog class="watch-dialog" data-watch-dialog aria-label="{{ __('site.watch.cinema') }}">
                <div class="watch-dialog__chrome">
                    <p class="watch-dialog__title">{{ $video['title'] }}</p>
                    <button
                        type="button"
                        class="watch-dialog__close"
                        data-watch-close
                        aria-label="{{ __('site.watch.close_cinema') }}"
                    >
                        {{ __('site.watch.close') }}
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
                            alt="{{ __('site.album.cover_alt') }}"
                            width="1024"
                            height="1024"
                            loading="lazy"
                        >
                    </picture>
                    <div>
                        <p class="section__eyebrow">{{ __('site.album.eyebrow') }}</p>
                        <h2 class="section__title" id="album-title">{{ $album['title'] }}</h2>
                        <p class="section__lede">{{ __('site.album.lede') }}</p>
                        <p class="album__meta">
                            {{ __('site.album.release_label') }} ·
                            <a href="{{ $album['label_url'] }}" rel="noopener noreferrer">{{ $album['label'] }}</a>
                        </p>
                    </div>
                </div>
            </section>

            <section id="tour" aria-labelledby="tour-title">
                <div class="section">
                    <p class="section__eyebrow">{{ __('site.tour.eyebrow', ['name' => $tour['name']]) }}</p>
                    <h2 class="section__title" id="tour-title">
                        {{ __('site.tour.title', ['year' => $tour['year']]) }}
                    </h2>
                    <p class="section__lede">{{ __('site.tour.lede') }}</p>

                    <ol class="dates">
                        @foreach ($dates as $show)
                            @php
                                $when = \Illuminate\Support\Carbon::parse($show['date'])->locale($locale);
                            @endphp
                            <li>
                                <time class="dates__date" datetime="{{ $when->toDateString() }}">
                                    {{ $locale === 'de' ? $when->isoFormat('D. MMM') : $when->format('j M') }}
                                </time>
                                <span class="dates__place">
                                    {{ $show['city'] }}, {{ $show['country'] }}
                                </span>
                                @if (! empty($show['venue_url']))
                                    <a
                                        class="dates__venue"
                                        href="{{ $show['venue_url'] }}"
                                        rel="noopener noreferrer"
                                    >{{ $show['venue'] }}</a>
                                @else
                                    <span class="dates__venue">{{ $show['venue'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            <section class="story" id="story" aria-labelledby="story-title">
                <div class="section story__grid">
                    <div class="story__copy">
                        <p class="section__eyebrow">{{ __('site.story.eyebrow') }}</p>
                        <h2 class="section__title" id="story-title">{{ __('site.story.title') }}</h2>
                        <p>
                            {!! __('site.story.p1', [
                                'jeff' => '<a href="https://www.jeffaug.com" rel="noopener noreferrer">Jeff Aug</a>',
                                'murat' => '<a href="http://www.murat-parlak.de/" rel="noopener noreferrer">Murat Parlak</a>',
                            ]) !!}
                        </p>
                        <p>{{ __('site.story.p2') }}</p>
                        <p>{{ __('site.story.p3') }}</p>
                    </div>
                    <picture>
                        <source srcset="/img/band-color.webp" type="image/webp">
                        <img
                            class="story__photo"
                            src="/img/band-color.png"
                            alt="{{ __('site.story.photo_alt') }}"
                            width="1024"
                            height="682"
                            loading="lazy"
                        >
                    </picture>
                </div>
            </section>

            <section id="lineup" aria-labelledby="lineup-title">
                <div class="section">
                    <p class="section__eyebrow">{{ __('site.lineup.eyebrow') }}</p>
                    <h2 class="section__title" id="lineup-title">{{ __('site.lineup.title') }}</h2>
                    <p class="section__lede">
                        {!! __('site.lineup.lede', [
                            'anne' => '<a href="https://www.anneclarkofficial.com/" rel="noopener noreferrer">Anne Clark Band</a>',
                        ]) !!}
                    </p>
                    <ul class="lineup">
                        @foreach ($tour['lineup'] as $member)
                            <li>
                                <span class="lineup__name">{{ $member['name'] }}</span>
                                <span class="lineup__role">{{ __('site.roles.'.$member['role']) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section class="contact" id="contact" aria-labelledby="contact-title">
                <div class="section">
                    <p class="section__eyebrow">{{ __('site.contact.eyebrow') }}</p>
                    <h2 class="section__title" id="contact-title">{{ __('site.contact.title') }}</h2>
                    <p class="section__lede">{{ __('site.contact.lede') }}</p>
                    <ul class="contacts">
                        @foreach ($tour['contacts'] as $key => $contact)
                            <li>
                                <span class="contacts__role">{{ __('site.contact.'.$key) }}</span>
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

        <x-site-footer :locale="$locale" :alternates="$alternates" />
    </body>
</html>
