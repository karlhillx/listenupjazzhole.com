@php
    $op = config('legal.operator');
    $host = config('legal.host');
    $updated = \Illuminate\Support\Carbon::parse(config('legal.updated'));
    $video = config('tour.video');
@endphp

<x-legal-layout
    :locale="$locale"
    :title="$locale === 'de' ? 'Datenschutzerklärung' : 'Privacy Policy'"
    :canonical="$locale === 'de' ? '/datenschutz' : '/privacy'"
    :hreflang="['de' => '/datenschutz', 'en' => '/privacy', 'x-default' => '/datenschutz']"
>
    @if ($locale === 'de')
        <p class="legal-intro">
            Diese Erklärung beschreibt den Umgang mit personenbezogenen Daten auf listenupjazzhole.com.
        </p>

        <section class="legal-block" aria-labelledby="verantwortlicher">
            <h2 id="verantwortlicher">1. Verantwortlicher</h2>
            <p>
                <strong>{{ $op['name'] }}</strong> ({{ $op['trade_name'] }})<br>
                {{ $op['street'] }}<br>
                {{ $op['postal'] }} {{ $op['city'] }}<br>
                {{ $op['country'] }}
            </p>
            <p>
                E-Mail: <a href="mailto:{{ $op['email'] }}">{{ $op['email'] }}</a><br>
                Telefon: <a href="tel:{{ $op['phone_href'] }}">{{ $op['phone'] }}</a>
            </p>
        </section>

        <section class="legal-block" aria-labelledby="hosting">
            <h2 id="hosting">2. Hosting</h2>
            <p>
                Die Website wird bei der
                <a href="{{ $host['impressum_url'] }}" rel="noopener noreferrer">{{ $host['name'] }}</a>,
                {{ $host['address'] }}, betrieben. Zur Auslieferung der Seiten werden Verbindungsdaten
                (insbesondere IP-Adresse, Zeitpunkt, angeforderte Ressource, User-Agent) verarbeitet.
            </p>
            <p>
                Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an sicherem und
                zuverlässigem Betrieb). Weitere Angaben:
                <a href="{{ $host['privacy_url'] }}" rel="noopener noreferrer">Datenschutz von Hetzner</a>.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="log">
            <h2 id="log">3. Server- und Zugriffsdaten</h2>
            <p>
                Beim Aufruf der Website entstehen technisch notwendige Protokolldaten. Sie dienen der
                Auslieferung, Fehleranalyse und Absicherung gegen Missbrauch. Eine Auswertung zu
                Marketingzwecken findet nicht statt.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="fonts">
            <h2 id="fonts">4. Schriftarten</h2>
            <p>
                Für die Darstellung werden Schriftarten von fonts.bunny.net geladen. Dabei kann der
                Anbieter Ihre IP-Adresse und technische Browserdaten erhalten. Rechtsgrundlage:
                Art. 6 Abs. 1 lit. f DSGVO (einheitliche, performante Darstellung).
            </p>
        </section>

        <section class="legal-block" aria-labelledby="video">
            <h2 id="video">5. YouTube-Videos</h2>
            <p>
                Auf der Startseite kann ein Video von YouTube eingebettet werden
                (<a href="{{ $video['url'] }}" rel="noopener noreferrer">{{ $video['title'] }}</a>).
                Die Einbettung erfolgt über youtube-nocookie.com und wird erst nach Ihrer aktiven
                Interaktion (Klick auf Abspielen / Cinema Mode) geladen.
            </p>
            <p>
                Nach dem Start verarbeitet Google/YouTube personenbezogene Daten (u. a. IP-Adresse,
                Geräteinformationen). Es können Cookies gesetzt werden. Rechtsgrundlage nach dem Start:
                Art. 6 Abs. 1 lit. a DSGVO bzw. § 25 Abs. 1 TDDDG (Einwilligung durch die Interaktion).
                Details:
                <a href="https://policies.google.com/privacy" rel="noopener noreferrer">Google Datenschutz</a>.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="links">
            <h2 id="links">6. Externe Links</h2>
            <p>
                Verlinkungen zu Facebook, Instagram, Stockfisch Records, Maximum Booking, Hot Mistake PR,
                jeffaug.com, murat-parlak.de und anneclarkofficial.com führen zu Angeboten Dritter.
                Für deren Datenverarbeitung sind ausschließlich die jeweiligen Betreiber verantwortlich.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="cookies">
            <h2 id="cookies">7. Cookies</h2>
            <p>
                Diese Website setzt beim bloßen Besuch keine eigenen Tracking-Cookies.
                Beim Abspielen des YouTube-Videos können Cookies von Google/YouTube gesetzt werden.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="rechte">
            <h2 id="rechte">8. Ihre Rechte</h2>
            <p>
                Sie können Auskunft, Berichtigung, Löschung, Einschränkung der Verarbeitung und
                Datenübertragbarkeit verlangen sowie einer Verarbeitung auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO
                widersprechen. Kontakt: <a href="mailto:{{ $op['email'] }}">{{ $op['email'] }}</a>.
            </p>
            <p>
                Außerdem besteht ein Beschwerderecht bei einer Datenschutzaufsichtsbehörde, z. B. dem
                <a href="https://www.lda.bayern.de/" rel="noopener noreferrer">Bayerischen Landesamt für Datenschutzaufsicht</a>.
            </p>
        </section>

        <p class="legal-updated">Stand: {{ $updated->locale('de')->isoFormat('D. MMMM YYYY') }}</p>
    @else
        <p class="legal-intro">
            This notice explains how personal data is handled on listenupjazzhole.com.
        </p>

        <section class="legal-block" aria-labelledby="controller">
            <h2 id="controller">1. Controller</h2>
            <p>
                <strong>{{ $op['name'] }}</strong> ({{ $op['trade_name'] }})<br>
                {{ $op['street'] }}<br>
                {{ $op['postal'] }} {{ $op['city'] }}<br>
                {{ $op['country_en'] }}
            </p>
            <p>
                Email: <a href="mailto:{{ $op['email'] }}">{{ $op['email'] }}</a><br>
                Phone: <a href="tel:{{ $op['phone_href'] }}">{{ $op['phone'] }}</a>
            </p>
        </section>

        <section class="legal-block" aria-labelledby="hosting-en">
            <h2 id="hosting-en">2. Hosting</h2>
            <p>
                This site is hosted by
                <a href="{{ $host['impressum_url'] }}" rel="noopener noreferrer">{{ $host['name'] }}</a>,
                {{ $host['address'] }}. Connection data (including IP address, time, requested resource, user agent)
                is processed to deliver the pages.
            </p>
            <p>
                Legal basis: Art. 6(1)(f) GDPR (legitimate interest in secure, reliable operation). See also
                <a href="{{ $host['privacy_url'] }}" rel="noopener noreferrer">Hetzner’s privacy policy</a>.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="logs">
            <h2 id="logs">3. Server logs</h2>
            <p>
                Technically necessary log data is created when you visit the site. It is used for delivery,
                troubleshooting and security. It is not used for marketing analytics.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="fonts-en">
            <h2 id="fonts-en">4. Fonts</h2>
            <p>
                Fonts are loaded from fonts.bunny.net. The provider may receive your IP address and technical
                browser data. Legal basis: Art. 6(1)(f) GDPR.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="video-en">
            <h2 id="video-en">5. YouTube videos</h2>
            <p>
                The homepage can embed a YouTube video
                (<a href="{{ $video['url'] }}" rel="noopener noreferrer">{{ $video['title'] }}</a>)
                via youtube-nocookie.com. The player loads only after you click play or cinema mode.
            </p>
            <p>
                After that interaction, Google/YouTube processes personal data (including IP address and device data)
                and may set cookies. Legal basis: Art. 6(1)(a) GDPR / consent under German TDDDG.
                See <a href="https://policies.google.com/privacy" rel="noopener noreferrer">Google’s privacy policy</a>.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="links-en">
            <h2 id="links-en">6. External links</h2>
            <p>
                Links to Facebook, Instagram, Stockfisch Records, Maximum Booking, Hot Mistake PR,
                jeffaug.com, murat-parlak.de and anneclarkofficial.com lead to third-party sites.
                Those operators are responsible for their own processing.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="cookies-en">
            <h2 id="cookies-en">7. Cookies</h2>
            <p>
                This site does not set its own tracking cookies on a normal visit.
                Playing the YouTube video may cause Google/YouTube cookies to be set.
            </p>
        </section>

        <section class="legal-block" aria-labelledby="rights">
            <h2 id="rights">8. Your rights</h2>
            <p>
                You may request access, rectification, erasure, restriction, portability, and object to processing
                based on Art. 6(1)(f) GDPR. Contact:
                <a href="mailto:{{ $op['email'] }}">{{ $op['email'] }}</a>.
            </p>
            <p>
                You may also lodge a complaint with a supervisory authority, for example the
                <a href="https://www.lda.bayern.de/" rel="noopener noreferrer">Bavarian Data Protection Authority</a>.
            </p>
        </section>

        <p class="legal-updated">Last updated: {{ $updated->locale('en')->isoFormat('D MMMM YYYY') }}</p>
    @endif
</x-legal-layout>
