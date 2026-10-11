@extends('belajar.layout')

@section('title', 'Roadmap')

@section('content')
  <header>
    <div class="hero-kicker">jalur belajar mandiri, per dua hari sekali</div>
    <h1>Dashboard Belajar QA Engineer</h1>
    <p class="lede">Sembilan blok materi, dua hari per blok. Buka satu blok untuk baca materi, centang harinya, lalu kerjakan kuis latihan pemahamannya.</p>
    <div class="progress-row">
      <div class="progress-ticks" id="ticks"></div>
      <div class="progress-label"><strong id="doneCount">0</strong> / <span id="totalCount">{{ count($blocks) * 2 }}</span> hari selesai</div>
    </div>
  </header>

  <section id="skillSection">
    <h2>Progress per Skill</h2>
    <div class="skill-grid" id="skillGrid"></div>
  </section>

  <section id="roadmapSection">
    <h2>Roadmap Materi</h2>
    @foreach ($blocks as $i => $block)
      @php $isAvailable = $block['status'] === 'available'; @endphp
      @if ($isAvailable)
        <a class="block" href="{{ route('belajar.materi', $block['id']) }}">
      @else
        <div class="block locked">
      @endif
        <div class="block-head">
          <span class="block-index">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
          <span class="block-days">{{ $block['days'] }}</span>
          <h3 class="block-title">{{ $block['title'] }}</h3>
          @if (!$isAvailable)
            <span class="badge-locked">belum tersedia</span>
          @elseif ($block['hasQuiz'])
            <span class="badge-quiz">ada kuis</span>
          @endif
        </div>
      @if ($isAvailable)
        </a>
      @else
        </div>
      @endif
    @endforeach
  </section>

<script>
  const BLOCKS_META = @json($blocksMeta);
  const SKILLS = @json($skills);

  const KEY_PROGRESS = "qaDashboard.progress.v1";

  function loadJSON(key) {
    try { const raw = localStorage.getItem(key); return raw ? JSON.parse(raw) : {}; }
    catch (e) { return {}; }
  }
  function dayKey(blockId, dayNum) { return "b" + blockId + "d" + dayNum; }

  const progress = loadJSON(KEY_PROGRESS);

  function renderTicks() {
    const ticksWrap = document.getElementById("ticks");
    ticksWrap.innerHTML = "";
    let doneCount = 0;
    BLOCKS_META.forEach(block => {
      for (let d = 1; d <= 2; d++) {
        const done = !!progress[dayKey(block.id, d)];
        if (done) doneCount++;
        const t = document.createElement("div");
        t.className = "tick" + (done ? " done" : "");
        ticksWrap.appendChild(t);
      }
    });
    document.getElementById("doneCount").textContent = doneCount;
  }

  function renderSkillBars() {
    const grid = document.getElementById("skillGrid");
    grid.innerHTML = "";
    Object.keys(SKILLS).forEach(key => {
      const relevant = BLOCKS_META.filter(b => b.available && b.skills.includes(key));
      let total = 0, done = 0;
      relevant.forEach(b => {
        total += 2;
        if (progress[dayKey(b.id, 1)]) done++;
        if (progress[dayKey(b.id, 2)]) done++;
      });
      const pct = total === 0 ? 0 : Math.round((done / total) * 100);
      const row = document.createElement("div");
      row.className = "skill-row";
      row.innerHTML = `
        <div class="skill-name">${SKILLS[key]}</div>
        <div class="skill-track"><div class="skill-fill" style="width:${pct}%"></div></div>
        <div class="skill-pct">${pct}%</div>
      `;
      grid.appendChild(row);
    });
  }

  renderTicks();
  renderSkillBars();
</script>
@endsection
