# Case Study: Sistem Reservasi Aurora Beauty Salon

## Ringkasan Proyek

Aurora Beauty Salon adalah sistem informasi reservasi berbasis web dengan alur transaksi dua tahap: **pembayaran DP 50%** saat reservasi dibuat, lalu **pelunasan** setelah layanan selesai diberikan. Setiap tahap pembayaran melewati proses verifikasi oleh admin, dan pelanggan wajib check-in saat tiba di salon sebelum layanan mulai dikerjakan oleh karyawan.

Dalam studi kasus ini, saya berperan sebagai QA yang menganalisis Use Case Diagram dan Activity Diagram sistem untuk menyusun user stories, skenario pengujian (test case), serta automation script pada alur kritikal.

> **Catatan revisi:** Versi awal case study ini disusun dari teks BAB IV (analisis & perancangan sistem) sebelum diagram aslinya saya lihat langsung, jadi ada detail yang meleset (saya sempat memasukkan alur diskon/voucher dan pembatalan reservasi yang ternyata tidak muncul di dua diagram di bawah). Isi di bawah ini sudah saya sesuaikan penuh dengan Use Case Diagram dan Activity Diagram yang kamu kirim.

### Insight Teknis dari ERD
Dari struktur tabel `users` (kolom `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `profile_photo_path`) pada dokumen database sebelumnya, sistem ini kemungkinan besar dibangun di atas **Laravel** dengan auth scaffolding khas Jetstream/Fortify — relevan untuk strategi pengujian sesi login berbasis cookie.

---

## 1. Use Case Diagram

**Aktor:** Pelanggan dan Admin.

| Aktor | Use Case | Relasi | Keterangan |
|---|---|---|---|
| Pelanggan | Registrasi Akun | *Include* → Login | Pendaftaran akun baru |
| Pelanggan | Login | - | Autentikasi pelanggan |
| Pelanggan | Lihat Layanan | - | Melihat katalog layanan salon |
| Pelanggan | Cek Riwayat Reservasi | - | Melihat histori reservasi |
| Pelanggan | Pilih Layanan | *Include* → Pilih Slot Jadwal | Memilih jenis perawatan |
| Pelanggan | Pilih Slot Jadwal | *Extend* → Reservasi Layanan | Memilih waktu layanan tersedia |
| Pelanggan | Reservasi Layanan | *Include* → Pembayaran DP 50% | Mengonfirmasi pemesanan |
| Pelanggan | Pembayaran DP 50% | *Include* → Verifikasi DP 50%; *Extend* → Pelunasan Pembayaran | Membayar uang muka 50% |
| Pelanggan | Pelunasan Pembayaran | *Include* → Verifikasi Pelunasan; *Extend* → Proses Check-in | Melunasi sisa pembayaran |
| Pelanggan | Check-in | *Include* → Proses Check-in | Check-in saat tiba di salon |
| — | Proses Check-in | *Include* → Konfirmasi Reservasi | Validasi kedatangan |
| Admin | Verifikasi DP 50% | - | Memvalidasi pembayaran DP |
| Admin | Verifikasi Pelunasan | - | Memvalidasi pelunasan |
| Admin | Konfirmasi Reservasi | - | Mengonfirmasi kedatangan pelanggan |
| Admin | Laporan Transaksi | - | Melihat rekap transaksi |
| Admin | Kelola Layanan | - | CRUD data layanan |
| Admin | Kelola Slot Jadwal | - | CRUD slot jadwal |
| Admin | Kelola Akun Pelanggan | - | Manajemen akun pelanggan |
| Admin | Login | - | Autentikasi admin |

![Use Case Diagram Aurora Beauty Salon](images/usecase-diagram-aurora-beauty-salon.png)

---

## 2. Alur Bisnis Utama (Activity Diagram)

Proses melibatkan 4 pihak: **Pelanggan, Sistem, Admin, dan Karyawan.**

**Fase 1 — Reservasi**
1. Pelanggan membuka website dan mengakses halaman utama.
2. Jika belum punya akun → registrasi lalu login; jika sudah → langsung login.
3. Pelanggan memilih kategori layanan → memilih layanan → memilih slot jadwal yang tersedia.
4. Pelanggan mengirim reservasi ke sistem.
5. Sistem mencatat reservasi ke database dan otomatis mengirim konfirmasi ke pelanggan.

**Fase 2 — Pembayaran DP**
6. Pelanggan mengisi form konfirmasi reservasi lalu membayar DP 50%.
7. Sistem memproses transaksi dan otomatis mengirim konfirmasi pembayaran.
8. Pelanggan menerima konfirmasi dan melihat detail transaksi.

**Fase 3 — Kedatangan & Layanan**
9. Pelanggan datang ke salon sesuai jadwal dan melakukan check-in.
10. Admin mengecek reservasi & pembayaran DP, memvalidasi transaksi, lalu mengonfirmasi kedatangan pelanggan.
11. Sistem memperbarui status reservasi dan mengizinkan layanan diberikan.
12. Karyawan menerima daftar layanan pelanggan, menyiapkan alat & bahan, lalu melayani sesuai reservasi.
13. Karyawan mengonfirmasi penyelesaian layanan ke pelanggan.

**Fase 4 — Pelunasan**
14. Pelanggan menerima layanan lalu menyelesaikan pembayaran pelunasan.
15. Sistem memperbarui slot reservasi, memproses transaksi pelunasan, dan mencatat ke database.
16. Admin menerima data pelunasan sebagai penutup siklus transaksi.

![Activity Diagram - Proses Bisnis Aurora Beauty Salon](images/activity-diagram-aurora-beauty-salon.png)

> **Catatan peran Karyawan:** karyawan tidak muncul sebagai aktor di Use Case Diagram (kemungkinan tidak mengakses sistem secara langsung), tapi berperan penting di proses bisnis nyata — menyiapkan alat/bahan dan mengeksekusi layanan. Ini penting buat QA: validasi bahwa status "layanan diberikan" di sistem benar-benar sinkron dengan kondisi aktual di lapangan.

---

## 3. User Stories

### Sebagai Pelanggan
- Sebagai pelanggan, saya ingin **mendaftar dan login** agar bisa mengakses layanan reservasi.
- Sebagai pelanggan, saya ingin **melihat daftar layanan** agar bisa memilih perawatan yang saya inginkan.
- Sebagai pelanggan, saya ingin **mengecek riwayat reservasi** agar tahu status booking saya sebelumnya.
- Sebagai pelanggan, saya ingin **memilih layanan dan slot jadwal** agar reservasi saya sesuai waktu yang saya mau.
- Sebagai pelanggan, saya ingin **membayar DP 50%** agar reservasi saya terkonfirmasi tanpa harus melunasi di awal.
- Sebagai pelanggan, saya ingin **check-in saat tiba di salon** agar admin tahu saya sudah datang sesuai jadwal.
- Sebagai pelanggan, saya ingin **melunasi pembayaran setelah layanan selesai** agar transaksi saya tuntas.

### Sebagai Admin
- Sebagai admin, saya ingin **memverifikasi pembayaran DP dan pelunasan** agar tidak ada transaksi fiktif yang lolos.
- Sebagai admin, saya ingin **mengonfirmasi kedatangan pelanggan** agar layanan hanya diberikan ke pelanggan yang sah.
- Sebagai admin, saya ingin **melihat laporan transaksi** untuk memantau performa bisnis.
- Sebagai admin, saya ingin **mengelola data layanan, slot jadwal, dan akun pelanggan** agar informasi sistem selalu akurat.

---

## 4. Test Case

| ID | Modul | Skenario | Prasyarat | Langkah Pengujian | Hasil yang Diharapkan | Prioritas |
|---|---|---|---|---|---|---|
| TC-01 | Registrasi | Registrasi dengan data valid | Belum punya akun | Isi form registrasi valid → submit | Akun berhasil dibuat, pelanggan diarahkan ke proses login | Tinggi |
| TC-02 | Registrasi | Registrasi dengan data tidak lengkap | Belum punya akun | Kosongkan salah satu field wajib → submit | Muncul pesan error, data tidak tersimpan | Tinggi |
| TC-03 | Login | Login dengan kredensial benar | Akun sudah terdaftar | Input email & password valid → klik "Masuk" | Diarahkan ke halaman utama pelanggan | Tinggi |
| TC-04 | Login | Login dengan kredensial salah | Akun sudah terdaftar | Input password salah → klik "Masuk" | Muncul pesan error, tetap di halaman login | Tinggi |
| TC-05 | Reservasi | Pilih layanan & slot yang tersedia | Sudah login | Pilih layanan → pilih slot kosong → kirim reservasi | Reservasi tercatat, notifikasi konfirmasi terkirim ke pelanggan | Tinggi |
| TC-06 | Reservasi | Pilih slot yang sudah terisi | Sudah login, ada slot penuh | Coba pilih slot berstatus penuh | Slot tidak bisa dipilih / sistem menolak reservasi ganda | Tinggi |
| TC-07 | Pembayaran DP | Bayar DP 50% berhasil | Reservasi sudah dibuat | Isi form konfirmasi → bayar DP 50% | Sistem mencatat pembayaran, konfirmasi otomatis terkirim | Tinggi |
| TC-08 | Verifikasi | Admin verifikasi DP | Pembayaran DP masuk | Admin cek reservasi & pembayaran → validasi transaksi | Status pembayaran DP berubah jadi tervalidasi | Tinggi |
| TC-09 | Check-in | Check-in & konfirmasi kedatangan | DP sudah terverifikasi, jadwal sudah tiba | Pelanggan check-in → admin konfirmasi kedatangan | Status reservasi berubah, layanan diizinkan diberikan | Sedang |
| TC-10 | Pelunasan | Pelunasan setelah layanan selesai | Layanan sudah diberikan | Pelanggan menyelesaikan pembayaran pelunasan | Sistem mencatat transaksi pelunasan, slot ter-update | Tinggi |
| TC-11 | Verifikasi | Admin verifikasi pelunasan | Pelunasan masuk | Admin validasi transaksi pelunasan | Data pelunasan tercatat sebagai transaksi selesai | Tinggi |
| TC-12 | Laporan | Admin melihat laporan transaksi | Ada data transaksi | Admin buka menu laporan → filter tanggal | Tabel transaksi tampil sesuai rentang yang dipilih | Sedang |

---

## 5. Automation Testing

### Kenapa Flow Ini yang Diotomasi
**Login** dan **Reservasi + Pembayaran DP** adalah *critical path* — kalau salah satu gagal, seluruh siklus transaksi (sampai pelunasan) ikut terganggu. Saya juga sertakan skenario percobaan reservasi ke slot yang sudah terisi, karena ini titik rawan *race condition* / double booking.

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

### Automation — Reservasi & Pembayaran DP (TC-05 & TC-07)
```python
def test_reservasi_dan_pembayaran_dp(driver):
    # asumsi driver sudah dalam kondisi login
    driver.get(f"{BASE_URL}/layanan")
    driver.find_element(By.LINK_TEXT, "Perawatan Wajah").click()
    driver.find_element(By.XPATH, "//div[@data-layanan='facial-glow']//button[text()='Pilih']").click()

    driver.find_element(By.CSS_SELECTOR, "[data-slot='10:00']").click()
    driver.find_element(By.ID, "btn-kirim-reservasi").click()

    WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.ID, "form-konfirmasi-reservasi"))
    )
    driver.find_element(By.NAME, "catatan").send_keys("Reservasi test otomatis")
    driver.find_element(By.ID, "btn-bayar-dp").click()

    konfirmasi = WebDriverWait(driver, 15).until(
        EC.visibility_of_element_located((By.ID, "label-konfirmasi-pembayaran"))
    )
    assert "Pembayaran DP Diterima" in konfirmasi.text
