@extends('layouts.app')
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
        <div class="col-span-10">
           <livewire:list-quizzes :quizzes="$quizzes" />
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
</script>
@endsection