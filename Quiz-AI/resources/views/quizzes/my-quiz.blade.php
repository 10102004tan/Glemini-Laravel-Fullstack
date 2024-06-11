@extends('layouts.app')
@section('title', 'My | Gemini Quiz')
@section('content')
<div class="container bg-gradient-to-r from-[#282458] to-[#141816] py-[80px]">
    <div class="nav mb-5 text-[16px]">
        <ul class="flex gap-4">
            <li class="bg-slate-500 rounded py-1 px-3 cursor-pointer">Profile</li>
            <li class="bg-yellow-500 rounded py-1 px-3 cursor-pointer">My quiz</li>
            <li class="bg-yellow-500 rounded py-1 px-3 cursor-pointer"><a href="{{ route('quiz.multiple.create') }}">My Room</a></li>
            <li class="bg-slate-500 rounded py-1 px-3 cursor-pointer">Setting</li>
        </ul>
    </div>
    <hr class="py-5">
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-2">
            <livewire:filter-quiz />
        </div>
        <div class="col-span-10 flex flex-col gap-3">
            <livewire:list-quizzes :quizzes="$quizzes" />
            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-sm">
                    @for ($i = 1; $i <= $total; $i++)
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{$i}}</a>
                    </li>
                    @endfor
                </ul>
            </nav>
        </div>
    </div>


</div>
@endsection
@section('script')
<script>
</script>
@endsection