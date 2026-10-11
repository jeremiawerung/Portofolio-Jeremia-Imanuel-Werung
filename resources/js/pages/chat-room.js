import { errorMessage, requestJson } from '../lib/http';

const root = document.getElementById('chat-room');

const POLL_MS = 5000;

if (root) {
    const list = root.querySelector('[data-chat-list]');
    const form = root.querySelector('[data-chat-form]');
    const nameInput = form.querySelector('input[name="name"]');
    const messageInput = form.querySelector('textarea[name="message"]');
    const honeypot = form.querySelector('input[name="website"]');
    const errorBox = root.querySelector('[data-chat-error]');
    const counter = root.querySelector('[data-chat-count]');
    const isAdmin = root.dataset.isAdmin === '1';

    const shownIds = new Set();
    let lastId = 0;
    let pollTimer = null;

    // localStorage bisa diblok browser (mode private), jadi dibungkus try/catch
    const storage = {
        get(key, fallback) {
            try { return JSON.parse(localStorage.getItem(key)) ?? fallback; } catch { return fallback; }
        },
        set(key, value) {
            try { localStorage.setItem(key, JSON.stringify(value)); } catch { /* abaikan */ }
        },
    };

    const myIds = new Set(storage.get('chat-my-ids', []));

    if (nameInput) {
        nameInput.value = storage.get('chat-name', '');
    }

    const formatTime = (iso) => {
        const date = new Date(iso);
        const time = date.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
        const isToday = date.toDateString() === new Date().toDateString();
        return isToday ? time : `${date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}, ${time}`;
    };

    const nearBottom = () => list.scrollHeight - list.scrollTop - list.clientHeight < 120;
    const scrollToBottom = () => { list.scrollTop = list.scrollHeight; };

    function messageNode(message) {
        const mine = myIds.has(message.id);

        const wrapper = document.createElement('div');
        wrapper.className = `flex gap-3 ${mine ? 'flex-row-reverse' : ''}`;
        wrapper.dataset.id = message.id;

        const avatar = document.createElement('div');
        avatar.className = message.is_author
            ? 'w-8 h-8 shrink-0 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center text-xs font-bold text-white'
            : 'w-8 h-8 shrink-0 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-200';
        avatar.textContent = message.name.trim().charAt(0).toUpperCase() || '?';
        avatar.setAttribute('aria-hidden', 'true');

        const body = document.createElement('div');
        body.className = `min-w-0 flex-1 flex flex-col ${mine ? 'items-end' : 'items-start'}`;

        const meta = document.createElement('div');
        meta.className = 'flex flex-wrap items-center gap-2 text-xs';

        const name = document.createElement('span');
        name.className = 'font-semibold text-slate-200';
        name.textContent = message.name;
        meta.appendChild(name);

        if (message.is_author) {
            const badge = document.createElement('span');
            badge.className = 'rounded-full bg-indigo-500/20 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-indigo-200';
            badge.textContent = 'Author';
            meta.appendChild(badge);
        }

        const time = document.createElement('time');
        time.className = 'text-slate-500';
        time.dateTime = message.created_at;
        time.textContent = formatTime(message.created_at);
        meta.appendChild(time);

        if (isAdmin) {
            const remove = document.createElement('button');
            remove.type = 'button';
            remove.className = 'text-slate-500 hover:text-rose-400';
            remove.textContent = 'Delete';
            remove.addEventListener('click', () => deleteMessage(message.id, wrapper));
            meta.appendChild(remove);
        }

        const bubble = document.createElement('div');
        let bubbleClass = 'from-visitor';
        if (mine) bubbleClass = 'from-me';
        else if (message.is_author) bubbleClass = 'from-author';
        bubble.className = `chat-bubble ${bubbleClass} mt-1`;
        bubble.textContent = message.message;

        body.append(meta, bubble);
        wrapper.append(avatar, body);

        return wrapper;
    }

    function append(messages, { forceScroll = false } = {}) {
        const fresh = messages.filter((m) => m && !shownIds.has(m.id));
        if (!fresh.length) return;

        const stick = forceScroll || nearBottom();

        list.querySelector('[data-chat-empty]')?.remove();

        fresh.forEach((message) => {
            shownIds.add(message.id);
            lastId = Math.max(lastId, message.id);
            list.appendChild(messageNode(message));
        });

        if (stick) scrollToBottom();
    }

    function showEmptyState() {
        if (!list.querySelector('[data-id]')) {
            list.replaceChildren();
            const empty = document.createElement('p');
            empty.className = 'text-center text-sm text-slate-500 py-10';
            empty.dataset.chatEmpty = '';
            empty.textContent = 'No messages yet — be the first to say hi! 👋';
            list.appendChild(empty);
        }
    }

    async function loadInitial() {
        try {
            const data = await requestJson(root.dataset.messagesUrl);
            list.replaceChildren();
            append(data.messages, { forceScroll: true });
            showEmptyState();
        } catch {
            list.replaceChildren();
            const failed = document.createElement('p');
            failed.className = 'text-center text-sm text-slate-500 py-10';
            failed.textContent = "Couldn't load messages. Please refresh the page.";
            list.appendChild(failed);
        }
    }

    async function poll() {
        try {
            const data = await requestJson(`${root.dataset.messagesUrl}?after=${lastId}`);
            append(data.messages);
        } catch {
            // Gagal sekali gak apa-apa, dicoba lagi di putaran berikutnya
        }
    }

    function startPolling() {
        stopPolling();
        pollTimer = setInterval(poll, POLL_MS);
    }

    function stopPolling() {
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = null;
    }

    // Tab lagi gak dibuka: berhenti ngecek biar hemat server
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopPolling();
        } else {
            poll();
            startPolling();
        }
    });

    async function deleteMessage(id, node) {
        if (!window.confirm('Delete this message?')) return;

        try {
            await requestJson(`${root.dataset.deleteUrl}/${id}`, { method: 'DELETE' });
            node.remove();
            showEmptyState();
        } catch (error) {
            window.alert(errorMessage(error));
        }
    }

    // ===== Kirim pesan =====

    const autoGrow = () => {
        messageInput.style.height = 'auto';
        messageInput.style.height = `${Math.min(messageInput.scrollHeight, 160)}px`;
        counter.textContent = String(messageInput.value.length);
    };

    messageInput.addEventListener('input', autoGrow);

    // Enter = kirim, Shift+Enter = baris baru
    messageInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && !event.shiftKey && !event.isComposing) {
            event.preventDefault();
            form.requestSubmit();
        }
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        errorBox.textContent = '';

        const name = nameInput?.value.trim() ?? '';
        const message = messageInput.value.trim();

        if (nameInput && !name) {
            errorBox.textContent = 'Please enter your name.';
            nameInput.focus();
            return;
        }

        if (!message) {
            messageInput.focus();
            return;
        }

        const button = form.querySelector('button[type="submit"]');
        button.disabled = true;

        try {
            const data = await requestJson(form.action, {
                method: 'POST',
                body: { name, message, website: honeypot?.value ?? '' },
            });

            if (data.message) {
                myIds.add(data.message.id);
                storage.set('chat-my-ids', [...myIds].slice(-100));
                append([data.message], { forceScroll: true });
            }

            if (nameInput) storage.set('chat-name', name);

            messageInput.value = '';
            autoGrow();
        } catch (error) {
            errorBox.textContent = errorMessage(error);
        } finally {
            button.disabled = false;
            messageInput.focus();
        }
    });

    loadInitial().then(startPolling);
}
