<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="robots" content="noindex, nofollow">
<title>@yield('title', 'Belajar QA') | Dashboard Belajar QA</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --ink: #202B28;
    --ink-soft: #57625D;
    --paper: #F1EFE4;
    --paper-alt: #E7E2CF;
    --line: rgba(32,43,40,0.16);
    --line-strong: rgba(32,43,40,0.32);
    --amber: #C58A2E;
    --teal: #2F6E5C;
    --teal-soft: rgba(47,110,92,0.14);
    --coral: #B24E36;
    --coral-soft: rgba(178,78,54,0.12);
    --red: #B23A3A;
    --red-soft: rgba(178,58,58,0.12);
    --font-display: "Sora", system-ui, -apple-system, "Segoe UI", sans-serif;
    --font-mono: "IBM Plex Mono", ui-monospace, "SF Mono", Menlo, monospace;
  }
  @media (prefers-color-scheme: dark) {
    :root:not([data-theme="light"]) {
      --ink: #ECE7D8; --ink-soft: #A9A190; --paper: #171B19; --paper-alt: #1F2422;
      --line: rgba(236,231,216,0.14); --line-strong: rgba(236,231,216,0.3);
      --amber: #D9A94D; --teal: #5FA98E; --teal-soft: rgba(95,169,142,0.16);
      --coral: #D97C5F; --coral-soft: rgba(217,124,95,0.14);
      --red: #E08787; --red-soft: rgba(224,135,135,0.16);
    }
  }
  :root[data-theme="dark"] {
    --ink: #ECE7D8; --ink-soft: #A9A190; --paper: #171B19; --paper-alt: #1F2422;
    --line: rgba(236,231,216,0.14); --line-strong: rgba(236,231,216,0.3);
    --amber: #D9A94D; --teal: #5FA98E; --teal-soft: rgba(95,169,142,0.16);
    --coral: #D97C5F; --coral-soft: rgba(217,124,95,0.14);
    --red: #E08787; --red-soft: rgba(224,135,135,0.16);
  }
  * { box-sizing: border-box; }
  body {
    margin: 0; background: var(--paper); color: var(--ink);
    font-family: var(--font-display);
    padding-top: env(safe-area-inset-top, 0px);
    padding-bottom: env(safe-area-inset-bottom, 0px);
    -webkit-font-smoothing: antialiased;
  }
  a { color: var(--teal); }
  .wrap { max-width: 820px; margin: 0 auto; padding: 32px 22px 80px; }

  nav.top-nav {
    display: flex; gap: 16px; flex-wrap: wrap; align-items: center;
    font-family: var(--font-mono); font-size: 12.5px;
    padding-bottom: 18px; margin-bottom: 24px;
    border-bottom: 1px solid var(--line-strong);
  }
  nav.top-nav a { color: var(--ink-soft); text-decoration: none; }
  nav.top-nav a:hover { color: var(--teal); }
  nav.top-nav .brand { color: var(--ink); font-weight: 600; margin-right: auto; }

  .hero-kicker { font-family: var(--font-mono); font-size: 12.5px; letter-spacing: 0.02em; color: var(--ink-soft); margin-bottom: 10px; }
  h1 { font-size: clamp(26px, 6vw, 36px); line-height: 1.1; font-weight: 800; margin: 0 0 12px; letter-spacing: -0.01em; }
  h2.section-title, section > h2 {
    font-size: 13px; font-family: var(--font-mono); color: var(--ink-soft);
    margin: 0 0 14px; font-weight: 500; letter-spacing: 0.02em; text-transform: uppercase;
  }
  p.lede { font-size: 15.5px; line-height: 1.55; color: var(--ink-soft); max-width: 60ch; margin: 0 0 26px; }

  section { margin-bottom: 34px; }

  .progress-row { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }
  .progress-ticks { display: flex; gap: 4px; flex: 1 1 260px; min-width: 200px; }
  .tick { height: 10px; flex: 1; background: var(--paper-alt); border: 1px solid var(--line); border-radius: 1px; transition: background 0.25s ease; }
  .tick.done { background: var(--teal); border-color: var(--teal); }
  .progress-label { font-family: var(--font-mono); font-size: 13px; color: var(--ink-soft); white-space: nowrap; }
  .progress-label strong { color: var(--ink); font-weight: 600; }

  .skill-grid { display: grid; gap: 12px; }
  .skill-row { display: grid; grid-template-columns: 150px 1fr 42px; align-items: center; gap: 12px; }
  .skill-name { font-size: 13.5px; color: var(--ink); }
  .skill-track { height: 8px; background: var(--paper-alt); border: 1px solid var(--line); border-radius: 4px; overflow: hidden; }
  .skill-fill { height: 100%; background: var(--teal); border-radius: 4px 0 0 4px; transition: width 0.3s ease; }
  .skill-pct { font-family: var(--font-mono); font-size: 12.5px; color: var(--ink-soft); text-align: right; }

  .block {
    border: 1px solid var(--line); border-radius: 6px; padding: 22px; margin-bottom: 16px; background: var(--paper-alt);
    display: block; text-decoration: none; color: inherit;
  }
  .block.locked { opacity: 0.68; cursor: default; }
  .block-head { display: flex; align-items: baseline; gap: 10px; flex-wrap: wrap; margin-bottom: 6px; }
  .block-index { font-family: var(--font-mono); font-size: 12.5px; color: var(--ink-soft); }
  .block-days { font-family: var(--font-mono); font-size: 12.5px; color: var(--teal); background: var(--teal-soft); padding: 2px 8px; border-radius: 2px; }
  .block-title { font-size: 18px; font-weight: 700; margin: 0; letter-spacing: -0.005em; }
  .badge-locked { font-family: var(--font-mono); font-size: 11.5px; color: var(--ink-soft); border: 1px solid var(--line-strong); padding: 2px 8px; border-radius: 2px; margin-left: auto; }
  .badge-quiz { font-family: var(--font-mono); font-size: 11.5px; color: var(--teal); border: 1px solid var(--teal); padding: 2px 8px; border-radius: 2px; margin-left: auto; }

  .video-embed { position: relative; width: 100%; padding-top: 56.25%; background: #000; border-radius: 4px; overflow: hidden; margin: 14px 0 6px; }
  .video-embed iframe { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; }
  .video-meta { font-size: 12.5px; color: var(--ink-soft); margin-bottom: 16px; }
  .video-meta strong { color: var(--ink); }

  .day { margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--line); }
  .day:first-of-type { border-top: none; }
  .day-head { display: flex; align-items: center; gap: 9px; margin-bottom: 6px; cursor: pointer; user-select: none; }
  .day-head input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--teal); cursor: pointer; }
  .day-head .day-label { font-family: var(--font-mono); font-size: 12.5px; color: var(--ink-soft); }
  .day.checked .day-label { color: var(--teal); }
  .day p { margin: 0 0 6px; font-size: 14.5px; line-height: 1.6; color: var(--ink); }
  .day ul, .day ol { margin: 0 0 6px; padding-left: 20px; }
  .day li { font-size: 14px; line-height: 1.6; color: var(--ink-soft); margin-bottom: 3px; }
  .day .output { font-size: 13.5px; color: var(--coral); background: var(--coral-soft); display: inline-block; padding: 3px 9px; border-radius: 2px; margin-top: 2px; }

  .content-section { margin: 18px 0; padding: 16px 18px; border: 1px solid var(--line); border-radius: 5px; background: var(--paper); }
  .content-section h4 { margin: 0 0 8px; font-size: 15px; }
  .content-section p { margin: 0 0 8px; font-size: 14px; line-height: 1.6; color: var(--ink); }
  .content-section .example-box {
    margin-top: 10px; padding: 10px 12px; background: var(--teal-soft); border-left: 3px solid var(--teal);
    border-radius: 0 4px 4px 0; font-size: 13.5px; line-height: 1.6; white-space: pre-line;
  }
  .content-section .example-box strong { display: block; font-family: var(--font-mono); font-size: 11px; text-transform: uppercase; color: var(--teal); margin-bottom: 4px; }

  .step-list { margin: 0; padding-left: 22px; }
  .step-list li { font-size: 14px; line-height: 1.65; color: var(--ink); margin-bottom: 8px; }

  .template-box { margin: 14px 0; padding: 14px 16px; border: 1px dashed var(--line-strong); border-radius: 5px; background: var(--paper); }
  .template-box p { margin: 0 0 8px; font-size: 13.5px; color: var(--ink-soft); }
  .template-box ol { margin: 0; padding-left: 20px; }
  .template-box li { font-size: 13.5px; line-height: 1.6; margin-bottom: 3px; }

  .example-table-wrap { overflow-x: auto; margin: 10px 0 14px; }
  table.example-table { border-collapse: collapse; width: 100%; min-width: 640px; font-size: 12.5px; }
  table.example-table th, table.example-table td { border: 1px solid var(--line); padding: 8px 10px; text-align: left; vertical-align: top; line-height: 1.5; }
  table.example-table th { font-family: var(--font-mono); font-size: 11px; text-transform: uppercase; color: var(--ink-soft); background: var(--paper-alt); }

  .guiding-questions { margin: 0; padding-left: 20px; }
  .guiding-questions li { font-size: 14px; line-height: 1.6; margin-bottom: 8px; color: var(--ink); }

  .level-grid { display: grid; gap: 14px; }
  .level-card { border: 1px solid var(--line); border-radius: 6px; padding: 18px 20px; background: var(--paper-alt); display: flex; flex-direction: column; gap: 8px; text-decoration: none; color: inherit; }
  .level-card.locked { opacity: 0.6; cursor: default; }
  .level-card-head { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
  .level-card-title { font-size: 16px; font-weight: 700; margin: 0; }
  .level-card-desc { font-size: 13.5px; color: var(--ink-soft); line-height: 1.5; margin: 0; }
  .level-card-meta { font-family: var(--font-mono); font-size: 12px; color: var(--ink-soft); }
  .badge-lock-state { font-family: var(--font-mono); font-size: 11px; padding: 2px 8px; border-radius: 2px; margin-left: auto; }
  .badge-lock-state.open { color: var(--teal); border: 1px solid var(--teal); }
  .badge-lock-state.locked { color: var(--ink-soft); border: 1px solid var(--line-strong); }

  .alert { padding: 12px 16px; border-radius: 5px; font-size: 13.5px; margin-bottom: 18px; }
  .alert.error { background: var(--red-soft); color: var(--red); border: 1px solid var(--red); }
  .alert.success { background: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal); }

  .notes-wrap { margin-top: 16px; }
  .notes-wrap label { display: block; font-family: var(--font-mono); font-size: 12px; color: var(--ink-soft); margin-bottom: 6px; }
  textarea.notes-area {
    width: 100%; min-height: 100px; resize: vertical; background: var(--paper); color: var(--ink);
    border: 1px solid var(--line-strong); border-radius: 4px; padding: 10px 12px;
    font-family: var(--font-mono); font-size: 13px; line-height: 1.5;
  }
  textarea.notes-area:focus { outline: 2px solid var(--teal); outline-offset: 1px; }
  .save-hint { font-family: var(--font-mono); font-size: 11px; color: var(--ink-soft); margin-top: 4px; min-height: 14px; }

  .quiz-q { margin-bottom: 18px; }
  .quiz-q p.q-text { font-size: 14.5px; margin: 0 0 8px; font-weight: 600; }
  .quiz-opt { display: flex; align-items: flex-start; gap: 8px; font-size: 13.5px; padding: 8px 10px; border-radius: 3px; cursor: pointer; border: 1px solid transparent; }
  .quiz-opt:hover { background: var(--paper); }
  .quiz-opt.correct { background: var(--teal-soft); border-color: var(--teal); }
  .quiz-opt.wrong { background: var(--red-soft); border-color: var(--red); }
  .quiz-opt input { margin-top: 3px; accent-color: var(--teal); }
  .quiz-explain { font-size: 12.5px; color: var(--ink-soft); margin: 6px 0 0 2px; line-height: 1.5; }
  .category-tag {
    font-family: var(--font-mono); font-size: 10.5px; text-transform: uppercase; letter-spacing: 0.02em;
    color: var(--ink-soft); background: var(--paper-alt); border: 1px solid var(--line); border-radius: 2px;
    padding: 2px 7px; margin-left: 6px; white-space: nowrap; vertical-align: middle;
  }
  .category-stat-row {
    display: grid; grid-template-columns: 1fr 1fr 44px; align-items: center; gap: 12px;
    padding: 8px 0; border-bottom: 1px solid var(--line);
  }
  .category-stat-row:last-child { border-bottom: none; }
  .category-stat-name { font-size: 13.5px; }
  .category-stat-name .weak-flag { color: var(--red); font-family: var(--font-mono); font-size: 10.5px; margin-left: 6px; }
  .category-stat-pct { font-family: var(--font-mono); font-size: 12.5px; text-align: right; color: var(--ink-soft); }
  input.fill-input {
    width: 100%; max-width: 320px; font-family: var(--font-mono); font-size: 14px;
    padding: 9px 12px; border: 1px solid var(--line-strong); border-radius: 4px;
    background: var(--paper); color: var(--ink);
  }
  input.fill-input:focus { outline: 2px solid var(--teal); outline-offset: 1px; }
  .fill-answer-box { font-size: 13.5px; padding: 8px 10px; border-radius: 3px; border: 1px solid transparent; margin-bottom: 4px; }
  .fill-answer-box.correct { background: var(--teal-soft); border-color: var(--teal); }
  .fill-answer-box.wrong { background: var(--red-soft); border-color: var(--red); }
  .fill-answer-box .fill-label { font-family: var(--font-mono); font-size: 11px; text-transform: uppercase; color: var(--ink-soft); display: block; margin-bottom: 2px; }

  button.btn, a.btn {
    font-family: var(--font-mono); font-size: 12.5px; background: var(--teal); color: var(--paper);
    border: none; padding: 9px 18px; border-radius: 3px; cursor: pointer; display: inline-block; text-decoration: none;
  }
  button.btn:hover, a.btn:hover { opacity: 0.9; }
  button.btn.secondary, a.btn.secondary { background: transparent; color: var(--ink); border: 1px solid var(--line-strong); }
  .btn-row { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; margin-top: 18px; }

  .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 12px; margin-bottom: 20px; }
  .stat-card { border: 1px solid var(--line); border-radius: 6px; padding: 14px 16px; background: var(--paper-alt); }
  .stat-card .stat-label { font-family: var(--font-mono); font-size: 11px; color: var(--ink-soft); text-transform: uppercase; letter-spacing: 0.02em; }
  .stat-card .stat-value { font-size: 24px; font-weight: 800; margin-top: 4px; }
  .stat-card .stat-value.up { color: var(--teal); }
  .stat-card .stat-value.down { color: var(--red); }

  table.history-table { width: 100%; border-collapse: collapse; font-size: 13px; }
  table.history-table th, table.history-table td { text-align: left; padding: 8px 10px; border-bottom: 1px solid var(--line); }
  table.history-table th { font-family: var(--font-mono); font-size: 11px; color: var(--ink-soft); text-transform: uppercase; }
  table.history-table tr.current-row { background: var(--teal-soft); }

  .score-banner { font-size: 32px; font-weight: 800; margin-bottom: 4px; }
  .score-sub { font-size: 14px; color: var(--ink-soft); margin-bottom: 20px; }

  .api-tester { border: 1px solid var(--line); border-radius: 6px; padding: 22px; background: var(--paper-alt); }
  .api-row { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 10px; }
  .api-row select, .api-row input[type="text"] { font-family: var(--font-mono); font-size: 13px; padding: 8px 10px; border: 1px solid var(--line-strong); border-radius: 4px; background: var(--paper); color: var(--ink); }
  .api-row select { flex: 0 0 100px; }
  .api-row input[type="text"] { flex: 1 1 260px; min-width: 180px; }
  textarea.api-body { width: 100%; min-height: 80px; font-family: var(--font-mono); font-size: 13px; padding: 10px 12px; border: 1px solid var(--line-strong); border-radius: 4px; background: var(--paper); color: var(--ink); margin-bottom: 10px; }
  .api-result { margin-top: 14px; border-top: 1px solid var(--line); padding-top: 14px; }
  .api-status { font-family: var(--font-mono); font-size: 13px; margin-bottom: 8px; }
  .api-status.ok { color: var(--teal); }
  .api-status.err { color: var(--red); }
  pre.api-response { background: var(--paper); border: 1px solid var(--line); border-radius: 4px; padding: 12px; font-family: var(--font-mono); font-size: 12.5px; line-height: 1.5; max-height: 340px; overflow: auto; white-space: pre-wrap; word-break: break-word; }
  .api-note { font-size: 12px; color: var(--ink-soft); margin-top: 10px; line-height: 1.5; }

  details.howto { border: 1px solid var(--line); border-radius: 6px; padding: 14px 18px; background: var(--paper-alt); }
  details.howto summary { cursor: pointer; font-family: var(--font-mono); font-size: 12.5px; color: var(--ink-soft); }
  details.howto .howto-body { margin-top: 12px; font-size: 13.5px; line-height: 1.6; }
  details.howto code { font-family: var(--font-mono); background: var(--paper); border: 1px solid var(--line); padding: 1px 6px; border-radius: 3px; font-size: 12.5px; }

  footer { margin-top: 36px; padding-top: 20px; border-top: 1px solid var(--line-strong); font-size: 13px; color: var(--ink-soft); line-height: 1.6; }
  footer strong { color: var(--ink); }

  @media (max-width: 480px) {
    .skill-row { grid-template-columns: 110px 1fr 36px; }
    .block { padding: 16px; }
  }
</style>
</head>
<body>
<div class="wrap">
  <nav class="top-nav">
    <span class="brand">Belajar QA</span>
    <a href="{{ route('belajar.index') }}">Roadmap</a>
    <a href="{{ route('belajar.api-tester') }}">Mini API Tester</a>
  </nav>

  @yield('content')

  <footer>
    <strong>Cara pakai:</strong> centang hari yang sudah selesai di halaman tiap materi, lalu klik "Quiz Latihan Pemahaman" kalau sudah siap. Progress hari dan catatan tersimpan di browser ini (<code>localStorage</code>); hasil kuis tersimpan di database supaya bisa dianalisis dari waktu ke waktu.
  </footer>
</div>
</body>
</html>
