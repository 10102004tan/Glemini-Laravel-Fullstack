<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $quiz->title }}</title>
    @vite('resources/css/app.css')
    <style>
        .selected {
            border-color: #25CCF7;
            background-color: #25CCF7;
        }

        .correct {
            border-color: #4caf50;
            background-color: #4caf50;
        }

        .incorrect {
            border-color: #e55039;
            background-color: #e55039;
        }
    </style>
</head>

<body>
    <!-- Thanh tiến trình -->
    <div class="container bg-gradient-to-r from-[#282458] to-[#141816] px-[100px]">
    <div id="progress-bar" class="fixed top-0 left-0 w-full h-1 z-50">
        <div class="h-1 bg-indigo-300" style="width: {{ ($questionIndex / $totalQuestions) * 100 }}%"></div>
    </div>

    <!-- Thanh trên cùng -->
    <div class=" p-3 h-[9vh]">
        <div class="grid grid-cols-4">
            <div class="col-span-2 flex space-x-2">
                <div class="hidden lg:block">
                    <span class="rounded-xl p-2 flex items-center mr-1">
                        <img src="{{ asset('images/icon-white.png') }}" alt="Icon" class="w-5 h-5">
                    </span>
                </div>
                <span class="p-2 text-white bg-gray-700 rounded-md">
                    <span class="currentQuestion">{{ $questionIndex }}</span> / <span class="questionsCount">{{ $totalQuestions }}</span>
                </span>
                <a href="{{ route('quiz.play', $quiz->id) }}" class="p-2 text-white rounded-md truncate max-w-sm text-xs lg:block hidden cursor-pointer mt-1 -ml-1">
                    <span class="flex">
                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                            <g>
                                <path d="M0,0h24v24H0V0z" fill="none"></path>
                            </g>
                            <g>
                                <path d="M4,6H2v14c0,1.1,0.9,2,2,2h14v-2H4V6z M20,2H8C6.9,2,6,2.9,6,4v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V4 C22,2.9,21.1,2,20,2z M20,16H8V4h12V16z M13.51,10.16c0.41-0.73,1.18-1.16,1.63-1.8c0.48-0.68,0.21-1.94-1.14-1.94 c-0.88,0-1.32,0.67-1.5,1.23l-1.37-0.57C11.51,5.96,12.52,5,13.99,5c1.23,0,2.08,0.56,2.51,1.26c0.37,0.6,0.58,1.73,0.01,2.57 c-0.63,0.93-1.23,1.21-1.56,1.81c-0.13,0.24-0.18,0.4-0.18,1.18h-1.52C13.26,11.41,13.19,10.74,13.51,10.16z M12.95,13.95 c0-0.59,0.47-1.04,1.05-1.04c0.59,0,1.04,0.45,1.04,1.04c0,0.58-0.44,1.05-1.04,1.05C13.42,15,12.95,14.53,12.95,13.95z"></path>
                            </g>
                        </svg> {{$quiz->title}}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Câu hỏi và đáp án -->
    <div class="w-full p-4 ">
        <div class="h-[50%] text-center text-4xl text-white font-semibold mb-4">
            <!-- Câu hỏi -->
            <span>{{ $question->excerpt }}</span>

            <!-- Hình ảnh -->
            <div class="h-[400px] w-full  flex items-center justify-center">
                @if($question->image)
                    <img src="{{ asset($question->image) }}" alt="Question Image" class="h-full w-full object-contain" />
                @endif
            </div>


        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach($question->answers as $index => $answer)
            <div class="p-4 rounded-lg border-2 border-gray-200 text-gray-900 bg-gray-600 hover:bg-gray-500 cursor-pointer" onclick="selectAnswer(this, '{{ $answer->id }}')" data-answer-id="{{ $answer->id }}">
                <span>{{ chr(65 + $index) }}. {{ $answer->content }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Thanh dưới cùng -->
    <div class=" p-2 h-[11vh] flex justify-center items-center">
        <div id="notification" class="hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert"></div>
        <button id="confirm-btn" class="bg-blue-500 text-white p-2 rounded" onclick="confirmAnswer()" data-url="{{ route('checkAnswer', [$quiz->id, $questionIndex]) }}" disabled>Xác nhận</button>
    </div>
    </div>
    <script>
        var questionType = '{{ $question->type }}';
        // console.log(questionType);
    </script>
    <script src="{{ asset('js/quizz.js') }}"></script>
</body>

</html>