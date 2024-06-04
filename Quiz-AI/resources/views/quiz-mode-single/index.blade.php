<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center bg-gray-700 w-full p-10">
    <img class="rounded-[15px]" src="{{ asset('images/quizz-img.png') }}" alt="Image Description Quizz" width="700px">

    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-50 pt-5 text-center">
        Human Computer Interaction: Interactive Products
    </h1>
    <div class="mt-5">
        <div class="flex items-center justify-center space-x-3 mx-auto max-w-md">
            <img class="w-10 h-10 rounded-full" src="https://quizgecko.com/images/avatars/avatar-17.webp" alt="CharmingGreekArt avatar">
            <div class="font-medium text-white flex space-x-1 sm:space-x-2">
                <div>
                    <span class="hidden sm:inline">
                        Created by
                    </span>
                    CharmingGreekArt
                </div>
                <div>
                    ·
                </div>
                <div>
                    <button class="mt-0.5">
                        Make a Copy
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-12">
        <a class="text-gray-700 max-w-xl mx-auto" href="{{ route('quiz.show') }}">
            <div class="border p-3 rounded-md text-center cursor-pointer hover:border-b-yellow-400 border-b-4 bg-indigo-50 w-full">
                <svg class="w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="var(--background)">
                    <g>
                        <path d="M0,0h24v24H0V0z" fill="none"></path>
                    </g>
                    <g>
                        <path d="M4,6H2v14c0,1.1,0.9,2,2,2h14v-2H4V6z M20,2H8C6.9,2,6,2.9,6,4v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V4 C22,2.9,21.1,2,20,2z M20,16H8V4h12V16z M13.51,10.16c0.41-0.73,1.18-1.16,1.63-1.8c0.48-0.68,0.21-1.94-1.14-1.94 c-0.88,0-1.32,0.67-1.5,1.23l-1.37-0.57C11.51,5.96,12.52,5,13.99,5c1.23,0,2.08,0.56,2.51,1.26c0.37,0.6,0.58,1.73,0.01,2.57 c-0.63,0.93-1.23,1.21-1.56,1.81c-0.13,0.24-0.18,0.4-0.18,1.18h-1.52C13.26,11.41,13.19,10.74,13.51,10.16z M12.95,13.95 c0-0.59,0.47-1.04,1.05-1.04c0.59,0,1.04,0.45,1.04,1.04c0,0.58-0.44,1.05-1.04,1.05C13.42,15,12.95,14.53,12.95,13.95z"></path>
                    </g>
                </svg>
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