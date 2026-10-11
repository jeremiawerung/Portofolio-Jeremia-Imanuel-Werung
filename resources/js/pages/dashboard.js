import { requestJson } from '../lib/http';
import { hideTooltip, showTooltip } from '../lib/tooltip';

const SERIES = {
    page_views: { label: 'Page views', color: 'var(--color-series-1)' },
    visitors: { label: 'Visitors', color: 'var(--color-series-2)' },
};

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// ===== Helper format =====

const formatNumber = (value) => (value >= 10000
    ? new Intl.NumberFormat('en', { notation: 'compact', maximumFractionDigits: 1 }).format(value)
    : Number(value).toLocaleString('en'));

const formatDate = (iso, options = { month: 'long', day: 'numeric', year: 'numeric' }) => (iso
    ? new Date(`${iso.slice(0, 10)}T00:00:00`).toLocaleDateString('en-US', options)
    : '—');

function timeAgo(iso) {
    const seconds = Math.max(0, (Date.now() - new Date(iso).getTime()) / 1000);
    const rtf = new Intl.RelativeTimeFormat('en', { numeric: 'auto' });

    if (seconds < 60) return 'just now';
    if (seconds < 3600) return rtf.format(-Math.round(seconds / 60), 'minute');
    if (seconds < 86400) return rtf.format(-Math.round(seconds / 3600), 'hour');
    return rtf.format(-Math.round(seconds / 86400), 'day');
}

function el(tag, className, text) {
    const node = document.createElement(tag);
    if (className) node.className = className;
    if (text !== undefined) node.textContent = text;
    return node;
}

