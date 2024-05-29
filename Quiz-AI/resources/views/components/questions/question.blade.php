<div>
    <div class="card">
        <form id="submitQuestion" class="max-w-md mx-auto p-4 bg-white rounded shadow-md" data-quiz-id="{{ $quiz->id }}" data-question-id="{{ $question->id }}">
            <div id="questionContent" class="mb-4">
                {!! $question->excerpt !!} {{-- Hiển thị nội dung câu hỏi --}}
            </div>
            <div id="answerOptions" class="mb-4">
                <!-- Kiem tra truong hop la radio -->
                @if ($question->type === 'radio')
                @foreach ($question->answers as $answer)
                <div>
                    <input type="radio" name="answer" value="{{ $answer->id }}" id="answer_{{ $answer->id }}">
                    <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
                </div>
                @endforeach
                @elseif ($question->type === 'checkbox')
                @foreach ($question->answers as $answer)
                <div>
                    <input type="checkbox" name="answer[]" value="{{ $answer->id }}" id="answer_{{ $answer->id }}">
                    <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
                </div>
                @endforeach
                @elseif ($question->type === 'text')
                <textarea name="answer" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3"></textarea>
                @endif
            </div>

            
        </form>
    </div>
</div>