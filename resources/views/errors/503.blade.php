<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta http-equiv="refresh" content="15">
    <title>Updating · Listen Up, Jazzhole!</title>
    <style>
        :root {
            --ink: #0b0d12;
            --navy: #0f2a6b;
            --navy-deep: #071536;
            --paper: #f3f1eb;
            --signal: #e84e1b;
            --mute: rgba(243, 241, 235, 0.72);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100svh;
            display: grid;
            place-items: center;
            padding: clamp(1.25rem, 4vw, 2.5rem);
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
            color: var(--paper);
            background:
                radial-gradient(ellipse 70% 50% at 85% 15%, rgba(232, 78, 27, 0.28), transparent 55%),
                linear-gradient(165deg, var(--navy-deep), var(--navy) 55%, #163a8a);
        }

        main {
            width: min(36rem, 100%);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            margin: 0 0 1.25rem;
            font-size: 0.8rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--mute);
        }

        .status-dot {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 50%;
            background: var(--signal);
            flex-shrink: 0;
        }

        .brand {
            margin: 0;
            font-family: Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
            font-size: clamp(2.6rem, 10vw, 4.4rem);
            line-height: 0.9;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .brand span {
            color: var(--signal);
            font-family: "Segoe Print", "Comic Sans MS", cursive;
            font-size: 0.78em;
            letter-spacing: 0;
            text-transform: none;
            display: inline-block;
            transform: rotate(-2deg);
        }

        h1 {
            margin: 1.5rem 0 0.85rem;
            max-width: 16ch;
            font-size: clamp(1.55rem, 4.5vw, 2.1rem);
            font-weight: 650;
            line-height: 1.2;
            letter-spacing: -0.02em;
            text-wrap: balance;
        }

        .message {
            margin: 0;
            max-width: 36ch;
            color: var(--mute);
            font-size: 1.05rem;
            line-height: 1.55;
        }

        a {
            display: inline-flex;
            align-items: center;
            margin-top: 1.75rem;
            min-height: 3rem;
            padding: 0.7rem 1.2rem;
            background: var(--signal);
            color: #fff;
            font-family: Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
            font-size: 1.1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
        }

        a:hover { filter: brightness(1.06); }
        a:focus-visible { outline: 3px solid #fff; outline-offset: 3px; }

        .meta {
            margin-top: 2.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(243, 241, 235, 0.5);
        }

        @media (prefers-reduced-motion: no-preference) {
            .status-dot {
                animation: pulse 2.4s ease-in-out infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.45; transform: scale(0.85); }
            }
        }
    </style>
</head>
<body>
    <main aria-labelledby="maintenance-title">
        <p class="eyebrow">
            <span class="status-dot" aria-hidden="true"></span>
            Site update in progress
        </p>
        <p class="brand">Listen Up,<br><span>Jazzhole!</span></p>
        <h1 id="maintenance-title">Back in a moment.</h1>
        <p class="message">
            We’re installing an update. The page will reopen automatically — try again shortly.
        </p>
        <a href="/">Try again</a>
        <p class="meta">listenupjazzhole.com · 503</p>
    </main>
</body>
</html>
