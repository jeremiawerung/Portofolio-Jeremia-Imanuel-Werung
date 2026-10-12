{{-- Halaman error sengaja berdiri sendiri (gak pakai layout/Vite),
     biar tetap bisa tampil walaupun yang error justru bagian lain aplikasi. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>{{ $code }} | Jeremia Werung</title>
    <style>
        :root { color-scheme: light dark; --page: #f2eee6; --ink: #1f1b17; --ink-2: #4a433c; --accent: #a3482a; --accent-ink: #fff; }
        @media (prefers-color-scheme: dark) {
            :root { --page: #151311; --ink: #eee8df; --ink-2: #c2b9ad; --accent: #e08a65; --accent-ink: #1a1714; }
        }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 1rem;
               background: var(--page); color: var(--ink); font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; }
        main { max-width: 28rem; text-align: center; }
        .code { font-family: Georgia, 'Times New Roman', serif; font-size: 4rem; font-weight: 600; margin: 0; color: var(--accent); }
        h1 { font-family: Georgia, 'Times New Roman', serif; font-size: 1.4rem; font-weight: 600; margin: 0.5rem 0; }
        p { color: var(--ink-2); line-height: 1.6; margin: 0 0 1.5rem; }
        a { display: inline-block; padding: 0.65rem 1.1rem; border-radius: 0.5rem; background: var(--accent); color: var(--accent-ink); text-decoration: none; font-weight: 600; font-size: 0.9rem; }
    </style>
</head>
<body>
    <main>
        <p class="code">{{ $code }}</p>
        <h1>{{ $title }}</h1>
        <p>{{ $message }}</p>
        <a href="{{ url('/') }}">Back to home</a>
    </main>
</body>
</html>
