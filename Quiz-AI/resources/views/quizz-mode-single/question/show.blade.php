@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center bg-gray-700 w-full p-10">
    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-50 pt-5 text-center">
        Câu hỏi {{ $questionIndex + 1 }} / {{ 10 }}
    </h1>
    <p class="text-xl text-gray-50 text-center mt-5">{{ $question->excerpt }}</p>
    <form method="POST" action="{{ route('quiz.question.submit', ['id' => $quiz->id, 'questionIndex' => $currentQuestionIndex]) }}">
        @csrf
        <!-- Hiển thị các lựa chọn đáp án ở đây -->
        <div class="mt-12">
            @foreach($question->answers as $answer)
                <div>
                    <label>
                        <input type="{{ $question->type === 'radio' ? 'radio' : 'checkbox' }}" name="answer[]" value="{{ $answer->id }}">
                        {{ $answer->content }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="mt-12">
            <button type="submit" class="text-gray-700 max-w-xl mx-auto">
                <div class="border p-3 rounded-md text-center cursor-pointer hover:border-b-yellow-400 border-b-4 bg-indigo-50 w-full">
                    <div class="text-md font-semibold mt-2 text-[var(--background)]">
                        Gửi câu trả lời
                    </div>
                </div>
            </button>
        </div>
    </form>
</div>
@endsection
