<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-center mb-4">Kết quả Quiz</h1>
    <div class="text-center mb-4">
        <h2 class="text-2xl">Quiz: {{ $quiz->title }}</h2>
        <p class="text-xl">Điểm của bạn: {{ $result->score }} / {{ $quiz->questions()->count() }}</p>
    </div>
    <div class="text-center">
        <a href="{{ route('home') }}" class="bg-blue-500 text-white p-2 rounded">Quay lại danh sách Quiz</a>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection