@props([
    'locale' => 'en',
    'alternates' => [],
])

@php
    $tour = config('tour');
    $album = $tour['album'];
    $isDe = $locale === 'de';
    $impressum = $isDe ? '/impressum' : '/imprint';
    $privacy = $isDe ? '/datenschutz' : '/privacy';
    $home = $isDe ? '/de' : '/';
    $alternates = $alternates ?: [
        'de' => '/de',
        'en' => '/',
    ];
@endphp

<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__top">
            <div class="site-footer__brand">
                <p class="site-footer__artist">{{ $album['artist'] }}</p>
                <p class="site-footer__release">
                    <em>{{ $album['title'] }}</em>
                    <span aria-hidden="true">·</span>
                    {{ $tour['year'] }}
                </p>
            </div>
            <x-lang-switcher :locale="$locale" :alternates="$alternates" />
        </div>

        <div class="site-footer__grid">
            <div class="site-footer__col">
                <p class="site-footer__heading">{{ __('site.footer.legal') }}</p>
                <ul class="site-footer__links">
                    <li>
                        <a href="{{ url($home) }}">{{ __('site.footer.home') }}</a>
                    </li>
                    <li>
                        <a href="{{ url($impressum) }}">{{ __('site.footer.impressum') }}</a>
                    </li>
                    <li>
                        <a href="{{ url($privacy) }}">{{ __('site.footer.datenschutz') }}</a>
                    </li>
                </ul>
            </div>

            <div class="site-footer__col">
                <p class="site-footer__heading">{{ __('site.footer.connect') }}</p>
                <ul class="site-footer__links">
                    <li>
                        <a href="{{ $tour['contacts']['booking']['url'] }}" rel="noopener noreferrer">
                            Maximum Booking
                        </a>
                    </li>
                    <li>
                        <a href="{{ $tour['contacts']['press']['url'] }}" rel="noopener noreferrer">
                            Hot Mistake PR
                        </a>
                    </li>
                </ul>
            </div>

            <div class="site-footer__col">
                <p class="site-footer__heading">{{ __('site.footer.follow') }}</p>
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

            <div class="site-footer__col site-footer__col--label">
                <p class="site-footer__heading">{{ __('site.footer.label') }}</p>
                <a
                    class="site-footer__label"
                    href="{{ $album['label_url'] }}"
                    rel="noopener noreferrer"
                >
                    <img
                        src="/img/stockfisch.png"
                        alt="Stockfisch Records"
                        width="150"
                        height="150"
                    >
                </a>
            </div>
        </div>
    </div>
</footer>
