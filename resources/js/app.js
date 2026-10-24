const YT_ORIGIN = 'https://www.youtube-nocookie.com';

function youtubeSrc(videoId, { autoplay = false } = {}) {
    const params = new URLSearchParams({
        rel: '0',
        modestbranding: '1',
        playsinline: '1',
    });

    if (autoplay) {
        params.set('autoplay', '1');
    }

    return `${YT_ORIGIN}/embed/${videoId}?${params.toString()}`;
}

function mountPlayer(host, videoId, { autoplay = false } = {}) {
    if (!(host instanceof HTMLElement) || !videoId) {
        return null;
    }

    host.replaceChildren();

    const iframe = document.createElement('iframe');
    iframe.src = youtubeSrc(videoId, { autoplay });
    iframe.title = host.dataset.title || 'Listen Up, Jazzhole! video';
    iframe.allow =
        'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
    iframe.allowFullscreen = true;
    iframe.referrerPolicy = 'strict-origin-when-cross-origin';
    iframe.loading = 'lazy';

    host.appendChild(iframe);
    host.dataset.playing = 'true';

    return iframe;
}

function clearPlayer(host) {
    if (!(host instanceof HTMLElement)) {
        return;
    }

    host.replaceChildren();
    delete host.dataset.playing;
}

function initWatchStage(root) {
    const stage = root.querySelector('[data-watch-stage]');
    const play = root.querySelector('[data-watch-play]');
    const frame = root.querySelector('[data-watch-frame]');
    const videoId = root.dataset.videoId;

    if (!stage || !play || !frame || !videoId) {
        return;
    }

    const startInline = () => {
        if (frame.dataset.playing === 'true') {
            return;
        }

        stage.classList.add('is-playing');
        play.hidden = true;
        mountPlayer(frame, videoId, { autoplay: true });
    };

    play.addEventListener('click', startInline);
    stage.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            startInline();
        }
    });
}

function initWatchDialog(root) {
    const dialog = document.querySelector('[data-watch-dialog]');
    const frame = dialog?.querySelector('[data-watch-dialog-frame]');
    const openers = root.querySelectorAll('[data-watch-open-cinema]');
    const videoId = root.dataset.videoId;

    if (!dialog || !frame || !videoId || !(dialog instanceof HTMLDialogElement)) {
        return;
    }

    const open = () => {
        mountPlayer(frame, videoId, { autoplay: true });
        if (!dialog.open) {
            dialog.showModal();
        }
    };

    const close = () => {
        clearPlayer(frame);
        if (dialog.open) {
            dialog.close();
        }
    };

    openers.forEach((opener) => {
        opener.addEventListener('click', (event) => {
            event.preventDefault();
            open();
        });
    });

    dialog.addEventListener('close', () => clearPlayer(frame));
    dialog.querySelectorAll('[data-watch-close]').forEach((closer) => {
        closer.addEventListener('click', close);
    });

    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) {
            close();
        }
    });
}

function initWatch() {
    const root = document.querySelector('[data-watch]');
    if (!root) {
        return;
    }

    initWatchStage(root);
    initWatchDialog(root);
}

function pad2(value) {
    return String(Math.max(0, value)).padStart(2, '0');
}

function remainingParts(targetMs, nowMs = Date.now()) {
    const total = Math.max(0, targetMs - nowMs);
    const seconds = Math.floor(total / 1000);
    const days = Math.floor(seconds / 86400);
    const hours = Math.floor((seconds % 86400) / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;

    return {
        total,
        days: pad2(days),
        hours: pad2(hours),
        minutes: pad2(minutes),
        seconds: pad2(secs),
    };
}

function setCountdownDigit(cell, nextValue, animate) {
    const digit = cell.querySelector('[data-countdown-digit]');
    if (!digit) {
        return;
    }

    if (digit.textContent === nextValue) {
        return;
    }

    digit.textContent = nextValue;

    if (!animate) {
        return;
    }

    digit.classList.remove('is-tick');
    // Force reflow so the tick animation can replay.
    void digit.offsetWidth;
    digit.classList.add('is-tick');
}

function initCountdown() {
    const root = document.querySelector('[data-countdown]');
    if (!root) {
        return;
    }

    const target = Date.parse(root.dataset.countdownTarget || '');
    if (Number.isNaN(target)) {
        return;
    }

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const cells = {
        days: root.querySelector('[data-countdown-unit="days"]'),
        hours: root.querySelector('[data-countdown-unit="hours"]'),
        minutes: root.querySelector('[data-countdown-unit="minutes"]'),
        seconds: root.querySelector('[data-countdown-unit="seconds"]'),
    };

    const render = (animate) => {
        const parts = remainingParts(target);

        if (parts.total <= 0) {
            root.classList.add('is-live');
            root.querySelector('.countdown__label')?.replaceChildren(document.createTextNode('Tour is live'));
            return false;
        }

        Object.entries(cells).forEach(([unit, cell]) => {
            if (cell) {
                setCountdownDigit(cell, parts[unit], animate && !reduceMotion);
            }
        });

        return true;
    };

    if (!render(false)) {
        return;
    }

    window.setInterval(() => {
        render(true);
    }, 1000);
}

function boot() {
    initWatch();
    initCountdown();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
    boot();
}
