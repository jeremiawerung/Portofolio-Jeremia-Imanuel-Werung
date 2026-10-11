import { errorMessage, requestJson } from '../lib/http';

const root = document.getElementById('smart-talk');

const MAX_HISTORY = 12;

// Ubah teks jawaban AI jadi elemen aman. Cuma dukung **tebal**, `kode`,
// paragraf, sama daftar "- ". Gak pernah pakai innerHTML.
function inline(text) {
    const fragment = document.createDocumentFragment();

    text.split(/(\*\*[^*]+\*\*|`[^`]+`)/g).forEach((part) => {
        if (!part) return;

        if (part.startsWith('**') && part.endsWith('**') && part.length > 4) {
            const strong = document.createElement('strong');
            strong.textContent = part.slice(2, -2);
            fragment.appendChild(strong);
        } else if (part.startsWith('`') && part.endsWith('`') && part.length > 2) {
            const code = document.createElement('code');
            code.className = 'rounded bg-slate-800 px-1 py-0.5 text-[0.85em]';
            code.textContent = part.slice(1, -1);
            fragment.appendChild(code);
        } else {
            fragment.appendChild(document.createTextNode(part));
        }
    });

    return fragment;
}

function renderRichText(text) {
    const fragment = document.createDocumentFragment();

    text.trim().split(/\n{2,}/).forEach((block) => {
        const lines = block.split('\n').map((line) => line.trim()).filter(Boolean);
        if (!lines.length) return;

        const isList = lines.every((line) => /^([-*•]|\d+\.)\s+/.test(line));

        if (isList) {
            const ul = document.createElement('ul');
            lines.forEach((line) => {
                const li = document.createElement('li');
                li.appendChild(inline(line.replace(/^([-*•]|\d+\.)\s+/, '')));
                ul.appendChild(li);
            });
            fragment.appendChild(ul);
            return;
        }

        const p = document.createElement('p');
        lines.forEach((line, index) => {
            if (index > 0) p.appendChild(document.createElement('br'));
            p.appendChild(inline(line.replace(/^#{1,6}\s+/, '')));
        });
        fragment.appendChild(p);
    });

    return fragment;
}

if (root) {
    const list = root.querySelector('[data-talk-list]');
    const form = root.querySelector('[data-talk-form]');
    const input = form.querySelector('textarea');
    const errorBox = root.querySelector('[data-talk-error]');
    const suggestions = root.querySelector('[data-talk-suggestions]');
    const button = form.querySelector('button[type="submit"]');

    const history = [];
    let busy = false;

    const scrollToBottom = () => { list.scrollTop = list.scrollHeight; };

    function aiAvatar() {
        const avatar = document.createElement('div');
        avatar.className = 'w-8 h-8 shrink-0 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center text-white';
        avatar.setAttribute('aria-hidden', 'true');
        avatar.textContent = '✦';
        return avatar;
    }

    function addUserBubble(text) {
        const row = document.createElement('div');
        row.className = 'flex justify-end';
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble from-me';
        bubble.textContent = text;
        row.appendChild(bubble);
        list.appendChild(row);
        scrollToBottom();
    }

    function addAiBubble(content) {
        const row = document.createElement('div');
        row.className = 'flex gap-3';
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble from-ai';
        bubble.appendChild(content);
        row.append(aiAvatar(), bubble);
        list.appendChild(row);
        scrollToBottom();
        return row;
    }

    function typingIndicator() {
        const dots = document.createElement('span');
        dots.className = 'typing-dots';
        dots.setAttribute('aria-label', 'Smart Talk is typing');
        dots.append(document.createElement('span'), document.createElement('span'), document.createElement('span'));
        return addAiBubble(dots);
    }

    const autoGrow = () => {
        input.style.height = 'auto';
        input.style.height = `${Math.min(input.scrollHeight, 160)}px`;
    };

    async function ask(question) {
        if (busy) return;

        const text = question.trim();
        if (!text) return;

        busy = true;
        button.disabled = true;
        errorBox.textContent = '';
        suggestions?.remove();

        history.push({ role: 'user', content: text });
        addUserBubble(text);
        input.value = '';
        autoGrow();

        const typing = typingIndicator();

        try {
            const data = await requestJson(root.dataset.askUrl, {
                method: 'POST',
                body: { messages: history.slice(-MAX_HISTORY) },
            });

            typing.remove();
            history.push({ role: 'assistant', content: data.reply });
            addAiBubble(renderRichText(data.reply));
        } catch (error) {
            typing.remove();
            history.pop(); // pertanyaan yang gagal gak usah ikut dikirim lagi
            errorBox.textContent = errorMessage(error);
        } finally {
            busy = false;
            button.disabled = false;
            input.focus();
        }
    }

    input.addEventListener('input', autoGrow);

    input.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && !event.shiftKey && !event.isComposing) {
            event.preventDefault();
            form.requestSubmit();
        }
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        ask(input.value);
    });

    suggestions?.querySelectorAll('[data-suggestion]').forEach((chip) => {
        chip.addEventListener('click', () => ask(chip.textContent));
    });
}
