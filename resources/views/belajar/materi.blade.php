@extends('belajar.layout')

@section('title', $block['title'])

@section('content')
  <div class="hero-kicker">
    <a href="{{ route('belajar.index') }}">&larr; kembali ke roadmap</a>
  </div>
  <div class="block-head" style="margin-top: 10px;">
    <span class="block-days">{{ $block['days'] }}</span>
    <h1 style="margin: 0;">{{ $block['title'] }}</h1>
  </div>

  @if (!empty($block['videos']))
    @foreach ($block['videos'] as $video)
      <div class="video-embed">
        <iframe src="https://www.youtube.com/embed/{{ $video['youtubeId'] }}" title="{{ $video['title'] }}" allowfullscreen loading="lazy"></iframe>
      </div>
      <div class="video-meta"><strong>{{ $video['title'] }}</strong> — {{ $video['channel'] }}</div>
    @endforeach
  @endif

  <div class="day" id="day1">
    <label class="day-head">
      <input type="checkbox" data-key="b{{ $block['id'] }}d1">
      <span class="day-label">{{ strtoupper($block['day1']['label']) }}</span>
    </label>
    <p>{{ $block['day1']['intro'] }}</p>

    @foreach ($block['day1']['sections'] as $section)
      <div class="content-section">
        <h4>{{ $section['heading'] }}</h4>
        <p>{{ $section['body'] }}</p>
        @if (!empty($section['example']))
          <div class="example-box">
            <strong>Contoh</strong>{{ $section['example'] }}
          </div>
        @endif
      </div>
    @endforeach

    @if (!empty($block['day1']['points']))
      <ul>
        @foreach ($block['day1']['points'] as $point)
          <li>{{ $point }}</li>
        @endforeach
      </ul>
    @endif
  </div>

  <div class="day" id="day2">
    <label class="day-head">
      <input type="checkbox" data-key="b{{ $block['id'] }}d2">
      <span class="day-label">{{ strtoupper($block['day2']['label']) }}</span>
    </label>
    <p>{{ $block['day2']['intro'] }}</p>

    @if (!empty($block['day2']['steps']))
      <ol class="step-list">
        @foreach ($block['day2']['steps'] as $step)
          <li>{{ $step }}</li>
        @endforeach
      </ol>
    @endif

    @if (!empty($block['day2']['template']))
      <div class="template-box">
        <p><strong>Template</strong> — {{ $block['day2']['template']['description'] }}</p>
        <ol>
          @foreach ($block['day2']['template']['columns'] as $col)
            <li>{{ $col }}</li>
          @endforeach
        </ol>
      </div>
    @endif

    @if (!empty($block['day2']['example']))
      <p style="font-size: 13.5px; color: var(--ink-soft); margin-bottom: 6px;"><strong style="color: var(--ink);">{{ $block['day2']['example']['title'] }}</strong></p>
      <div class="example-table-wrap">
        <table class="example-table">
          <thead>
            <tr>
              @foreach ($block['day2']['template']['columns'] as $col)
                <th>{{ $col }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($block['day2']['example']['rows'] as $row)
              <tr>
                @foreach ($row as $cell)
                  <td>{{ $cell }}</td>
                @endforeach
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    @if (!empty($block['day2']['guidingQuestions']))
      <p style="font-size: 13.5px; color: var(--ink-soft); margin: 14px 0 6px;"><strong style="color: var(--ink);">Pertanyaan pemandu</strong> — jawab ini untuk melengkapi dokumenmu:</p>
      <ul class="guiding-questions">
        @foreach ($block['day2']['guidingQuestions'] as $q)
          <li>{{ $q }}</li>
        @endforeach
      </ul>
    @endif

    <span class="output">{{ $block['day2']['output'] }}</span>
  </div>

  <div class="notes-wrap">
    <label for="notes-area">Catatan / latihan bebas — blok ini</label>
    <textarea class="notes-area" id="notes-area" placeholder="Tulis catatan, test case, atau bug report latihanmu di sini..."></textarea>
    <div class="save-hint" id="save-hint"></div>
  </div>

  @if ($block['hasQuiz'])
    <div class="btn-row">
      <a class="btn" href="{{ route('belajar.quiz.levels', $block['id']) }}">Quiz Latihan Pemahaman ({{ $block['quizQuestionCount'] }} soal, 3 level) →</a>
    </div>
  @endif

<script>
  const BLOCK_ID = {{ $block['id'] }};
  const KEY_PROGRESS = "qaDashboard.progress.v1";
  const KEY_NOTES = "qaDashboard.notes.v1";

  function loadJSON(key) {
    try { const raw = localStorage.getItem(key); return raw ? JSON.parse(raw) : {}; }
    catch (e) { return {}; }
  }
  function saveJSON(key, val) {
    try { localStorage.setItem(key, JSON.stringify(val)); } catch (e) {}
  }

  let progress = loadJSON(KEY_PROGRESS);
  let notes = loadJSON(KEY_NOTES);

  document.querySelectorAll('input[type="checkbox"][data-key]').forEach(cb => {
    const key = cb.getAttribute('data-key');
    cb.checked = !!progress[key];
    if (cb.checked) cb.closest('.day').classList.add('checked');
    cb.addEventListener('change', () => {
      progress[key] = cb.checked;
      saveJSON(KEY_PROGRESS, progress);
      cb.closest('.day').classList.toggle('checked', cb.checked);
    });
  });

  const notesArea = document.getElementById('notes-area');
  const saveHint = document.getElementById('save-hint');
  notesArea.value = notes[BLOCK_ID] || "";
  let saveTimer = null;
  notesArea.addEventListener('input', () => {
    notes[BLOCK_ID] = notesArea.value;
    saveHint.textContent = "menyimpan...";
    clearTimeout(saveTimer);
    saveTimer = setTimeout(() => {
      saveJSON(KEY_NOTES, notes);
      saveHint.textContent = "tersimpan";
    }, 400);
  });
</script>
@endsection
