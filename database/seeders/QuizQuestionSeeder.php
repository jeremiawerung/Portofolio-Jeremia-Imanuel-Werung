<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

/**
 * Question bank for Materi 1 (Mindset QA & Dasar Software). Each row is
 * tagged with a `category` so /belajar can show per-topic accuracy over
 * time. Add more rows here any time, no code changes needed elsewhere;
 * the quiz controller always draws a random subset from whatever exists.
 */
class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        QuizQuestion::where('materi_id', 1)->delete();

        foreach ($this->questions() as $q) {
            QuizQuestion::create(array_merge(['materi_id' => 1], $q));
        }
    }

    private function questions(): array
    {
        return [
            // ---------- DASAR ----------
            [
                'level' => 'dasar', 'category' => 'roles', 'type' => 'mc',
                'question' => 'Apa perbedaan utama peran QA dengan Developer dalam sebuah tim?',
                'options' => [
                    'QA berfokus membangun fitur baru, sedangkan Developer berfokus mendokumentasikan hasil pengujian',
                    'QA berfokus memastikan kualitas dan menemukan masalah sebelum rilis, sedangkan Developer berfokus membangun dan memperbaiki fitur',
                    'QA dan Developer sama-sama menulis kode produksi, hanya beda bahasa pemrograman yang dipakai',
                    'QA berfokus pada desain tampilan (UI), sedangkan Developer berfokus pada pengujian fungsional',
                ],
                'correct' => 1,
                'explain' => 'QA fokus memverifikasi kualitas dan menemukan masalah sebelum sampai ke pengguna, sementara Developer membangun dan memperbaiki fiturnya, bukan sebaliknya, dan bukan pembagian tugas berdasarkan bahasa pemrograman atau UI semata.',
            ],
            [
                'level' => 'dasar', 'category' => 'sdlc', 'type' => 'mc',
                'question' => 'Urutan tahapan SDLC yang paling umum adalah...',
                'options' => [
                    'Testing, Requirement & Planning, Design, Deployment, Development, Maintenance',
                    'Requirement & Planning, Design, Development, Testing, Deployment, Maintenance',
                    'Design, Requirement & Planning, Testing, Development, Maintenance, Deployment',
                    'Development, Testing, Requirement & Planning, Design, Maintenance, Deployment',
                ],
                'correct' => 1,
                'explain' => 'Urutan standarnya: Requirement & Planning, Design, Development, Testing, Deployment, lalu Maintenance, tahap-tahap yang sama di semua opsi, hanya yang urutannya benar yang tepat.',
            ],
            [
                'level' => 'dasar', 'category' => 'sdlc', 'type' => 'mc',
                'question' => 'Manakah pernyataan paling tepat tentang keterlibatan QA dalam SDLC?',
                'options' => [
                    'QA idealnya terlibat sejak tahap Requirement & Planning untuk mereview kebutuhan lebih awal',
                    'QA baru boleh dilibatkan setelah tahap Development selesai sepenuhnya',
                    'QA hanya berperan di tahap Deployment untuk menyetujui jadwal rilis',
                    'Keterlibatan QA sejak awal justru memperlambat proses development secara signifikan',
                ],
                'correct' => 0,
                'explain' => 'Semakin awal QA terlibat (sejak requirement), semakin murah biaya memperbaiki masalah dibanding ditemukan saat aplikasi sudah jadi, ini prinsip shift-left testing.',
            ],
            [
                'level' => 'dasar', 'category' => 'bug_lifecycle', 'type' => 'fill',
                'question' => 'Dalam bug lifecycle, tahap setelah Developer memperbaiki bug (Fixed) dan SEBELUM QA menyatakannya lolos disebut tahap ____.',
                'accepted' => ['retest', 're-test', 'retesting'],
                'explain' => 'Setelah Fixed, QA melakukan Retest, mengulang steps to reproduce yang sama untuk memastikan bug benar-benar sudah tidak muncul lagi sebelum ditutup.',
            ],
            [
                'level' => 'dasar', 'category' => 'roles', 'type' => 'fill',
                'question' => 'Peran yang bertugas menerjemahkan kebutuhan bisnis/pengguna menjadi requirement tertulis bagi tim disebut ____.',
                'accepted' => ['business analyst', 'ba'],
                'explain' => 'Business Analyst (BA) menjembatani kebutuhan bisnis dan pengguna menjadi requirement yang bisa dikerjakan Dev dan diuji QA.',
            ],
            [
                'level' => 'dasar', 'category' => 'bug_lifecycle', 'type' => 'mc',
                'question' => 'Status paling awal ketika sebuah bug pertama kali ditemukan dan dicatat oleh QA adalah...',
                'options' => ['New', 'Assigned', 'Fixed', 'Closed'],
                'correct' => 0,
                'explain' => 'Bug lifecycle selalu dimulai dari status New, sebelum di-assign ke Developer, diperbaiki, dan seterusnya.',
            ],
            [
                'level' => 'dasar', 'category' => 'sdlc', 'type' => 'fill',
                'question' => 'Istilah untuk keseluruhan tahapan pengembangan software dari requirement sampai maintenance disingkat ____.',
                'accepted' => ['sdlc'],
                'explain' => 'SDLC (Software Development Life Cycle) adalah kerangka tahapan membangun software dari ide sampai dirawat setelah rilis.',
            ],
            [
                'level' => 'dasar', 'category' => 'roles', 'type' => 'mc',
                'question' => 'Peran yang bertugas membangun dan menulis kode fitur berdasarkan requirement yang sudah disepakati disebut...',
                'options' => ['Developer', 'Business Analyst', 'Project Manager', 'Quality Assurance'],
                'correct' => 0,
                'explain' => 'Developer membangun dan menulis kode fitur berdasarkan requirement dari BA, beda dengan QA yang menguji, atau BA/PM yang menyusun kebutuhan dan mengatur proyek.',
            ],
            [
                'level' => 'dasar', 'category' => 'verification_validation', 'type' => 'fill',
                'question' => 'Istilah yang memastikan produk dibangun SESUAI SPESIFIKASI tertulis (bukan sesuai kebutuhan pengguna sebenarnya) disebut ____.',
                'accepted' => ['verification', 'verifikasi'],
                'explain' => 'Verification memastikan "kita membangun produk dengan benar", sesuai spesifikasi/requirement yang ditulis.',
            ],
            [
                'level' => 'dasar', 'category' => 'testing_types', 'type' => 'mc',
                'question' => 'Pengecekan cepat & dangkal terhadap fitur utama tepat setelah proses deploy, sebelum diumumkan ke pengguna, disebut...',
                'options' => ['Smoke testing', 'Regression testing', 'Load testing', 'Exploratory testing'],
                'correct' => 0,
                'explain' => 'Smoke testing adalah pengecekan cepat setelah deploy untuk memastikan fitur utama tidak rusak, sebelum pengujian yang lebih menyeluruh dilakukan.',
            ],
            [
                'level' => 'dasar', 'category' => 'requirement_review', 'type' => 'mc',
                'question' => 'Acceptance criteria dalam sebuah requirement paling tepat berfungsi sebagai...',
                'options' => [
                    'Hiasan dokumen supaya terlihat lebih profesional',
                    'Syarat terukur yang menentukan kapan sebuah fitur dianggap selesai dan sesuai harapan',
                    'Catatan pribadi Developer yang tidak perlu direview QA',
                    'Pengganti dokumentasi teknis sepenuhnya',
                ],
                'correct' => 1,
                'explain' => 'Acceptance criteria adalah syarat terukur yang dipakai untuk menentukan apakah sebuah fitur sudah memenuhi harapan dan siap dianggap selesai.',
            ],
            [
                'level' => 'dasar', 'category' => 'bug_lifecycle', 'type' => 'mc',
                'question' => "Setelah status bug berubah menjadi 'Assigned', langkah berikutnya yang dilakukan Developer adalah masuk ke status...",
                'options' => ['In Progress', 'Retest', 'Closed', 'New'],
                'correct' => 0,
                'explain' => 'Setelah di-assign, Developer mulai mengerjakan perbaikan sehingga statusnya berubah menjadi In Progress, sebelum akhirnya Fixed.',
            ],
            [
                'level' => 'dasar', 'category' => 'bug_reporting', 'type' => 'mc',
                'question' => 'Elemen yang WAJIB ada dalam sebuah bug report yang baik adalah...',
                'options' => [
                    'Steps to reproduce, expected result, dan actual result yang jelas',
                    'Pendapat pribadi QA soal desain UI aplikasi',
                    'Riwayat commit Developer yang menyebabkan bug',
                    'Jumlah baris kode yang bermasalah',
                ],
                'correct' => 0,
                'explain' => 'Bug report yang baik wajib memuat steps to reproduce, expected result, dan actual result yang jelas supaya Developer bisa memverifikasi dan memperbaikinya.',
            ],
            [
                'level' => 'dasar', 'category' => 'test_case_writing', 'type' => 'fill',
                'question' => 'Kondisi yang harus terpenuhi SEBELUM sebuah test case bisa mulai dieksekusi disebut ____.',
                'accepted' => ['precondition', 'pre-condition', 'prasyarat'],
                'explain' => 'Precondition adalah syarat/kondisi awal yang harus terpenuhi sebelum langkah-langkah test case mulai dijalankan.',
            ],
            [
                'level' => 'dasar', 'category' => 'roles', 'type' => 'mc',
                'question' => 'Business Analyst (BA) dalam sebuah tim paling tepat berperan sebagai...',
                'options' => [
                    'Menjembatani kebutuhan bisnis/pengguna menjadi requirement yang jelas bagi tim',
                    'Menguji aplikasi sebelum dirilis ke pengguna',
                    'Menulis kode fitur berdasarkan desain teknis',
                    'Memantau performa server setelah aplikasi live',
                ],
                'correct' => 0,
                'explain' => 'BA menerjemahkan kebutuhan bisnis dan pengguna menjadi requirement yang bisa dikerjakan Dev dan diuji QA.',
            ],

            // ---------- MENENGAH ----------
            [
                'level' => 'menengah', 'category' => 'release_decision', 'type' => 'mc',
                'question' => 'Tim sedang terburu-buru mengejar deadline rilis. PM meminta QA melewati regression testing karena "fitur lama harusnya tidak kepengaruh". Sikap paling tepat bagi QA adalah...',
                'options' => [
                    'Menuruti permintaan PM sepenuhnya tanpa didiskusikan lebih lanjut',
                    'Menolak permintaan itu dan langsung meninggalkan rapat sebagai bentuk protes',
                    'Menjelaskan risiko melewatkan regression testing dengan data/contoh konkret, lalu mengusulkan alternatif seperti regression test yang dipangkas ke area berisiko tinggi',
                    'Diam saja, tetap menjalankan regression testing lengkap tanpa memberi tahu siapa pun',
                ],
                'correct' => 2,
                'explain' => 'QA perlu advokasi berbasis risiko dan data, bukan menurut tanpa berdiskusi, bereaksi emosional, atau diam-diam bertindak sendiri.',
            ],
            [
                'level' => 'menengah', 'category' => 'requirement_review', 'type' => 'mc',
                'question' => 'Seorang BA menulis requirement: "Sistem harus menampilkan pesan error jika input salah." QA yang baik akan bereaksi dengan...',
                'options' => [
                    'Langsung menyetujui requirement itu karena sudah dianggap cukup jelas',
                    'Menandai requirement ini ambigu, lalu bertanya detail: "input salah" itu seperti apa, dan pesan errornya harus bagaimana',
                    'Menunggu Developer selesai membangun fitur, baru menanyakan detailnya ke BA',
                    'Menulis ulang requirement itu sendiri tanpa berdiskusi dengan BA terlebih dahulu',
                ],
                'correct' => 1,
                'explain' => 'QA idealnya mereview requirement sedini mungkin untuk menangkap ambiguitas sebelum development dimulai, inti dari shift-left testing.',
            ],
            [
                'level' => 'menengah', 'category' => 'testing_types', 'type' => 'mc',
                'question' => 'Sebuah tim baru merilis fitur ke production. Sebelum mengumumkan ke pengguna, QA melakukan pengecekan cepat bahwa fitur utama masih berjalan normal setelah deploy. Aktivitas ini disebut...',
                'options' => ['Regression testing', 'Smoke testing', 'User Acceptance Testing (UAT)', 'Load testing'],
                'correct' => 1,
                'explain' => 'Smoke testing adalah pengecekan cepat setelah deploy, beda dengan regression testing (lebih menyeluruh), UAT (dilakukan pengguna/klien), atau load testing (menguji beban trafik).',
            ],
            [
                'level' => 'menengah', 'category' => 'testing_types', 'type' => 'fill',
                'question' => 'Aktivitas pengujian ulang terhadap fitur LAMA yang sudah pernah lolos uji, untuk memastikan tidak rusak akibat perubahan baru, disebut testing ____.',
                'accepted' => ['regresi', 'regression'],
                'explain' => 'Regression testing (testing regresi) menguji ulang fitur lama yang sudah pernah lolos, untuk memastikan perubahan baru tidak merusaknya.',
            ],
            [
                'level' => 'menengah', 'category' => 'bug_lifecycle', 'type' => 'fill',
                'question' => 'Bug yang sudah di-fix Developer, lalu diverifikasi ulang QA dan ternyata masih gagal di skenario yang sama, statusnya berubah menjadi ____.',
                'accepted' => ['reopened', 'reopen'],
                'explain' => 'Karena gagal lagi di retest, status bug kembali ke Reopened, bukan Closed, dan bukan bug baru (New).',
            ],
            [
                'level' => 'menengah', 'category' => 'bug_reporting', 'type' => 'mc',
                'question' => 'Sebuah bug report ditulis: "Judul: Tombol error. Deskripsi: kadang-kadang tidak bisa diklik. Severity: -". Masalah UTAMA dari bug report ini adalah...',
                'options' => [
                    'Tidak ada steps to reproduce yang jelas, kondisi "kadang-kadang" tanpa detail, dan severity tidak diisi',
                    'Deskripsinya ditulis terlalu formal',
                    'Judul bug seharusnya memakai huruf kapital semua',
                    'Bug report ini sudah cukup baik untuk langsung dikerjakan Developer',
                ],
                'correct' => 0,
                'explain' => 'Bug report yang baik butuh steps to reproduce yang spesifik (bukan "kadang-kadang"), serta severity/priority yang terisi supaya Developer tahu urgensinya.',
            ],
            [
                'level' => 'menengah', 'category' => 'test_case_writing', 'type' => 'mc',
                'question' => "Manakah expected result yang PALING baik untuk test case 'Login dengan kredensial valid'?",
                'options' => [
                    '"Berhasil"',
                    '"Sistem menampilkan halaman dashboard dan nama pengguna muncul di pojok kanan atas"',
                    '"Tidak ada error yang muncul"',
                    '"Aplikasi berjalan seperti biasa"',
                ],
                'correct' => 1,
                'explain' => 'Expected result yang baik harus spesifik dan terukur, menyebutkan tampilan/hasil konkret, bukan istilah samar seperti "berhasil" atau "berjalan seperti biasa".',
            ],
            [
                'level' => 'menengah', 'category' => 'sdlc', 'type' => 'mc',
                'question' => 'Sebuah fitur baru sedang di tahap Design (mockup & alur teknis sudah dibuat, coding belum dimulai). Aktivitas QA yang paling tepat di tahap ini adalah...',
                'options' => [
                    'Mulai menjalankan regression testing penuh',
                    'Menyiapkan draft test plan berdasarkan mockup & alur yang ada',
                    'Menunggu sampai Development selesai baru mulai bekerja',
                    'Langsung menutup semua bug lama yang belum di-retest',
                ],
                'correct' => 1,
                'explain' => 'Di tahap Design, QA sudah bisa mulai menyiapkan draft test plan berdasarkan mockup/alur teknis yang ada, tidak perlu menunggu Development selesai.',
            ],
            [
                'level' => 'menengah', 'category' => 'roles', 'type' => 'mc',
                'question' => 'Seorang Developer menyarankan agar QA cukup mengetes berdasarkan asumsi Developer sendiri, tanpa merujuk requirement/acceptance criteria dari BA. Tanggapan yang paling tepat dari QA adalah...',
                'options' => [
                    'Menyetujui saja karena Developer paling mengerti kodenya',
                    'Tetap merujuk requirement/acceptance criteria sebagai acuan utama, dan mengklarifikasi ke BA kalau ada gap dengan asumsi Developer',
                    'Mengabaikan Developer dan BA sekaligus, menguji sesuka QA',
                    'Menolak menguji sampai ada dokumen requirement versi baru dari BA',
                ],
                'correct' => 1,
                'explain' => 'Requirement/acceptance criteria dari BA tetap jadi acuan utama pengujian QA, asumsi Developer perlu diklarifikasi dulu, bukan langsung dijadikan dasar pengujian.',
            ],
            [
                'level' => 'menengah', 'category' => 'bug_lifecycle', 'type' => 'fill',
                'question' => "Bug yang sudah selesai diperbaiki Developer dan sedang menunggu giliran diverifikasi ulang oleh QA biasanya diberi label status 'Ready for ____'.",
                'accepted' => ['retest', 're-test'],
                'explain' => '"Ready for Retest" menandakan bug sudah siap diverifikasi ulang oleh QA setelah diperbaiki Developer.',
            ],
            [
                'level' => 'menengah', 'category' => 'test_case_writing', 'type' => 'fill',
                'question' => 'Istilah untuk sekumpulan test case yang dikelompokkan untuk menguji satu fitur/modul tertentu disebut test ____.',
                'accepted' => ['suite'],
                'explain' => 'Test suite adalah kumpulan test case yang dikelompokkan untuk menguji satu fitur atau modul tertentu.',
            ],
            [
                'level' => 'menengah', 'category' => 'testing_types', 'type' => 'mc',
                'question' => 'Pengujian yang dilakukan langsung oleh pengguna/klien untuk memastikan sistem memenuhi kebutuhan bisnis sebelum go-live disebut...',
                'options' => ['User Acceptance Testing (UAT)', 'Smoke Testing', 'Unit Testing', 'Load Testing'],
                'correct' => 0,
                'explain' => 'UAT dilakukan oleh pengguna/klien untuk memvalidasi bahwa sistem memenuhi kebutuhan bisnis, beda dengan smoke/unit/load testing yang teknis dan dilakukan tim internal.',
            ],
            [
                'level' => 'menengah', 'category' => 'release_decision', 'type' => 'mc',
                'question' => 'QA menemukan bug minor (severity rendah, tidak mengganggu alur utama) sehari sebelum rilis. Tindakan paling proporsional adalah...',
                'options' => [
                    'Membatalkan seluruh rencana rilis karena ada bug',
                    'Mencatat bug tersebut, mendiskusikan prioritas dengan tim, dan mempertimbangkan rilis tetap jalan dengan bug itu dijadwalkan di update berikutnya',
                    'Mengabaikan bug tersebut tanpa mencatatnya sama sekali',
                    'Memperbaiki sendiri kodenya tanpa melapor ke Developer',
                ],
                'correct' => 1,
                'explain' => 'Bug minor yang tidak mengganggu alur utama biasanya dicatat dan didiskusikan prioritasnya, bukan otomatis membatalkan rilis atau malah diabaikan begitu saja.',
            ],
            [
                'level' => 'menengah', 'category' => 'bug_reporting', 'type' => 'fill',
                'question' => 'Tingkat keparahan dampak sebuah bug terhadap sistem (misalnya Critical, Major, Minor) disebut ____ bug.',
                'accepted' => ['severity'],
                'explain' => 'Severity menggambarkan seberapa parah dampak sebuah bug terhadap sistem, berbeda dari priority yang menyangkut urutan pengerjaan.',
            ],
            [
                'level' => 'menengah', 'category' => 'requirement_review', 'type' => 'mc',
                'question' => 'QA mereview requirement dan menemukan requirement yang saling bertentangan antara dua dokumen berbeda. Langkah paling tepat adalah...',
                'options' => [
                    'Memilih salah satu secara acak dan langsung menguji berdasarkan itu',
                    'Mengangkat temuan ini ke BA/tim terkait untuk diklarifikasi sebelum development lanjut',
                    'Mengabaikan pertentangan itu karena bukan tugas QA',
                    'Menunggu bug muncul dulu baru dibahas',
                ],
                'correct' => 1,
                'explain' => 'Requirement yang saling bertentangan harus diklarifikasi ke BA/tim terkait sedini mungkin, bukan dipilih asal atau dibiarkan sampai menimbulkan bug.',
            ],

            // ---------- LANJUTAN ----------
            [
                'level' => 'lanjutan', 'category' => 'release_decision', 'type' => 'mc',
                'question' => 'Saat regression testing, QA menemukan bug kritis di fitur pembayaran, tapi tim akan rilis dalam 2 jam dan marketing sudah mengumumkan jadwal rilis ke publik. Tindakan paling tepat bagi QA adalah...',
                'options' => [
                    'Tidak melaporkan bug ini dan membiarkan rilis berjalan sesuai jadwal',
                    'Segera melaporkan bug secara jelas (severity, dampak, bukti) ke tim & stakeholder terkait, agar keputusan rilis/tunda diambil bersama berdasarkan risiko nyata',
                    'Memperbaiki sendiri kodenya tanpa melibatkan Developer supaya prosesnya lebih cepat',
                    'Menunda pelaporan bug ini sampai setelah rilis selesai dilakukan',
                ],
                'correct' => 1,
                'explain' => 'QA bertugas memberi informasi risiko secara jelas dan cepat; keputusan rilis/tunda tetap keputusan bersama tim & stakeholder.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'test_case_writing', 'type' => 'mc',
                'question' => 'Test case berikut ditulis QA junior: "TC01 - Login. Steps: buka aplikasi, login. Expected: berhasil." Kelemahan UTAMA dari test case ini adalah...',
                'options' => [
                    'Tidak mencantumkan data uji spesifik (username/password), precondition, dan expected result yang detail (misal redirect ke halaman apa)',
                    'Penomoran test case (TC01) tidak mengikuti format penomoran yang benar',
                    'Kolom "Steps" seharusnya dipisah menjadi beberapa baris terpisah',
                    'Test case ini sudah cukup lengkap dan siap dieksekusi langsung',
                ],
                'correct' => 0,
                'explain' => 'Test case yang baik butuh data uji konkret, precondition jelas, dan expected result yang spesifik & terukur, bukan cuma "berhasil".',
            ],
            [
                'level' => 'lanjutan', 'category' => 'verification_validation', 'type' => 'mc',
                'question' => 'Manakah pernyataan yang PALING tepat mengenai hubungan antara Verification dan Validation?',
                'options' => [
                    'Verification dan Validation adalah dua istilah berbeda untuk proses yang sama persis',
                    'Verification memastikan produk dibangun sesuai spesifikasi, sedangkan Validation memastikan produk memenuhi kebutuhan pengguna sebenarnya',
                    'Verification dilakukan oleh Developer saja, sedangkan Validation dilakukan oleh QA saja',
                    'Verification dilakukan setelah rilis, sedangkan Validation dilakukan sebelum development dimulai',
                ],
                'correct' => 1,
                'explain' => 'Verification = building the product right (sesuai spec). Validation = building the right product (sesuai kebutuhan pengguna sebenarnya).',
            ],
            [
                'level' => 'lanjutan', 'category' => 'bug_lifecycle', 'type' => 'fill',
                'question' => 'Menutup bug hanya berdasarkan laporan lisan Developer tanpa pengujian ulang melanggar tahap bug lifecycle bernama ____.',
                'accepted' => ['retest', 're-test', 'retesting'],
                'explain' => 'Bug harus melalui tahap Retest oleh QA sebelum ditutup (Closed), laporan lisan dari Developer saja tidak cukup.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'risk_based_testing', 'type' => 'fill',
                'question' => 'Pendekatan pengujian yang memprioritaskan area paling berisiko/berdampak besar saat waktu testing terbatas disebut testing berbasis ____.',
                'accepted' => ['risiko', 'risk'],
                'explain' => 'Ini disebut risk-based testing, memprioritaskan area paling berdampak besar kalau gagal, bukan dipilih acak, termudah, atau terbaru semata.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'risk_based_testing', 'type' => 'mc',
                'question' => 'Waktu testing terbatas menjelang rilis, dan QA harus memilih fitur mana yang diuji lebih dulu. Pendekatan yang paling tepat adalah...',
                'options' => [
                    'Menguji fitur secara acak supaya adil ke semua fitur',
                    'Menguji fitur yang paling mudah diuji dulu',
                    'Memprioritaskan fitur dengan risiko & dampak tertinggi ke pengguna/bisnis kalau gagal (risk-based testing)',
                    'Menguji fitur yang paling baru ditambahkan Developer tanpa mempertimbangkan dampaknya',
                ],
                'correct' => 2,
                'explain' => 'Risk-based testing memprioritaskan area paling berisiko/berdampak besar kalau gagal, penting saat waktu testing terbatas.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'roles', 'type' => 'mc',
                'question' => 'Seorang QA junior merasa tidak enak menolak permintaan PM untuk mempercepat rilis meski masih ada bug major belum diperbaiki. Sikap profesional yang tepat adalah...',
                'options' => [
                    'Menyetujui saja demi menjaga hubungan baik dengan PM',
                    'Menyampaikan data risiko secara objektif (dampak bug, severity, bukti) supaya keputusan akhir diambil berdasarkan fakta, bukan tekanan sosial',
                    'Diam-diam menunda pekerjaan testing supaya rilis otomatis molor',
                    'Melapor ke atasan PM tanpa mendiskusikan dulu dengan PM bersangkutan',
                ],
                'correct' => 1,
                'explain' => 'QA tetap harus menyampaikan risiko secara objektif dan berbasis data, bukan menuruti tekanan sosial atau bertindak diam-diam di luar jalur komunikasi tim.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'bug_reporting', 'type' => 'mc',
                'question' => "Sebuah bug report mencantumkan severity 'Critical' untuk kasus salah ketik (typo) di halaman About Us yang tidak mengganggu fungsi apa pun. Masalah dari penentuan severity ini adalah...",
                'options' => [
                    'Severity terlalu tinggi dibanding dampak sebenarnya, typo di halaman non-fungsional biasanya Minor/Low, bukan Critical',
                    "Severity 'Critical' memang wajib dipakai untuk semua bug tampilan",
                    'Typo tidak boleh dilaporkan sebagai bug sama sekali',
                    'Severity seharusnya ditentukan oleh Developer, bukan QA',
                ],
                'correct' => 0,
                'explain' => 'Severity harus proporsional dengan dampak nyata bug terhadap sistem, typo kosmetik yang tidak mengganggu fungsi biasanya Minor/Low, bukan Critical.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'requirement_review', 'type' => 'mc',
                'question' => "Sebuah requirement menyebutkan 'Sistem harus cepat'. QA yang berpengalaman akan menganggap requirement ini bermasalah karena...",
                'options' => [
                    "Kata 'cepat' tidak terukur, tidak ada angka/standar performa yang jelas untuk diuji",
                    'Requirement ini sebenarnya sudah sangat jelas dan bisa langsung diuji',
                    "Kata 'sistem' seharusnya diganti dengan nama aplikasi",
                    'Requirement seperti ini tidak perlu direview karena berkaitan dengan performa, bukan fungsi',
                ],
                'correct' => 0,
                'explain' => 'Requirement yang tidak terukur (seperti "cepat" tanpa angka/standar) sulit diuji secara objektif, QA perlu meminta kriteria yang lebih spesifik.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'test_case_writing', 'type' => 'fill',
                'question' => 'Nilai/data yang sengaja dipilih di batas ambang suatu kondisi (misalnya usia tepat 17 dan 18 tahun untuk aturan minimal 18 tahun) untuk menguji sebuah fitur disebut ____ value.',
                'accepted' => ['boundary'],
                'explain' => 'Boundary value testing menguji nilai tepat di batas ambang suatu kondisi, karena bug sering muncul justru di titik-titik batas ini.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'verification_validation', 'type' => 'mc',
                'question' => 'Sebuah fitur checkout 100% sesuai dokumen requirement (lolos verification), tapi banyak pengguna nyatanya bingung dan gagal menyelesaikan pembayaran. Ini adalah contoh kegagalan pada sisi...',
                'options' => [
                    'Verification, karena requirement-nya salah ditulis dari awal',
                    'Validation, karena produk tidak benar-benar memenuhi kebutuhan pengguna meski sesuai spesifikasi tertulis',
                    'Regression testing, karena fitur lama jadi ikut rusak',
                    'Smoke testing, karena fitur gagal saat pengecekan awal setelah deploy',
                ],
                'correct' => 1,
                'explain' => 'Ini contoh klasik gagal Validation, sesuai spesifikasi tertulis (lolos Verification) tapi tidak benar-benar memenuhi kebutuhan pengguna sebenarnya.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'bug_lifecycle', 'type' => 'mc',
                'question' => 'QA menemukan bug yang PERSIS SAMA sudah pernah dilaporkan dan ditutup (Closed) tiga bulan lalu, tapi muncul kembali di versi terbaru. Status yang paling tepat untuk kasus ini adalah...',
                'options' => [
                    'New, karena dianggap laporan yang benar-benar baru',
                    'Reopened, karena bug yang sama muncul kembali setelah sempat dinyatakan selesai',
                    'Assigned, karena langsung diserahkan ke Developer tanpa dicatat ulang',
                    'Retest, karena QA hanya perlu menguji ulang tanpa mencatat apa pun',
                ],
                'correct' => 1,
                'explain' => 'Karena bug yang sama pernah ditutup lalu muncul kembali, status paling tepat adalah Reopened, bukan laporan baru (New).',
            ],
            [
                'level' => 'lanjutan', 'category' => 'release_decision', 'type' => 'mc',
                'question' => 'Marketing memaksa rilis tepat waktu meski QA menemukan tiga bug major di alur pembayaran. PM akhirnya memutuskan tetap rilis dengan syarat bug diperbaiki dalam waktu 24 jam setelah rilis. Peran QA setelah keputusan ini diambil adalah...',
                'options' => [
                    'Menolak bekerja sama karena tidak setuju dengan keputusan tersebut',
                    'Tetap memantau dan menguji ulang perbaikan bug tersebut secara ketat dalam 24 jam sesuai kesepakatan, karena keputusan rilis sudah diambil bersama',
                    'Menganggap tanggung jawabnya selesai begitu keputusan rilis dibuat oleh PM',
                    'Diam-diam memberi tahu pengguna soal bug tersebut lewat media sosial',
                ],
                'correct' => 1,
                'explain' => 'Setelah keputusan diambil bersama, QA tetap bertanggung jawab memantau dan memverifikasi perbaikan sesuai kesepakatan, bukan berhenti bekerja atau bertindak sendiri di luar jalur tim.',
            ],
            [
                'level' => 'lanjutan', 'category' => 'risk_based_testing', 'type' => 'fill',
                'question' => 'Analisis yang dilakukan QA untuk menilai seberapa besar dampak dan seberapa sering suatu bagian sistem berpotensi gagal, sebagai dasar prioritas pengujian, disebut analisis ____.',
                'accepted' => ['risiko', 'risk'],
                'explain' => 'Analisis risiko menilai dampak dan kemungkinan kegagalan suatu bagian sistem, dipakai sebagai dasar menentukan prioritas pengujian (risk-based testing).',
            ],
            [
                'level' => 'lanjutan', 'category' => 'sdlc', 'type' => 'fill',
                'question' => "Praktik melibatkan QA sedini mungkin sejak tahap requirement (bukan hanya di akhir sebelum rilis) sering disebut dengan istilah 'shift-____'.",
                'accepted' => ['left', 'kiri'],
                'explain' => 'Shift-left testing berarti menggeser keterlibatan QA lebih awal (ke "kiri" dalam garis waktu SDLC), bukan menunggu sampai akhir sebelum rilis.',
            ],
        ];
    }
}
