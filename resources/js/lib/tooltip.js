// Satu tooltip dipakai bareng semua grafik. Isinya dibangun pakai
// textContent (bukan innerHTML) biar data dari luar gak bisa nyisipin HTML.
let tip;

function element() {
    if (!tip) {
        tip = document.createElement('div');
        tip.className = 'chart-tooltip';
        tip.hidden = true;
        tip.setAttribute('role', 'tooltip');
        document.body.appendChild(tip);
    }
    return tip;
}

/**
 * @param {Array<{text: string, color?: string, strong?: boolean}>} lines
 */
export function showTooltip(lines, anchor) {
    const box = element();
    box.replaceChildren(...lines.map((line) => {
        const row = document.createElement('div');
        row.style.display = 'flex';
        row.style.alignItems = 'center';
        row.style.gap = '6px';

        if (line.color) {
            const swatch = document.createElement('span');
            swatch.className = 'legend-swatch';
            swatch.style.background = line.color;
            row.appendChild(swatch);
        }

        const text = document.createElement('span');
        text.textContent = line.text;
        if (line.strong) {
            text.style.fontWeight = '600';
        }
        row.appendChild(text);

        return row;
    }));

    box.hidden = false;

    const rect = anchor.getBoundingClientRect();
    const boxRect = box.getBoundingClientRect();
    const left = Math.min(
        Math.max(8, rect.left + rect.width / 2 - boxRect.width / 2),
        window.innerWidth - boxRect.width - 8,
    );
    const top = rect.top - boxRect.height - 8 < 8 ? rect.bottom + 8 : rect.top - boxRect.height - 8;

    box.style.left = `${left}px`;
    box.style.top = `${top}px`;
}

export function hideTooltip() {
    if (tip) {
        tip.hidden = true;
    }
}

window.addEventListener('scroll', hideTooltip, { passive: true });
