# Portofolio Jeremia (jeremiawerung.my.id) - Aturan Proyek

## Bahasa

- Ngobrol, komentar kode, pesan commit, dan dokumen: bahasa Indonesia santai.
- **Teks yang tampil di web: bahasa Inggris** (semua halaman Inggris, gak ada tombol ganti bahasa, keputusan 17 Okt 2026).
- **Jangan pakai em dash, en dash, titik tengah, panah, atau simbol jarang lain** di mana pun (kode, teks UI, dokumen, balasan). Pakai koma, titik, atau strip biasa (-).

## Wajib dibaca dulu

1. Aturan global: `C:/laragon/notes/aturan-ai.md` (kapan wajib izin, format konfirmasi A-D)
2. Aturan security: `C:/laragon/notes/aturan-security-laravel.md`
3. Status + riwayat proyek: `C:/laragon/notes/inbox/redesign-portofolio-dashboard.md` (35KB, baca per bagian pakai Grep)

Urutan kalau bentrok: aturan global > aturan security > file ini.

## Konteks proyek

Portofolio pribadi Jeremia, Laravel 12 + SQLite + Tailwind 4 (Vite). **LIVE** di https://jeremiawerung.my.id. Repo GitHub `jeremiawerung/Portofolio-Jeremia-Imanuel-Werung`, branch `main`.

- Halaman ada di `resources/views/pages/*`, pakai layout `layouts/portal.blade.php` (sidebar di `layouts/sidebar.blade.php`). Teks panjang Case Studies di `pages/partials/`.
- File lama **gak dipakai lagi tapi masih ada**: `resources/views/welcome.blade.php`, `layouts/app.blade.php`, `sections/*`. Jangan dipakai buat fitur baru. Hapusnya ikut izin Jeremia.
- Warna pakai token di `resources/css/app.css` (`text-ink`, `bg-surface`, `border-line`, `text-accent`, `text-good`, dst). Mode terang/gelap, aksen terracotta, font Newsreader + IBM Plex. Ikon Lucide (`data-lucide="..."`).
- Root repo banyak file pribadi yang untracked (CV, xlsx, sertifikat, `Belajar_QA/`, `e2e/`, dll). **Jangan ikut di-commit**, `git add` file yang emang diubah aja.

### Fitur

| Fitur | Lokasi | Catatan |
|---|---|---|
| Dashboard data asli | `app/Services/Dashboard/*`, `resources/js/pages/dashboard.js` | Site analytics bikinan sendiri (tanpa cookie, IP di-hash), GitHub contributions, WakaTime. Data diambil lewat JS dari `/dashboard/data/*` |
| WakaTime | `WakaTimeStats.php` + `WakaTimeOAuth.php` | OAuth (API key cuma buat plugin mulai 1 Nov 2026). Admin klik **Connect WakaTime** di `/dashboard` sekali, token terenkripsi di `storage/app/private/wakatime/token.enc`, refresh otomatis |
| Chat Room | `ChatRoomController`, `pages/chat-room.blade.php` | Pengunjung cukup isi nama. Link diblok, honeypot, limit per IP. Admin bisa bales sebagai Author dan hapus pesan |
| Smart Talk (AI) | `app/Services/SmartTalk.php`, pengetahuan di `resources/ai/smart-talk.md` | OpenAI-compatible (default Groq). Ada batas harian global. Simbol AI disaring di `SmartTalk::humanize()` |
| My Fantasy Mode | `public/fantasy` (gitignored), `FantasyController` | Mode rahasia Gengar, lihat bagian bawah |
| Admin | `/admin/login` (gak ada link di menu) | Akun dibikin lewat `php artisan portfolio:make-admin`. Gate `admin` di `AppServiceProvider` |
| `/belajar` | `BelajarController` | Tracker belajar QA, cuma nyala kalau `APP_ENV=local` |

### My Fantasy Mode (Gengar)

- Kode + aset ada di `public/fantasy`, **gitignored**. Sumber aslinya di `C:\laragon\www\gengar-mockup\fantasy`, di-upload manual lewat `scp` (izin Jeremia dulu).
- Layout cuma muat mode ini kalau `public/fantasy/js/index.js` ada.
- **Tiap update file mode Gengar, naikin `?v=` di semua import JS + file GLB.** Server gak ngirim Cache-Control, jadi tanpa itu pengunjung lama dapet file basi.
- Penghitung penemu di `/fantasy-mode/found` (POST) dan `/fantasy-mode/count`. **Pas tes ke web live, cegat POST `/fantasy-mode/found`** biar angka asli gak ketambah.

