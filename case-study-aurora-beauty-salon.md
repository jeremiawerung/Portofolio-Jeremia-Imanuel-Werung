# Case Study: Sistem Reservasi Aurora Beauty Salon

## Ringkasan Proyek

Aurora Beauty Salon adalah sistem informasi reservasi berbasis web yang dirancang untuk menggantikan proses booking manual (chat WhatsApp & datang langsung) menjadi alur digital yang terstruktur. Sistem ini mencakup pemilihan kategori & layanan, pemilihan slot jadwal, pembayaran online (Midtrans: Virtual Account, E-Wallet, QRIS) dengan skema DP atau lunas, penggunaan voucher diskon, hingga manajemen operasional oleh admin (data master, laporan, booking offline/POS, dan persetujuan pembatalan).

Dalam studi kasus ini, saya berperan sebagai QA yang menganalisis dokumen perancangan sistem (use case, activity, dan sequence diagram) untuk menyusun **user stories**, **skenario pengujian (test case)**, serta menyiapkan **automation script** pada alur-alur kritikal.

> **Catatan transparansi:** studi kasus ini disusun berdasarkan dokumen analisis & perancangan sistem (BAB IV) dan diagram alur bisnis yang tersedia. User stories dan test case di bawah adalah hasil derivasi saya dari diagram tersebut, bukan kutipan langsung dari laporan.

