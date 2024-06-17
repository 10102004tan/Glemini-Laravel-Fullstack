<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center bg-gradient-to-r from-[#282458] to-[#141816] w-full p-10">
    <img class="rounded-[15px]" src="{{ asset('images/quizz-img.png') }}" alt="Image Description Quizz" width="700px">

    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-50 pt-5 text-center">
        {{ $quiz->title }}
    </h1>
    <div class="mt-5">
        <div class="flex items-center justify-center space-x-3 mx-auto max-w-md">
            <img class="w-10 h-10 rounded-full" src="{{ asset('storage/'.$quiz->thumb) }}" alt="CharmingGreekArt avatar">
            <div class="font-medium text-white flex space-x-1 sm:space-x-2">
                <div>
                    <span class="hidden sm:inline">
                        Created by
                    </span>
                    {{ $quiz->user->name }}
                </div>
            </div>
        </div>
    </div>
    <div class="mt-12">
        <a class="text-gray-700 max-w-xl mx-auto" href="{{ route('quiz.start', $quiz->id) }}">
            <div class="border p-3 rounded-md text-center cursor-pointer hover:border-b-yellow-400 border-b-4 bg-indigo-50 w-full">
                <div class="text-md font-semibold mt-2 text-[var(--background)]">
                    Start Quiz
                </div>
            </div>
        </a>
    </div>

</div>
@endsection

@section('script')
<script>

</script>
@endsection