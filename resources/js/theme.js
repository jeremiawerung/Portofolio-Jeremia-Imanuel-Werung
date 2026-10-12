// Tombol ganti mode terang/gelap di sidebar.
// Mode awal udah dipasang script kecil di <head> (biar gak kedip), file ini
// cuma ngurus tombolnya sama ngikutin setelan HP/laptop kalau belum dipilih.
const root = document.documentElement;
const buttons = document.querySelectorAll('[data-theme-value]');
const systemDark = window.matchMedia('(prefers-color-scheme: dark)');

// localStorage bisa diblok browser (mode private), jadi dibungkus try/catch
const saved = {
    get() {
        try { return localStorage.getItem('theme'); } catch { return null; }
    },
    set(value) {
        try { localStorage.setItem('theme', value); } catch { /* abaikan */ }
    },
};

function apply(theme) {
    root.dataset.theme = theme;
    buttons.forEach((button) => {
        button.setAttribute('aria-pressed', String(button.dataset.themeValue === theme));
    });
}

apply(root.dataset.theme || (systemDark.matches ? 'dark' : 'light'));

buttons.forEach((button) => {
    button.addEventListener('click', () => {
        saved.set(button.dataset.themeValue);
        apply(button.dataset.themeValue);
    });
});

// Selama pengunjung belum milih sendiri, ikutin kalau setelan HP/laptop berubah
systemDark.addEventListener('change', (event) => {
    if (!saved.get()) {
        apply(event.matches ? 'dark' : 'light');
    }
});
