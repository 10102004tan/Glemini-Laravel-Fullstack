<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-20">
    <h1 class="text-3xl font-bold text-center mb-10">Kết quả Quiz</h1>
    <div class="text-center mb-5">
        <h2 class="text-2xl">Quiz: {{ $quiz->title }}</h2>
        <p class="text-xl">Điểm của bạn: <span>{{ $result->score }}</span> / {{ $quiz->questions()->count() }}</p>
    </div>
    <div class="text-center">
        <a href="{{ route('home') }}" class="bg-green-500 text-white p-2 rounded">Trang chủ</a>
        <a href="{{ route('quiz.start', $quiz->id) }}" class="bg-orange-500 text-white p-2 rounded">Chơi lại</a>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection