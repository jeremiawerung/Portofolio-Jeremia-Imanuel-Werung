@extends('belajar.layout')

@section('title', 'Pilih Level Kuis — ' . $block['title'])

@section('content')
  <div class="hero-kicker">
    <a href="{{ route('belajar.materi', $block['id']) }}">&larr; kembali ke materi</a>
  </div>
  <h1>Quiz Latihan Pemahaman</h1>
  <p class="lede">{{ $block['title'] }} ({{ $block['days'] }}). Mulai dari Dasar — level berikutnya kebuka otomatis kalau skormu di level sebelumnya lolos ambang batas. Tiap kali kuis dibuka, soal diacak dari bank soal yang lebih besar, jadi tidak selalu soal yang sama persis.</p>

  @if (session('error'))
    <div class="alert error">{{ session('error') }}</div>
  @endif

  <div class="level-grid">
    @foreach ($levels as $lvl)
      @if ($lvl['unlocked'])
        <a class="level-card" href="{{ route('belajar.quiz', [$block['id'], $lvl['key']]) }}">
      @else
        <div class="level-card locked">
      @endif
        <div class="level-card-head">
          <h3 class="level-card-title">{{ $lvl['label'] }}</h3>
          @if ($lvl['unlocked'])
            <span class="badge-lock-state open">terbuka</span>
          @else
            <span class="badge-lock-state locked">terkunci</span>
          @endif
        </div>
        <p class="level-card-desc">{{ $lvl['description'] }}</p>
        <div class="level-card-meta">
          {{ $lvl['attemptSize'] }} soal per percobaan &middot; diacak dari {{ $lvl['poolSize'] }} soal
          @if ($lvl['attemptCount'] > 0)
            &middot; skor terbaik: {{ $lvl['bestScore'] }} / {{ $lvl['bestTotal'] }}
            &middot; {{ $lvl['attemptCount'] }}x dicoba
          @endif
          @if (!$lvl['unlocked'] && $lvl['requiredPrevScore'] !== null)
            &middot; syarat: skor level sebelumnya minimal {{ round($lvl['requiredPrevScore'] * 100) }}%
          @endif
        </div>
      @if ($lvl['unlocked'])
        </a>
      @else
        </div>
      @endif
    @endforeach
  </div>

  @if (!empty($categoryStats))
    <section style="margin-top: 30px;">
      <h2>Analisis per Kategori</h2>
      <p class="lede" style="font-size: 13.5px; margin-bottom: 14px;">Akurasi jawabanmu dari seluruh percobaan kuis di materi ini, kategori paling lemah ditampilkan lebih dulu.</p>
      <div class="template-box">
        @foreach ($categoryStats as $cat)
          <div class="category-stat-row">
            <div class="category-stat-name">
              {{ \App\Support\Belajar\MateriCatalog::categoryLabel($cat['category']) }}
              @if ($cat['accuracy'] < 70)
                <span class="weak-flag">perlu diperkuat</span>
              @endif
            </div>
            <div class="skill-track"><div class="skill-fill" style="width:{{ $cat['accuracy'] }}%; {{ $cat['accuracy'] < 70 ? 'background: var(--red);' : '' }}"></div></div>
            <div class="category-stat-pct">{{ $cat['accuracy'] }}% <span style="opacity:.6;">({{ $cat['correct'] }}/{{ $cat['total'] }})</span></div>
          </div>
        @endforeach
      </div>
    </section>
  @endif
@endsection
