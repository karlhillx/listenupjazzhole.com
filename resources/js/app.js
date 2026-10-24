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

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWatch, { once: true });
} else {
    initWatch();
}