### Insight Teknis dari ERD
Dari struktur tabel `users` (kolom `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `profile_photo_path`), sistem ini kemungkinan besar dibangun di atas **Laravel** dengan auth scaffolding khas Jetstream/Fortify. Ini penting buat strategi pengujian: sesi login berbasis cookie, dan kemungkinan ada fitur 2FA yang perlu dites terpisah dari login biasa.

---

## 1. Latar Belakang & Permasalahan

Proses bisnis sebelumnya (Gambar 4.1) berjalan manual: pelanggan reservasi via WhatsApp atau datang langsung, dicatat manual oleh admin. Masalah yang muncul:

- Pencatatan reservasi tidak efisien dan rawan human error
- Pelanggan tidak punya visibilitas real-time terhadap slot yang tersedia
- Data pelanggan tidak terstruktur, sulit ditelusuri untuk laporan

Sistem baru (Gambar 4.2) mengotomatiskan seluruh alur: pelanggan reservasi mandiri, sistem memvalidasi slot & pembayaran secara real-time tanpa intervensi manual admin di tahap awal.

---

## 2. User Stories

### Sebagai Pelanggan
- Sebagai pelanggan, saya ingin **mendaftar akun** agar bisa melakukan reservasi online.
- Sebagai pelanggan, saya ingin **login** agar bisa mengakses riwayat dan status reservasi saya.
- Sebagai pelanggan, saya ingin **melihat kategori & daftar layanan** agar bisa memilih perawatan yang saya inginkan.
- Sebagai pelanggan, saya ingin **memilih slot jadwal yang tersedia** agar reservasi saya tidak bentrok dengan pelanggan lain.
- Sebagai pelanggan, saya ingin **membayar DP atau lunas** melalui berbagai metode (VA/E-Wallet/QRIS) agar proses transaksi fleksibel.
- Sebagai pelanggan, saya ingin **menggunakan kode voucher diskon** agar mendapat potongan harga saat checkout.
- Sebagai pelanggan, saya ingin **mengajukan pembatalan reservasi** jika rencana saya berubah.
- Sebagai pelanggan, saya ingin **mengirim pesan/saran ke admin** untuk bertanya atau memberi masukan.

### Sebagai Admin
- Sebagai admin, saya ingin **mengelola data master** (kategori, layanan, diskon, metode pembayaran) agar informasi selalu terbarui.
- Sebagai admin, saya ingin **meninjau pengajuan pembatalan** pelanggan agar jadwal tetap akurat.
- Sebagai admin, saya ingin **mencatat booking offline (walk-in)** melalui interface POS untuk pelanggan yang datang langsung.
- Sebagai admin, saya ingin **melihat dan mengekspor laporan transaksi** (Excel/PDF/Print) untuk memantau performa bisnis.

---

## 3. Use Case Diagram

> 📌 *Sisipkan gambar Use Case Diagram asli (Gambar 4.3 pada laporan TA) di sini sebagai ilustrasi visual.*

| Aktor | Use Case Utama | Keterangan |
|---|---|---|
| Pelanggan | Registrasi Akun, Login, Reset Password | Autentikasi & manajemen akun |
| Pelanggan | Lihat Menu, Lihat Layanan & Slot | Eksplorasi katalog layanan |
| Pelanggan | Booking Layanan (*include* Pilih Jadwal Slot, Melakukan Pembayaran; *extend* Gunakan Diskon) | Alur reservasi inti |
| Pelanggan | Kelola Reservasi (*extend* Ajukan Pembatalan) | Manajemen reservasi milik sendiri |
| Pelanggan | Kirim Pesan & Saran, Kelola Profil | Interaksi pendukung |
| Admin | Kelola Master Data, Kelola Peraturan Booking | Konfigurasi & data acuan |
| Admin | Kelola Pembatalan Booking, Kelola Booking Offline | Operasional harian |
| Admin | Kelola Laporan | Monitoring bisnis |

---

## 4. Test Case

| ID | Modul | Skenario | Prasyarat | Langkah Pengujian | Hasil yang Diharapkan | Prioritas |
|---|---|---|---|---|---|---|
| TC-01 | Registrasi | Registrasi dengan data valid | Belum punya akun | Buka form registrasi → isi Nama/Email/No HP/Password valid → klik "Daftar" → buka email → klik link verifikasi | Status akun berubah dari "Pending" menjadi "Aktif", notifikasi "Registrasi Berhasil" muncul | Tinggi |
| TC-02 | Registrasi | Registrasi dengan data tidak lengkap | Belum punya akun | Kosongkan salah satu field wajib → klik "Daftar" | Sistem menampilkan pesan error, data tidak tersimpan | Tinggi |
| TC-03 | Login | Login dengan kredensial benar | Akun sudah aktif | Input email & password valid → klik "Masuk" | Diarahkan ke halaman utama/dashboard sesuai role (pelanggan/admin) | Tinggi |
| TC-04 | Login | Login dengan password salah | Akun sudah aktif | Input email valid + password salah → klik "Masuk" | Muncul pesan "Email/Password Salah", tetap di halaman login | Tinggi |
| TC-05 | Booking & Diskon | Booking dengan voucher valid | Sudah login, sudah pilih layanan & slot | Pilih jenis pembayaran → input kode voucher valid → klik terapkan | Muncul label "Diskon Diterapkan", total harga terpotong sesuai persentase | Sedang |
| TC-06 | Booking & Diskon | Booking dengan voucher tidak valid | Sudah login, sudah pilih layanan & slot | Input kode voucher salah/kedaluwarsa → klik terapkan | Muncul pesan "Voucher Tidak Valid", harga tidak berubah | Sedang |
| TC-07 | Pembayaran | Verifikasi pembayaran Midtrans sukses | Sudah di halaman pembayaran | Pilih metode (VA/E-Wallet/QRIS) → selesaikan transaksi di gateway | Callback memperbarui status reservasi menjadi "Confirmed", bukti reservasi terbit | Tinggi |
| TC-08 | Pembayaran | Verifikasi pembayaran Midtrans gagal | Sudah di halaman pembayaran | Batalkan/gagalkan transaksi di gateway | Notifikasi "Pembayaran Dibatalkan" muncul, status reservasi tidak berubah jadi confirmed | Tinggi |
| TC-09 | Pembatalan | Pengajuan pembatalan disetujui admin | Reservasi berstatus aktif, dalam batas waktu | Pelanggan klik "Batalkan Pesanan" → admin buka detail → klik "Konfirmasi Pembatalan" | Status jadi "Dibatalkan", slot jadwal ter-restore kosong, notifikasi terkirim ke pelanggan | Sedang |
| TC-10 | Pembatalan | Pengajuan pembatalan ditolak admin | Reservasi berstatus "Menunggu Konfirmasi" | Admin tinjau detail → klik "Tolak Pembatalan" | Status reservasi kembali menjadi "Aktif/Confirmed", notifikasi penolakan terkirim | Sedang |
| TC-11 | Admin - Master Data | Tambah data layanan baru | Admin sudah login | Buka menu Data Master → klik "Tambah Data" → isi form → klik "Simpan" | Data tersimpan ke database, tabel ter-refresh, notifikasi "Sukses Ditambahkan" | Sedang |
| TC-12 | Admin - Booking Offline | Booking walk-in via POS | Admin sudah login, slot tersedia | Pilih layanan → cari/isi data pelanggan → atur jadwal → pilih metode bayar tunai → klik "Proses Booking & Bayar" | Data booking tersimpan, invoice tercetak, slot ter-update jadi terisi | Sedang |

---

## 5. Automation Testing

### Kenapa Flow Ini yang Diotomasi
Saya memprioritaskan **Login** dan **Booking + Voucher** karena keduanya adalah *critical path* — jika salah satu gagal, seluruh fungsi bisnis (transaksi) ikut terganggu. Login juga cocok jadi automation pertama karena stabil, cepat dieksekusi, dan jadi prasyarat hampir semua skenario lain (bisa dijadikan reusable function/fixture).

### Setup
```python
# requirements: selenium, pytest, webdriver-manager
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

BASE_URL = "https://staging.aurorabeautysalon.example.com"  # ganti sesuai environment testing

@pytest.fixture
def driver():
    drv = webdriver.Chrome()
    drv.get(f"{BASE_URL}/login")
    yield drv
    drv.quit()
```

### Automation — Login (TC-03 & TC-04)
```python
def test_login_dengan_kredensial_valid(driver):
    driver.find_element(By.NAME, "email").send_keys("pelanggan_test@example.com")
    driver.find_element(By.NAME, "password").send_keys("Password123!")
    driver.find_element(By.ID, "btn-masuk").click()

    WebDriverWait(driver, 10).until(EC.url_contains("/dashboard"))
    assert "dashboard" in driver.current_url


def test_login_dengan_password_salah(driver):
    driver.find_element(By.NAME, "email").send_keys("pelanggan_test@example.com")
    driver.find_element(By.NAME, "password").send_keys("passwordsalah")
    driver.find_element(By.ID, "btn-masuk").click()

    error_message = WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.CLASS_NAME, "alert-error"))
    )
    assert "Email/Password Salah" in error_message.text
```

### Automation — Booking dengan Voucher (TC-05 & TC-06)
```python
def test_booking_dengan_voucher_valid(driver):
    # asumsi driver sudah dalam kondisi login (bisa pakai fixture terpisah)
    driver.get(f"{BASE_URL}/layanan")
    driver.find_element(By.LINK_TEXT, "Perawatan Wajah").click()
    driver.find_element(By.XPATH, "//div[@data-layanan='facial-glow']//button[text()='Pilih']").click()

    driver.find_element(By.ID, "btn-lanjut-pilih-jadwal").click()
    driver.find_element(By.CSS_SELECTOR, "[data-slot='10:00']").click()
    driver.find_element(By.ID, "btn-lanjut-pembayaran").click()

    driver.find_element(By.ID, "input-kode-voucher").send_keys("DISKON10")
    driver.find_element(By.ID, "btn-terapkan-voucher").click()

    diskon_label = WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.ID, "label-diskon-diterapkan"))
    )
    assert "Diskon Diterapkan" in diskon_label.text


def test_booking_dengan_voucher_tidak_valid(driver):
    driver.get(f"{BASE_URL}/layanan")
    driver.find_element(By.XPATH, "//div[@data-layanan='facial-glow']//button[text()='Pilih']").click()
    driver.find_element(By.ID, "btn-lanjut-pilih-jadwal").click()
    driver.find_element(By.CSS_SELECTOR, "[data-slot='10:00']").click()
    driver.find_element(By.ID, "btn-lanjut-pembayaran").click()

    driver.find_element(By.ID, "input-kode-voucher").send_keys("KODEEXPIRED")
    driver.find_element(By.ID, "btn-terapkan-voucher").click()

    error_label = WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.ID, "label-voucher-error"))
    )
    assert "Voucher Tidak Valid" in error_label.text
```

> **Catatan implementasi:** URL, `name`, `id`, dan `data-*` selector di atas adalah placeholder — sesuaikan dengan struktur HTML aktual sistem kamu. Untuk skenario pembayaran Midtrans (TC-07/TC-08), disarankan pakai **sandbox environment** Midtrans, bukan production, dan pertimbangkan Page Object Model bila script bertambah banyak agar lebih maintainable.

---

## 6. Pembelajaran & Catatan QA

Dari proyek ini, beberapa poin yang saya soroti sebagai QA:

- Alur pembayaran yang melibatkan pihak ketiga (Midtrans callback) butuh strategi pengujian tersendiri — idealnya dites di sandbox, plus disiapkan test case untuk kondisi *timeout* atau *callback* yang terlambat masuk.
- Fitur pembatalan melibatkan dua aktor (pelanggan & admin) dengan status transisi yang cukup banyak (Aktif → Menunggu Konfirmasi → Dibatalkan/Aktif kembali) — ini rawan *edge case* kalau tidak diuji menyeluruh.
- Struktur database menunjukkan penggunaan *snapshot* data (`nama_layanan_snapshot`, `harga_deal` di tabel Reservasi_Layanan), artinya perubahan harga/nama layanan di kemudian hari tidak akan mengubah riwayat transaksi lama — ini poin bagus yang layak divalidasi lewat test case tersendiri.