```

### Automation — Reservasi ke Slot yang Sudah Terisi (TC-06)
```python
def test_slot_terisi_tidak_bisa_direservasi(driver):
    driver.get(f"{BASE_URL}/layanan")
    driver.find_element(By.XPATH, "//div[@data-layanan='facial-glow']//button[text()='Pilih']").click()

    slot_terisi = driver.find_element(By.CSS_SELECTOR, "[data-slot='10:00'][data-status='penuh']")
    assert "disabled" in slot_terisi.get_attribute("class")
```

> **Catatan implementasi:** URL, `name`, `id`, dan `data-*` selector di atas adalah placeholder — sesuaikan dengan struktur HTML aktual website kamu.

---

## 6. Catatan & Pertanyaan Konfirmasi

Waktu saya baca teks BAB IV (ERD & struktur tabel) di percakapan sebelumnya, saya sempat menemukan indikasi fitur **diskon/voucher**, **pembatalan reservasi**, dan **booking offline (POS)** — tapi fitur-fitur itu tidak muncul di Use Case Diagram maupun Activity Diagram yang kamu kirim sekarang. Ada tiga kemungkinan: fitur itu memang masih ada tapi tidak digambarkan di dua diagram ini (karena diagram ini fokus ke alur inti DP+Pelunasan), atau fiturnya sudah tidak dipakai di versi final, atau memang berasal dari revisi sistem yang berbeda.

Kalau kamu masih mau memasukkan modul diskon/pembatalan/booking offline ke case study, kabari saya modul mana saja yang tetap dipakai, biar saya tambahkan user story dan test case-nya tanpa menebak-nebak lagi.

## 7. Pembelajaran & Catatan QA

- Alur dua tahap pembayaran (DP → Pelunasan) rawan *state inconsistency* kalau salah satu verifikasi admin terlewat — penting untuk test case yang memastikan status reservasi tidak bisa "meloncat" ke fase berikutnya tanpa verifikasi sebelumnya selesai.
- Karyawan tidak tercatat sebagai aktor sistem, jadi validasi "layanan sudah diberikan" bergantung pada input manual admin/sistem — ini titik rawan yang layak diuji dengan skenario negatif (misalnya status berubah padahal layanan belum benar-benar selesai).
- Pencegahan double booking pada slot jadwal adalah salah satu area paling kritikal untuk diuji, termasuk skenario concurrent request (dua pelanggan reservasi slot yang sama nyaris bersamaan).
