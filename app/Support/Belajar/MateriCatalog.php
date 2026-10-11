<?php

namespace App\Support\Belajar;

/**
 * Single source of truth for the self-study roadmap. Add a new block by
 * appending an array here (status "available" + day1/day2/quizLevels) —
 * routes, views, and progress/skill calculations all read from this list.
 *
 * Quiz QUESTIONS themselves live in the `quiz_questions` database table
 * (see database/seeders/QuizQuestionSeeder.php), not here — this file only
 * defines each level's label/description/unlock threshold. The controller
 * draws a random subset of questions per attempt from whatever is seeded
 * for that materi_id + level, so the bank can keep growing without code
 * changes.
 */
class MateriCatalog
{
    public static function skills(): array
    {
        return [
            'testcase' => 'Test Case Writing',
            'api'      => 'API Testing',
            'bug'      => 'Bug Reporting',
            'sql'      => 'SQL',
            'mobile'   => 'Mobile Testing',
            'agile'    => 'Agile QA',
        ];
    }

    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'days' => 'Hari 1–2',
                'title' => 'Mindset QA & Dasar Software',
                'status' => 'available',
                'skills' => [],
                'videos' => [
                    [
                        'youtubeId' => 'cgPgPPdcC7E',
                        'title' => 'Tutorial SQA Untuk Pemula (Regina Frieska Mufti, Software Quality Assurance)',
                        'channel' => 'BISA AI Academy',
                    ],
                    [
                        'youtubeId' => 'creEQOe3pR4',
                        'title' => 'Belajar Software Quality Assurance | Studi Kasus QA Website Profil Kampus',
                        'channel' => 'Dosen Ngoding',
                    ],
                ],
                'day1' => [
                    'label' => 'Hari 1 — Teori',
                    'intro' => 'Kenali peran QA di tim IT: apa bedanya QA, Developer, dan Business Analyst, lalu pahami konsep Software Development Life Cycle (SDLC) dan siklus hidup sebuah bug (bug lifecycle) dari pertama kali ditemukan sampai ditutup. Tiap bagian di bawah dikasih contoh konkret — bukan cuma definisi.',
                    'sections' => [
                        [
                            'heading' => 'QA vs Developer vs Business Analyst',
                            'body' => 'BA (Business Analyst) menerjemahkan kebutuhan bisnis/pengguna jadi requirement tertulis yang jelas — biasanya berupa user story dan acceptance criteria. Developer membaca requirement itu dan membangun fiturnya. QA masuk dari dua sisi: mereview requirement sebelum development dimulai (supaya tidak ambigu), dan menguji hasilnya sebelum sampai ke pengguna.',
                            'example' => 'Contoh: BA menulis "Sebagai pengguna yang lupa password, saya ingin bisa reset password lewat email agar tidak perlu menghubungi CS", dengan acceptance criteria "link reset expired dalam 15 menit". Developer membangun form lupa password + endpoint kirim email. QA, sebelum development selesai, sudah bertanya: "Apa yang terjadi kalau email tidak terdaftar? Apakah link bisa dipakai berkali-kali?" — lalu setelah fitur jadi, QA yang benar-benar mencoba semua skenario itu satu per satu. Coba bayangkan kalau tidak ada QA: siapa yang sadar link reset bisa dipakai berkali-kali sebelum pengguna komplain di app store?',
                        ],
                        [
                            'heading' => 'Software Development Life Cycle (SDLC)',
                            'body' => 'SDLC adalah tahapan membangun software dari ide sampai dirawat setelah rilis: Requirement & Planning, Design, Development, Testing, Deployment, dan Maintenance. QA punya peran konkret di tiap tahap — bukan cuma di tahap "Testing" saja.',
                            'example' => "Contoh fitur \"tambah metode pembayaran e-wallet\" melewati tiap tahap seperti ini:\n• Requirement & Planning — QA ikut review, bertanya \"bagaimana kalau saldo e-wallet kurang di tengah transaksi?\"\n• Design — QA melihat mockup & alur teknis, mulai menyiapkan draft test plan.\n• Development — QA menyiapkan test case sambil Dev masih coding.\n• Testing — QA menjalankan test case, functional & regression testing, melaporkan bug.\n• Deployment — QA melakukan smoke test di staging/production sebelum fitur diumumkan.\n• Maintenance — QA menguji ulang (regression) tiap ada bug fix atau update kecil.",
                        ],
                        [
                            'heading' => 'Bug Lifecycle',
                            'body' => 'Bug lifecycle adalah alur status sebuah bug dari ditemukan sampai ditutup: New → Assigned → In Progress → Fixed → Retest → Closed (atau Reopened kalau gagal retest).',
                            'example' => "Contoh: bug \"tombol Bayar Sekarang tidak merespon saat memakai voucher diskon\".\n• New — QA menemukan ini saat testing, mencatat steps to reproduce, expected vs actual, dan severity (High, karena menghalangi transaksi).\n• Assigned — bug di-assign ke Developer modul checkout.\n• In Progress — Developer investigasi, ternyata error di validasi voucher yang sudah expired.\n• Fixed — Developer memperbaiki logic validasi, status jadi \"Ready for Retest\".\n• Retest — QA mengulang steps to reproduce yang sama persis, plus skenario terkait (voucher valid, voucher expired, tanpa voucher).\n• Closed — kalau semua skenario lolos. Kalau masih gagal, statusnya kembali ke Reopened dan siklus berulang.",
                        ],
                        [
                            'heading' => 'Bonus: Verification vs Validation (buat yang mau lanjut ke kuis level Lanjutan)',
                            'body' => 'Dua istilah ini sering tertukar. Verification memastikan "kita membangun produk dengan benar" — sesuai spesifikasi/requirement yang ditulis. Validation memastikan "kita membangun produk yang benar" — sesuai kebutuhan pengguna sebenarnya, meski itu mungkin belum tertulis lengkap di requirement.',
                            'example' => 'Contoh: sebuah form registrasi bisa saja 100% sesuai requirement tertulis (lolos verification), tapi kalau ternyata penggunanya kebingungan karena alur formnya berbelit, fitur itu gagal validation — karena tidak benar-benar menjawab kebutuhan pengguna.',
                        ],
                    ],
                    'points' => [
                        'Tonton video pengantar di bawah untuk gambaran dari praktisi QA',
                    ],
                ],
                'day2' => [
                    'label' => 'Hari 2 — Praktek',
                    'intro' => 'Latihan ini namanya "QA Role Mapping" — tujuannya melatih kamu melihat aplikasi sehari-hari dengan mata seorang QA: di titik mana proses QA biasanya terjadi, dan kenapa itu penting. Ikuti langkah-langkahnya, isi tabel pakai template di bawah, lalu jawab pertanyaan pemandunya — jangan mulai dari kertas kosong.',
                    'steps' => [
                        'Pilih satu aplikasi yang kamu pakai/tahu betul cara kerjanya (misalnya ojek online, e-commerce, aplikasi perbankan, atau aplikasi kampus/kantor sendiri).',
                        'Tuliskan 4–6 fitur/proses utama aplikasi itu (contoh untuk ojek online: pemesanan, pembayaran, tracking driver, rating & review, notifikasi).',
                        'Untuk tiap fitur, isi lima kolom di template di bawah. Jangan mikir "harus benar" — cukup tulis tebakan masuk akalmu berdasarkan pemahaman SDLC & bug lifecycle dari Hari 1.',
                        'Setelah tabel selesai, jawab juga empat pertanyaan pemandu di bawah untuk melengkapi refleksimu.',
                        'Simpan hasilnya sebagai dokumen "QA Role Mapping" satu halaman — Google Docs, Notion, atau catatan biasa juga boleh.',
                    ],
                    'template' => [
                        'description' => 'Buat tabel dengan lima kolom berikut, satu baris per fitur:',
                        'columns' => [
                            'Fitur/Proses',
                            'Tahap SDLC saat ini (menurutmu)',
                            'Yang biasa dilakukan Dev/BA',
                            'Titik keterlibatan QA (ngapain)',
                            'Potensi risiko kalau QA tidak dilibatkan',
                        ],
                    ],
                    'example' => [
                        'title' => 'Contoh terisi — Aplikasi Ojek Online (buat gambaran, bukan buat disalin persis)',
                        'rows' => [
                            ['Pemesanan order (booking)', 'Maintenance — rilis fitur "jadwalkan order"', 'BA menulis requirement fitur jadwalkan order; Dev membangun pilihan waktu & validasi jam operasional', 'Review requirement: apa jadi kalau user jadwalkan di luar jam operasional? Lalu testing skenario itu.', 'Order gagal diproses driver tanpa notifikasi jelas ke pengguna, komplain masuk ke CS'],
                            ['Pembayaran (e-wallet)', 'Testing — mendekati rilis', 'Dev integrasi payment gateway pihak ketiga; BA menentukan metode yang didukung', 'Testing saldo kurang, koneksi terputus saat bayar, potensi double charge, refund otomatis', 'User kena charge dua kali tanpa order masuk — kerugian finansial & rusak kepercayaan'],
                            ['Tracking driver real-time', 'Development', 'Dev integrasi GPS & peta; BA menentukan interval update lokasi', 'Review requirement interval update & fallback sinyal lemah; testing di lokasi sinyal lemah', 'Posisi driver tidak update, penumpang menunggu di lokasi yang salah'],
                            ['Rating & review (+ fitur "laporkan driver")', 'Requirement & Planning', 'BA menulis requirement tombol laporkan driver & kategori laporan', 'Ikut review dari awal: apakah user bisa spam laporan palsu? Ada batas minimal?', 'Fitur disalahgunakan untuk menjatuhkan driver tanpa bukti'],
                            ['Notifikasi push (promo)', 'Deployment — baru rilis', 'Dev baru deploy update notifikasi promo', 'Smoke test setelah deploy: kirim notifikasi test, cek tidak menyebabkan crash', 'Notifikasi salah kirim ke user lain, atau crash massal setelah rilis'],
                        ],
                    ],
                    'guidingQuestions' => [
                        'Dari fitur-fitur yang kamu list, mana yang paling berisiko tinggi kalau ada bug (paling merugikan pengguna/bisnis)? Kenapa?',
                        'Requirement seperti apa yang menurutmu wajib direview QA sebelum development dimulai, supaya tidak menimbulkan ambiguitas?',
                        'Sebutkan minimal dua test case sederhana (satu positive, satu negative) untuk salah satu fitur yang kamu list.',
                        'Kalau kamu jadi QA di tim ini dan menemukan fitur yang belum siap rilis, bagaimana caramu menyampaikan itu ke tim tanpa terkesan menghalangi progress?',
                    ],
                    'output' => 'Output: dokumen "QA Role Mapping" satu halaman — isi tabel (4–6 fitur) + jawaban 4 pertanyaan pemandu di atas.',
                ],
                'quizLevels' => [
                    'dasar' => [
                        'label' => 'Dasar',
                        'description' => 'Soal konsep langsung dari materi Hari 1–2. Ada pilihan ganda dan isian singkat.',
                        'passScore' => 0.8,
                    ],
                    'menengah' => [
                        'label' => 'Menengah',
                        'description' => 'Skenario kerja nyata dengan opsi jawaban yang sengaja mirip-mirip, plus isian singkat — perlu paham konsepnya, bukan cuma hafal urutan.',
                        'passScore' => 0.8,
                    ],
                    'lanjutan' => [
                        'label' => 'Lanjutan',
                        'description' => 'Penalaran berlapis dan kritik terhadap artefak yang keliru, plus isian singkat untuk istilah kunci.',
                        'passScore' => null,
                    ],
                ],
            ],
            ['id' => 2, 'days' => 'Hari 3–4',   'title' => 'Test Case & Test Scenario (Web)',      'status' => 'coming-soon', 'skills' => ['testcase']],
            ['id' => 3, 'days' => 'Hari 5–6',   'title' => 'Eksekusi Test & Bug Report',            'status' => 'coming-soon', 'skills' => ['bug']],
            ['id' => 4, 'days' => 'Hari 7–8',   'title' => 'API Testing',                          'status' => 'coming-soon', 'skills' => ['api']],
            ['id' => 5, 'days' => 'Hari 9–10',  'title' => 'Mobile App Testing',                   'status' => 'coming-soon', 'skills' => ['mobile']],
            ['id' => 6, 'days' => 'Hari 11–12', 'title' => 'Database Testing (SQL)',               'status' => 'coming-soon', 'skills' => ['sql']],
            ['id' => 7, 'days' => 'Hari 13–14', 'title' => 'Regression, UAT & QA di Agile',        'status' => 'coming-soon', 'skills' => ['agile']],
            ['id' => 8, 'days' => 'Hari 15–16', 'title' => 'QA Portfolio Guide',                   'status' => 'coming-soon', 'skills' => ['agile']],
            ['id' => 9, 'days' => 'Hari 17–18', 'title' => 'Packaging Portfolio & Interview Prep', 'status' => 'coming-soon', 'skills' => []],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (static::all() as $block) {
            if ($block['id'] === $id) {
                return $block;
            }
        }

        return null;
    }

    /**
     * Public-safe version of a block: quizLevels here only carries
     * label/description/passScore (no questions/answers), so this is safe
     * to send to the browser as-is even without stripping anything further.
     */
    public static function stripQuizAnswers(array $block): array
    {
        return $block;
    }

    /**
     * Ordered list of quiz level keys, easiest first.
     */
    public static function levelOrder(): array
    {
        return ['dasar', 'menengah', 'lanjutan'];
    }

    /**
     * Human-readable labels for quiz_questions.category values, used to
     * render the per-category accuracy breakdown. Falls back to the raw
     * key (title-cased) for a category not listed here.
     */
    public static function categoryLabel(string $category): string
    {
        $labels = [
            'roles' => 'Peran Tim (QA/Dev/BA)',
            'sdlc' => 'SDLC',
            'bug_lifecycle' => 'Bug Lifecycle',
            'requirement_review' => 'Review Requirement',
            'test_case_writing' => 'Test Case Writing',
            'bug_reporting' => 'Bug Reporting',
            'testing_types' => 'Jenis-jenis Testing',
            'risk_based_testing' => 'Risk-Based Testing',
            'verification_validation' => 'Verification vs Validation',
            'release_decision' => 'Keputusan Rilis',
        ];

        return $labels[$category] ?? ucwords(str_replace('_', ' ', $category));
    }
}
