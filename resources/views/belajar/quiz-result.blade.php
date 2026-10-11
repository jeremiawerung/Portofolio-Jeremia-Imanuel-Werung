@extends('belajar.layout')

@section('title', 'Hasil Kuis ' . $levelLabel . ' — ' . $block['title'])

@section('content')
  <div class="hero-kicker">
    <a href="{{ route('belajar.quiz.levels', $block['id']) }}">&larr; kembali ke pilihan level</a>
  </div>
  <h1>Hasil Kuis — Level {{ $levelLabel }}</h1>
  <p class="lede">{{ $block['title'] }} ({{ $block['days'] }})</p>

  @php
    $pct = $total > 0 ? round(($score / $total) * 100) : 0;
  @endphp
  <div class="score-banner">{{ $score }} / {{ $total }} <span style="font-size:18px; color: var(--ink-soft);">({{ $pct }}%)</span></div>
  <div class="score-sub">
    @if ($passScore !== null)
      @if ($passed)
        Lolos ambang batas level ini ({{ round($passScore * 100) }}%).
      @else
        Belum lolos ambang batas level ini (butuh minimal {{ round($passScore * 100) }}%) — level berikutnya masih terkunci.
      @endif
    @else
      Ini level tertinggi — kerjakan lagi kapan saja untuk mengasah, tanpa syarat unlock lagi.
    @endif
  </div>

  @if ($nextLevelUnlockedNow)
    <div class="alert success">Level "{{ $nextLevelLabel }}" baru saja kebuka! <a href="{{ route('belajar.quiz', [$block['id'], $nextLevel]) }}">Coba sekarang &rarr;</a></div>
  @endif

  <section>
    <h2>Analisis</h2>
    <div class="stat-grid">
      <div class="stat-card">
        <div class="stat-label">Percobaan ke-</div>
        <div class="stat-value">{{ $analysis['attemptCount'] }}</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Skor terbaik</div>
        <div class="stat-value">{{ $analysis['bestScore'] }} / {{ $total }}</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Rata-rata skor</div>
        <div class="stat-value">{{ $analysis['averageScore'] }} / {{ $total }}</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Tren vs sebelumnya</div>
        <div class="stat-value {{ $analysis['trend'] === null ? '' : ($analysis['trend'] > 0 ? 'up' : ($analysis['trend'] < 0 ? 'down' : '')) }}">
          @if ($analysis['trend'] === null)
            —
          @else
            {{ $analysis['trend'] > 0 ? '+' . $analysis['trend'] : $analysis['trend'] }}
          @endif
        </div>
      </div>
    </div>
  </section>

  <section>
    <h2>Pembahasan</h2>
    @foreach ($breakdown as $qi => $item)
      <div class="quiz-q">
        <p class="q-text">{{ $qi + 1 }}. {{ $item['q'] }} <span class="category-tag">{{ \App\Support\Belajar\MateriCatalog::categoryLabel($item['category']) }}</span></p>
        @if ($item['type'] === 'fill')
          <div class="fill-answer-box {{ $item['isCorrect'] ? 'correct' : 'wrong' }}">
            <span class="fill-label">Jawabanmu</span>
            {{ $item['chosen'] !== null && $item['chosen'] !== '' ? $item['chosen'] : '(kosong)' }}
          </div>
          @if (!$item['isCorrect'])
            <div class="fill-answer-box correct">
              <span class="fill-label">Jawaban yang diharapkan</span>
              {{ $item['correctDisplay'] }}
            </div>
          @endif
        @else
          @foreach ($item['options'] as $oi => $option)
            @php
              $cls = 'quiz-opt';
              if ($oi === $item['correct']) $cls .= ' correct';
              elseif ($oi === $item['chosen']) $cls .= ' wrong';
            @endphp
            <div class="{{ $cls }}">
              <span>{{ $option }}</span>
            </div>
          @endforeach
        @endif
        <div class="quiz-explain">{{ $item['explain'] }}</div>
      </div>
    @endforeach
  </section>

  <section>
    <h2>Riwayat Percobaan — Level {{ $levelLabel }}</h2>
    <table class="history-table">
      <thead>
        <tr><th>#</th><th>Tanggal</th><th>Skor</th><th>Persentase</th></tr>
      </thead>
      <tbody>
        @foreach ($history as $i => $h)
          <tr class="{{ $h->id === $attempt->id ? 'current-row' : '' }}">
            <td>{{ $i + 1 }}</td>
            <td>{{ $h->created_at->format('d M Y H:i') }}</td>
            <td>{{ $h->score }} / {{ $h->total }}</td>
            <td>{{ $h->percentage() }}%</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>

  <div class="btn-row">
    <a class="btn" href="{{ route('belajar.quiz', [$block['id'], $level]) }}">Ulangi Level {{ $levelLabel }}</a>
    <a class="btn secondary" href="{{ route('belajar.quiz.levels', $block['id']) }}">Pilih Level Lain</a>
    <a class="btn secondary" href="{{ route('belajar.materi', $block['id']) }}">Kembali ke Materi</a>
  </div>
@endsection
