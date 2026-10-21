@php
    // Data terstruktur (schema.org) buat Google sama AI: siapa pemilik web ini dan akun mana aja yang punya dia
    $owner = config('portfolio.owner');
    $personId = url('/') . '#person';

    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Person',
                '@id' => $personId,
                'name' => $owner['name'],
                'url' => url('/'),
                'image' => asset('images/profile.jpeg'),
                'jobTitle' => $owner['job_title'],
                'description' => 'QA engineer and web developer based in Yogyakarta, Indonesia. Manual and automated testing (Playwright, PHPUnit) and Laravel web development.',
                'email' => 'mailto:' . $owner['email'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $owner['city'],
                    'addressCountry' => $owner['country'],
                ],
                'alumniOf' => [
                    '@type' => 'CollegeOrUniversity',
                    'name' => $owner['university'],
                ],
                'knowsAbout' => ['Software Quality Assurance', 'Manual Testing', 'Test Automation', 'Playwright', 'PHPUnit', 'Laravel', 'PHP', 'Web Development'],
                'sameAs' => array_values($owner['profiles']),
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'url' => url('/'),
                'name' => $owner['name'],
                'inLanguage' => 'en',
                'author' => ['@id' => $personId],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
