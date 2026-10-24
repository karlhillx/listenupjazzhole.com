@props([
    'locale' => 'en',
    'alternates' => [],
])

@php
    $langs = [
        'de' => $alternates['de'] ?? '/de',
        'en' => $alternates['en'] ?? '/',
    ];
@endphp

<nav {{ $attributes->class('lang-switch') }} aria-label="{{ __('site.lang.label') }}">
    @foreach ($langs as $lang => $href)
        <a
            href="{{ url($href) }}"
            lang="{{ $lang }}"
            hreflang="{{ $lang }}"
            @if ($lang === $locale) aria-current="page" @endif
        >{{ __('site.lang.'.$lang) }}</a>
    @endforeach
</nav>
