@extends('layouts.app')
@section('content')
    <div class="container px-[100px]">
        <div class="banner py-[50px] grid grid-cols-12 gap-4">
           <div class="col-span-6 flex gap-4 flex-col" >
           <h1 class="text-white text-[50px]">Study better with the help of AI</h1>
            <p>Automatically generate online quizzes, tests, and exams to level up your learning.</p>
            <span class="text-[12px]">Loved by 2000+ customers.</span>
            <div class="flex starts gap-1">
                @for ($i = 0; $i < 5; $i++)
            <i class="fa-solid fa-star text-[12px] text-yellow-300"></i>
                @endfor
            </div>

            <div class="flex gap-2">
                <button class="px-3 py-2 rounded bg-blue-500 hover:brightness-110">Create a Quiz</button>
                <button class="px-3 py-2 rounded bg-slate-500 hover:brightness-110">My Quiz</button>
            </div>
           </div>
           <div class="gemini-logo col-span-6">
           </div>
        </div>
    </div>
@endsection
@section('script')
@endsection