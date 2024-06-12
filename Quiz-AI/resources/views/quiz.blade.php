@extends('layouts.app')
@section('content')
<div class="container bg-gradient-to-r from-[#282458] to-[#141816] px-[100px]">
    <h2 class="text-3xl font-bold p-10">
        Danh sách Quiz
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        @forelse($quizzes as $quiz)
        <div class="max-w-sm border rounded-lg shadow bg-gray-900 border-gray-700">
            <a href="{{ route('quiz.play', $quiz->id) }}">
                <img class="rounded-t-lg xl:h-48" src="{{asset('storage/'.$quiz->thumb)}}" alt="{{ $quiz->title }}">
            </a>
            <div class="p-3 -mt-12 flex justify-end">
                <div class="font-semibold bg-gray-800 text-white text-xs p-[0.3em] rounded-md opacity-80 dark:bg-gray-800 dark:text-white">
                    <div>{{ $quiz->questions->count() }} câu hỏi</div>
                </div>
            </div>
            <div class="p-4 flex-col flex">
                <a href="{{ route('quiz.play', $quiz->id) }}">
                    <h4 class="mb-2 text-xl font-bold tracking-tight text-gray-200">
                        {{ $quiz->title }}
                    </h4>
                </a>
                <div class="flex items-center">
                    <img class="w-7 h-7 rounded-full" src="https://quizgecko.com/images/avatars/avatar-{{ $quiz->user->id }}.webp" alt="Ảnh đại diện của {{ $quiz->user->name }}">
                    <div class="font-medium ml-2 text-sm truncate">
                        <div>{{ $quiz->user->name }}</div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center text-white text-3xl">
            Không có quiz nào.
        </div>
        @endforelse
    </div>

    <!-- Liên kết phân trang -->
    <div class="py-[100px] px-10">
    <nav class="flex justify-between">
        @if ($quizzes->previousPageUrl())
            <a href="{{ $quizzes->previousPageUrl() }}" class="border px-4 py-2 text-blue-500 rounded hover:bg-blue-500 hover:text-white">Trang trước</a>
        @else
            <span class="border px-4 py-2 text-gray-500 rounded cursor-not-allowed">Trang trước</span>
        @endif

        <div>
            Trang {{ $quizzes->currentPage() }} của {{ $quizzes->lastPage() }}
        </div>

        @if ($quizzes->nextPageUrl())
            <a href="{{ $quizzes->nextPageUrl() }}" class="border px-4 py-2 text-blue-500 rounded hover:bg-blue-500 hover:text-white">Trang tiếp</a>
        @else
            <span class="border px-4 py-2 text-gray-500 rounded cursor-not-allowed">Trang tiếp</span>
        @endif
    </nav>
</div>

</div>
@endsection

@section('script')
@endsection