// Angka naik pelan dari 0 biar kerasa "live"
function setNumber(target, value, suffix = '') {
    target.replaceChildren();
    const number = el('span');
    target.appendChild(number);

    if (suffix) {
        target.append(' ', el('small', '', suffix));
    }

    const isDecimal = !Number.isInteger(value);

    if (reduceMotion || value === 0) {
        number.textContent = isDecimal ? value.toFixed(1) : formatNumber(value);
        return;
    }

    const start = performance.now();
    const duration = 900;

    const tick = (now) => {
        const progress = Math.min(1, (now - start) / duration);
        const eased = 1 - (1 - progress) ** 3;
        const current = value * eased;
        number.textContent = isDecimal ? current.toFixed(1) : formatNumber(Math.round(current));
        if (progress < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
}

function setText(section, key, text) {
    const target = section.querySelector(`[data-stat="${key}"]`);
    if (target) target.textContent = text;
}

function showFailure(section) {
    section.querySelectorAll('[data-stat]').forEach((node) => { node.textContent = '—'; });
    section.querySelectorAll('[data-chart], [data-list]').forEach((node) => {
        node.replaceChildren(el('p', 'text-sm text-slate-500', "Couldn't load this data right now. Please check back later."));
    });
}

// ===== Daftar dengan batang kecil (halaman terpopuler, bahasa) =====

function renderMeterList(list, items, { label, value, display, empty }) {
    if (!items.length) {
        list.replaceChildren(el('li', 'text-sm text-slate-500', empty));
        return;
    }

    const max = Math.max(...items.map(value), 1);

    list.replaceChildren(...items.map((item) => {
        const li = el('li');
        const row = el('div', 'flex items-center justify-between gap-3 text-sm mb-1.5');
        row.append(el('span', 'text-slate-200 truncate', label(item)), el('span', 'text-slate-400 shrink-0', display(item)));

        const track = el('div', 'meter-track');
        const fill = el('div', 'meter-fill');
        fill.style.width = '0%';
        track.appendChild(fill);
        li.append(row, track);

        requestAnimationFrame(() => { fill.style.width = `${(value(item) / max) * 100}%`; });

        return li;
    }));
}

// ===== Grafik batang bulanan =====

function niceScale(max) {
    if (max <= 4) return { step: 1, top: 4 };

    const rough = max / 4;
    const magnitude = 10 ** Math.floor(Math.log10(rough));
    const normalized = rough / magnitude;
    // Jumlah kunjungan selalu bulat, jadi langkahnya cuma 1/2/5/10 (gak ada 2.5)
    const step = Math.max(1, (normalized <= 1 ? 1 : normalized <= 2 ? 2 : normalized <= 5 ? 5 : 10) * magnitude);

    return { step, top: step * Math.ceil(max / step) };
}

function renderMonthlyChart(container, months) {
    const max = Math.max(...months.flatMap((m) => [m.page_views, m.visitors]), 0);
    const { step, top } = niceScale(max);

    const chart = el('div', 'bar-chart');

    for (let tick = 0; tick <= top; tick += step) {
        const line = el('div', 'bar-grid');
        line.style.bottom = `${(tick / top) * 100}%`;
        line.appendChild(el('span', '', formatNumber(tick)));
        chart.appendChild(line);
    }

    const groups = el('div', 'bar-groups');

    months.forEach((month) => {
        const group = el('div', 'bar-group');
        const monthName = formatDate(`${month.month}-01`, { month: 'long', year: 'numeric' });
        group.tabIndex = 0;
        group.setAttribute('aria-label', `${monthName}: ${month.page_views} page views, ${month.visitors} visitors`);

        Object.entries(SERIES).forEach(([key, series]) => {
            const bar = el('div', 'bar');
            bar.style.background = series.color;
            bar.style.height = '0%';
            group.appendChild(bar);
            requestAnimationFrame(() => { bar.style.height = `${(month[key] / top) * 100}%`; });
        });

        const show = () => showTooltip([
            { text: monthName, strong: true },
            ...Object.entries(SERIES).map(([key, series]) => ({
                text: `${series.label}: ${month[key].toLocaleString('en')}`,
                color: series.color,
            })),
        ], group);

        group.addEventListener('mouseenter', show);
        group.addEventListener('focus', show);
        group.addEventListener('mouseleave', hideTooltip);
        group.addEventListener('blur', hideTooltip);

        groups.appendChild(group);
    });

    chart.appendChild(groups);

    const labels = el('div', 'bar-labels');
    months.forEach((month) => labels.appendChild(el('span', '', month.label)));

    container.replaceChildren(chart, labels);

    if (max === 0) {
        container.appendChild(el('p', 'mt-3 text-center text-xs text-slate-500', 'No traffic recorded yet — the chart fills in as people visit.'));
    }
}

function renderMonthlyTable(table, months) {
    table.querySelector('tbody').replaceChildren(...months.map((month) => {
        const row = el('tr');
        row.append(
            el('td', '', formatDate(`${month.month}-01`, { month: 'long', year: 'numeric' })),
            el('td', '', month.page_views.toLocaleString('en')),
            el('td', '', month.visitors.toLocaleString('en')),
        );
        return row;
    }));
}

const PAGE_NAMES = {
    '/': 'Home',
    '/about': 'About',
    '/achievements': 'Achievements',
    '/projects': 'Projects',
    '/case-studies': 'Case Studies',
    '/insights': 'Insights',
    '/dashboard': 'Dashboard',
    '/chat-room': 'Chat Room',
    '/contact': 'Contact',
    '/smart-talk': 'Smart Talk',
};

function renderAnalytics(section, data) {
    Object.entries(data.totals).forEach(([key, value]) => {
        const target = section.querySelector(`[data-stat="${key}"]`);
        if (target) setNumber(target, value);
    });

    const since = section.querySelector('[data-field="tracking_since"]');
    if (since && data.tracking_since) {
        since.textContent = `Tracking since ${formatDate(data.tracking_since, { month: 'short', day: 'numeric', year: 'numeric' })}`;
    }

    renderMonthlyChart(section.querySelector('[data-chart="monthly"]'), data.monthly);
    renderMonthlyTable(section.querySelector('[data-table="monthly"]'), data.monthly);

    renderMeterList(section.querySelector('[data-list="top_pages"]'), data.top_pages, {
        label: (item) => PAGE_NAMES[item.label] ?? item.label,
        value: (item) => item.total,
        display: (item) => `${item.total.toLocaleString('en')} ${item.total === 1 ? 'view' : 'views'}`,
        empty: 'No page views in the last 30 days yet.',
    });

    renderMeterList(section.querySelector('[data-list="top_referrers"]'), data.top_referrers, {
        label: (item) => item.label,
        value: (item) => item.total,
        display: (item) => `${item.total.toLocaleString('en')} ${item.total === 1 ? 'visit' : 'visits'}`,
        empty: 'Mostly direct visits so far.',
    });
}

// ===== Grafik kontribusi GitHub =====

// Ukuran kotak ngikutin lebar kartu (min 10px, max 16px), jarak antar kotak 3px
function cellSize(container, weekCount) {
    const fit = Math.floor((container.clientWidth + 3) / weekCount) - 3;
    return Math.max(10, Math.min(16, fit));
}

function renderHeatmap(container, weeks, total) {
    const cell = cellSize(container, weeks.length);
    const COLUMN = cell + 3;
    container.style.setProperty('--cell', `${cell}px`);

    const months = el('div', 'heat-months');
    let lastMonth = null;
    let lastLabelColumn = -10;

    weeks.forEach((week, column) => {
        const firstDay = week.find(Boolean);
        if (!firstDay) return;

        const month = firstDay.date.slice(0, 7);
        if (month !== lastMonth && column - lastLabelColumn >= 3) {
            const label = el('span', '', formatDate(firstDay.date, { month: 'short' }));
            label.style.left = `${column * COLUMN}px`;
            months.appendChild(label);
            lastLabelColumn = column;
        }
        lastMonth = month;
    });

    const grid = el('div', 'heatmap');
    grid.setAttribute('role', 'img');
    grid.setAttribute('aria-label', `${total} contributions in the last year`);

    weeks.forEach((week) => {
        for (let i = 0; i < 7; i++) {
            const day = week[i];
            const cell = el('span', day ? 'heat-cell' : 'heat-cell is-empty');
            if (day) {
                cell.dataset.level = String(day.level);
                cell.dataset.date = day.date;
                cell.dataset.count = String(day.count);
            }
            grid.appendChild(cell);
        }
    });

    grid.addEventListener('mouseover', (event) => {
        const cell = event.target.closest('.heat-cell[data-date]');
        if (!cell) return;
        const count = Number(cell.dataset.count);
        showTooltip([
            { text: `${count === 0 ? 'No' : count} contribution${count === 1 ? '' : 's'}`, strong: true },
            { text: formatDate(cell.dataset.date, { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' }) },
        ], cell);
    });
    grid.addEventListener('mouseleave', hideTooltip);

    const wrapper = el('div');
    wrapper.style.width = 'max-content';
    months.style.width = `${weeks.length * COLUMN}px`;
    wrapper.append(months, grid);

    container.replaceChildren(wrapper);

    // Di layar sempit, langsung tampilin minggu-minggu terbaru (paling kanan)
    container.scrollLeft = container.scrollWidth;
}

function renderGithub(section, data) {
    ['total', 'this_week', 'best', 'average'].forEach((key) => {
        const target = section.querySelector(`[data-stat="${key}"]`);
        if (target) setNumber(target, data[key], target.dataset.suffix);
    });

    const container = section.querySelector('[data-chart="heatmap"]');
    renderHeatmap(container, data.weeks, data.total);

    // Gambar ulang kalau lebar kartu berubah (layar diputar/di-resize)
    let lastWidth = container.clientWidth;
    let timer;
    new ResizeObserver(() => {
        if (container.clientWidth === lastWidth) return;
        lastWidth = container.clientWidth;
        clearTimeout(timer);
        timer = setTimeout(() => renderHeatmap(container, data.weeks, data.total), 150);
    }).observe(container);
}

// ===== WakaTime =====

function renderWakatime(section, data) {
    setText(section, 'start_date', formatDate(data.start_date));
    setText(section, 'end_date', formatDate(data.end_date));
    setText(section, 'daily_average', data.daily_average || '—');
    setText(section, 'total_week', data.total_week || '—');
    setText(section, 'all_time', data.all_time || '—');
    setText(section, 'best_day', data.best_day?.date
        ? `${formatDate(data.best_day.date)} (${data.best_day.text})`
        : '—');

    const updated = section.querySelector('[data-field="updated_at"]');
    if (updated) updated.textContent = `Last update: ${timeAgo(data.updated_at)}`;

    renderMeterList(section.querySelector('[data-list="languages"]'), data.languages, {
        label: (item) => item.name,
        value: (item) => item.percent,
        display: (item) => `${item.text} · ${item.percent}%`,
        empty: 'No coding activity recorded this week.',
    });
}

// ===== Jalanin semua =====

const renderers = {
    analytics: renderAnalytics,
    github: renderGithub,
    wakatime: renderWakatime,
};

document.querySelectorAll('[data-dashboard]').forEach(async (section) => {
    const render = renderers[section.dataset.dashboard];

    try {
        const data = await requestJson(section.dataset.endpoint);
        render(section, data);
    } catch (error) {
        showFailure(section);
    }
});
