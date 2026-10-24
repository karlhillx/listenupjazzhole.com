@php
    $op = config('legal.operator');
    $updated = \Illuminate\Support\Carbon::parse(config('legal.updated'));
@endphp

<x-legal-layout
    :locale="$locale"
    :title="$locale === 'de' ? 'Impressum' : 'Imprint'"
    :canonical="$locale === 'de' ? '/impressum' : '/imprint'"
    :hreflang="['de' => '/impressum', 'en' => '/imprint', 'x-default' => '/impressum']"
>
    @if ($locale === 'de')
        <section class="legal-block" aria-labelledby="anbieter">
            <h2 id="anbieter">Angaben gemäß § 5 DDG</h2>
            <p>
                <strong>{{ $op['name'] }}</strong><br>
                {{ $op['trade_name'] }}
            </p>
            <address>
                {{ $op['street'] }}<br>
                {{ $op['postal'] }} {{ $op['city'] }}<br>
                {{ $op['country'] }}
            </address>
            <p>
                E-Mail: <a href="mailto:{{ $op['email'] }}">{{ $op['email'] }}</a><br>
                Telefon: <a href="tel:{{ $op['phone_href'] }}">{{ $op['phone'] }}</a>
            </p>
            <p>
                {{ $op['name'] }} betreibt dieses Informationsangebot zu Tour und Album des
                Jeff Aug / Murat Parlak Quintet. MAXIMUM Booking wird als Einzelunternehmen geführt.
                Es besteht keine Eintragung im Handelsregister.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="ust">
            <h2 id="ust">Umsatzsteuer-ID</h2>
            <p>
                Umsatzsteuer-Identifikationsnummer gemäß § 27a Umsatzsteuergesetz:<br>
                <strong>{{ $op['vat_id'] }}</strong>
            </p>
        </section>

        <section class="legal-block" aria-labelledby="inhalt">
            <h2 id="inhalt">Verantwortlich für den Inhalt</h2>
            <p>
                {{ $op['name'] }}<br>
                {{ $op['street'] }}<br>
                {{ $op['postal'] }} {{ $op['city'] }}<br>
                {{ $op['country'] }}
            </p>
            <p>
                Booking:
                <a href="{{ config('tour.contacts.booking.url') }}" rel="noopener noreferrer">Maximum Booking</a>
                · Presse:
                <a href="{{ config('tour.contacts.press.url') }}" rel="noopener noreferrer">Hot Mistake PR</a>
            </p>
        </section>

        <section class="legal-block" aria-labelledby="haftung">
            <h2 id="haftung">Haftung für Inhalte und Links</h2>
            <p>
                Die Inhalte dieser Website wurden mit Sorgfalt erstellt. Für die Richtigkeit,
                Vollständigkeit und Aktualität können wir jedoch keine Gewähr übernehmen.
                Für Inhalte verlinkter externer Seiten sind ausschließlich deren Betreiber verantwortlich.
            </p>
        </section>

        <p class="legal-updated">Stand: {{ $updated->locale('de')->isoFormat('D. MMMM YYYY') }}</p>
    @else
        <section class="legal-block" aria-labelledby="provider">
            <h2 id="provider">Provider information</h2>
            <p>
                <strong>{{ $op['name'] }}</strong><br>
                {{ $op['trade_name'] }}
            </p>
            <address>
                {{ $op['street'] }}<br>
                {{ $op['postal'] }} {{ $op['city'] }}<br>
                {{ $op['country_en'] }}
            </address>
            <p>
                Email: <a href="mailto:{{ $op['email'] }}">{{ $op['email'] }}</a><br>
                Phone: <a href="tel:{{ $op['phone_href'] }}">{{ $op['phone'] }}</a>
            </p>
            <p>
                {{ $op['name'] }} operates this informational site for the Jeff Aug / Murat Parlak Quintet
                tour and album. MAXIMUM Booking is a sole proprietorship and is not entered in the commercial register.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="vat">
            <h2 id="vat">VAT ID</h2>
            <p>
                VAT identification number under German VAT law (§ 27a UStG):<br>
                <strong>{{ $op['vat_id'] }}</strong>
            </p>
        </section>

        <section class="legal-block" aria-labelledby="content">
            <h2 id="content">Responsible for content</h2>
            <p>
                {{ $op['name'] }}<br>
                {{ $op['street'] }}<br>
                {{ $op['postal'] }} {{ $op['city'] }}<br>
                {{ $op['country_en'] }}
            </p>
            <p>
                Booking:
                <a href="{{ config('tour.contacts.booking.url') }}" rel="noopener noreferrer">Maximum Booking</a>
                · Press:
                <a href="{{ config('tour.contacts.press.url') }}" rel="noopener noreferrer">Hot Mistake PR</a>
            </p>
        </section>

        <section class="legal-block" aria-labelledby="liability">
            <h2 id="liability">Liability for content and links</h2>
            <p>
                Content on this site is prepared with care, but we cannot guarantee completeness or accuracy.
                Operators of linked external sites are solely responsible for their own content.
            </p>
        </section>

        <p class="legal-updated">Last updated: {{ $updated->locale('en')->isoFormat('D MMMM YYYY') }}</p>
    @endif
</x-legal-layout>
