{{-- Halaman error sengaja berdiri sendiri (gak pakai layout/Vite),
     biar tetap bisa tampil walaupun yang error justru bagian lain aplikasi. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>{{ $code }} — Jeremia Werung</title>
    <style>
        :root { color-scheme: dark; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 1rem;
               background: #0a0f1d; color: #f1f5f9; font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        main { max-width: 28rem; text-align: center; }
        .code { font-size: 4rem; font-weight: 800; letter-spacing: -0.04em; margin: 0;
                background: linear-gradient(135deg, #6366f1, #8b5cf6, #06b6d4); -webkit-background-clip: text; background-clip: text; color: transparent; }
        h1 { font-size: 1.25rem; margin: 0.5rem 0; }
        p { color: #94a3b8; line-height: 1.6; margin: 0 0 1.5rem; }
        a { display: inline-block; padding: 0.7rem 1.3rem; border-radius: 0.75rem; background: #4f46e5; color: #fff; text-decoration: none; font-weight: 600; font-size: 0.9rem; }
        a:hover { background: #6366f1; }
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