## Secret dan config

- `SMART_TALK_API_KEY`, `GITHUB_TOKEN`, `WAKATIME_CLIENT_ID`, `WAKATIME_CLIENT_SECRET` diisi **Jeremia sendiri** di `.env`. Contoh kosongnya di `.env.example`.
- Jangan pernah buka atau nampilin isi `.env`. Cukup bilang "ada" / "gak ada".
- `env()` cuma boleh di `config/`. Secret di `config/services.php`, angka batas di `config/portfolio.php`.
- Token atau key gak boleh nyampe ke view, JSON, atau log. Pesan error API luar cukup status code.

## Cara kerja

- Edit kode di laptop boleh kalau Jeremia udah kasih izin di sesi itu. **Commit, push, deploy, ssh/scp, migration, install paket wajib izin** (format A-D).
- Commit **tanpa** baris `Co-Authored-By` atau atribusi AI apa pun.
- API luar: pakai trait `RemembersLastGood` (cache + data terakhir yang bagus + lock). **Jangan pakai cron/scheduler**, hosting gak ngizinin. Data diambil ulang pas halaman dibuka dan cache-nya udah basi.
- Fitur baru wajib ada feature test. API luar di-test pakai `Http::preventStrayRequests()` + `Http::fake()`.
- Ganti cara = hapus cara lama (cek pakai Grep dulu kalau masih dipanggil).

### Aturan desain Jeremia

- Aset/hiasan harus punya fungsi (identitas, feedback aksi, empty state, penanda bagian), bukan pajangan.
- Gak ada blank space gede. Gak boleh nutupin tombol/teks. Efek gak boleh ngehalangin aksi (misal kartu flip pas hover jadi gak bisa diklik).
- Sebelum nyerahin, review sendiri sebagai UI/UX, bukan cuma cek error.

## Test

- `php artisan test`. `phpunit.xml` pakai SQLite `:memory:`. **Jangan dibalikin ke file database**, `RefreshDatabase` bisa ngapus `database/database.sqlite` asli.
- `vendor/bin/pint --test` buat cek gaya kode file yang diubah (`BelajarController.php` emang belum rapi, biarin).

## Deploy (rumahweb)

- Server SSH alias `rumahweb`, proyek di `~/laravel/portofolio`, PHP `/opt/cpanel/ea-php84/root/usr/bin/php`. Docroot domain = symlink ke `public/`. Gak ada Composer di server, `vendor` + `public/build` disiapin di laptop.
- **Jangan timpa** `.env`, `database/database.sqlite`, dan isi `storage/` (termasuk token WakaTime).
- `public/.htaccess` di server punya **2 blok khusus server** yang gak ada di repo. Tiap redeploy wajib dipasang ulang: redirect https di paling atas (kecualiin `/.well-known/`), handler `ea-php84` di paling bawah (salin dari `~/laravel/presensi-demo/public/.htaccess`).
- Abis upload: `artisan migrate --force` (kalau ada migration, izin dulu), `config:cache`, `route:cache`, `view:cache`. `artisan about` gak jalan di server (`proc_open` dimatiin).
- Server pakai `CACHE_STORE=file`, `SESSION_DRIVER=file`, SQLite WAL. Tes beban ke server maksimal 10 request barengan (batas LVE).
- Langkah lengkap ada di vault, bagian "Cara deploy (rumahweb)".

## File acuan pola kode

- `app/Services/Dashboard/RemembersLastGood.php`: cache tahan banting tanpa cron
- `app/Services/Dashboard/WakaTimeStats.php` + `WakaTimeOAuth.php`: API luar + token terenkripsi + refresh
- `app/Http/Controllers/ChatRoomController.php`: validasi, sanitasi, anti spam, data publik lewat `toPublicArray()`
- `tests/Feature/WakaTimeTest.php`: pola test `Http::fake` + `Storage::fake`

## Perintah yang sering dipakai

```sh
php artisan test                     # semua test
php artisan portfolio:make-admin     # bikin akun admin (Chat Room + Connect WakaTime)
npm run build                        # build aset Vite ke public/build (wajib sebelum deploy)
php artisan route:list --except-vendor
```
