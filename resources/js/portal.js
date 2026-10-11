// Buka/tutup sidebar di layar kecil
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
const openButton = document.getElementById('sidebar-open');
const closeButton = document.getElementById('sidebar-close');

if (sidebar && openButton) {
    const setOpen = (open) => {
        sidebar.classList.toggle('open', open);
        overlay?.classList.toggle('hidden', !open);
        openButton.setAttribute('aria-expanded', String(open));
        document.body.style.overflow = open ? 'hidden' : '';
    };

    openButton.addEventListener('click', () => setOpen(true));
    closeButton?.addEventListener('click', () => setOpen(false));
    overlay?.addEventListener('click', () => setOpen(false));

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && sidebar.classList.contains('open')) {
            setOpen(false);
        }
    });

    // Kalau layar dilebarin ke ukuran desktop, pastiin scroll gak kekunci
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
        if (event.matches) {
            setOpen(false);
        }
    });
}
