@extends('layouts.app')
@section('content')
<div class="container pt-[80px]">
    <div class="grid grid-cols-5 gap-4">
        @foreach ($quizzes as $quiz) 
        <div class="rounded overflow-hidden shadow-lg bg-white w-[100%]">
            <img class="w-full h-[200px] object-cover" src="https://www.catster.com/wp-content/uploads/2023/11/Cat-in-Japan-Pabkov-Shutterstock.jpg" alt="Sunset in the mountains">
            <div class="px-3 py-2">
                <div class="font-bold text-xl mb-2 text-black">{{$quiz->title}}</div>
            </div>
            <div class="px-6 pt-4 pb-2 flex flex-wrap">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#question:{{$quiz->questions->count()}}</span>
                @if ($quiz->status == 0 )
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status: Nháp</span>
                @elseif($quiz->status == 1)
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status: Công khai</span>
                @elseif($quiz->status == 2)
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status:Đang đợi duyệt</span>
                @else
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#status:Bị từ chối</span>
                @endif
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection
@section('script')
<script>
</script>
@endsection