@extends('layouts.app')
@section('content')
<div class="container bg-gradient-to-r from-[#282458] to-[#141816] px-[100px]">
        <h2 class="text-3xl font-bold p-10">
            Quizzes List
        </h2>
        <div class="grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 grid gap-4" x-data="">
        @foreach($quizzes as $quiz)
        <div class="max-w-sm border rounded-lg shadow bg-gray-900 border-gray-700">
                <a href="{{ route('quiz.play', $quiz->id) }}">
                    <img class= "rounded-t-lg xl:h-48" src="#" alt="Radiography Developer Process">
                </a>
                <div class="p-3 -mt-12 flex justify-end">
                    <div class="font-semibold bg-gray-800 text-white text-xs p-[0.3em] rounded-md opacity-80 dark:bg-gray-800 dark:text-white">
                        <div>{{ $quiz->questions->count() }} questions</div>
                    </div>
                </div>
                <div class="p-4 flex-col flex ">
                    <a href="{{ route('quiz.play', $quiz->id) }}">
                        <h4 class="mb-2 text-xl font-bold tracking-tight text-gray-200">
                            {{$quiz->title}}
                        </h4>
                    </a>
                    <div class="flex user-holder">
                        <img class="w-7 h-7 rounded-full" src="https://quizgecko.com/images/avatars/avatar-{{$quiz->user->id}}.webp" alt="DecentFluorite avatar">
                        <div class="font-medium ml-2 text-sm flex items-center truncate">
                            <div>{{$quiz->user->name}}</div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
            
    
</div>
@endsection
@section('script')
@endsection