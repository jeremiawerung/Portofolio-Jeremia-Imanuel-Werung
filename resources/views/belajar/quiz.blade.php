@extends('belajar.layout')

@section('title', 'Kuis ' . $levelLabel . ': ' . $block['title'])

@section('content')
  <div class="hero-kicker">
    <a href="{{ route('belajar.quiz.levels', $block['id']) }}">&larr; pilih level lain</a>
  </div>
  <h1>Kuis Level {{ $levelLabel }}</h1>
  <p class="lede">{{ $block['title'] }} ({{ $block['days'] }}), {{ count($questions) }} dari {{ $poolSize }} soal di bank soal level ini, diacak setiap kamu mulai kuis.</p>

  <form method="POST" action="{{ route('belajar.quiz.submit', [$block['id'], $level]) }}">
    @csrf
    @foreach ($questions as $qi => $question)
      <input type="hidden" name="question_ids[]" value="{{ $question['id'] }}">
      <div class="quiz-q">
        <p class="q-text">{{ $qi + 1 }}. {{ $question['question'] }}</p>
        @if ($question['type'] === 'fill')
          <input type="text" class="fill-input" name="answers[{{ $question['id'] }}]" placeholder="isian singkat" autocomplete="off" required>
        @else
          @foreach ($question['options'] as $oi => $option)
            <label class="quiz-opt">
              <input type="radio" name="answers[{{ $question['id'] }}]" value="{{ $oi }}" required>
              <span>{{ $option }}</span>
            </label>
          @endforeach
        @endif
      </div>
    @endforeach

    <div class="btn-row">
      <button type="submit" class="btn">Cek Jawaban</button>
    </div>
  </form>
@endsection
