@extends('layouts.link_script')

{{-- Body --}}
@section('content')
    <div class="w-full h-[100vh] flex flex-col bg-[var(--background)]">
        {{-- Dialog --}}
        <div
            class="dialog fixed top-[50%] left-[50%] transform translate-x-[-50%] translate-y-[-50%] p-[40px]  rounded-lg bg-[var(--background)]">
            <img src="{{ asset('icon_imgs/tick.webp') }}" alt=""
                class="dialog-image max-w-[112px] max-h-[112px] mx-auto">
            <p class="text-white dialog-title font-light mb-[20px] mt-[40px]">Correct !</p>
            <p class="text-white dialog-description font-light">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Repellat et architecto tenetur dignissimos vel aperiam officia alias exercitationem perspiciatis quibusdam
                reprehenderit minus dolores id asperiores error iste accusantium, nisi dicta?</p>
        </div>
        {{-- Dialog Finish --}}
        <div class="dialog-fisish p-4 rounded-lg bg-[var(--background)]">
          <h3>Finished!</h3>
          <div class="bg-[var(--gray)]"></div>
        </div>
        {{-- Error notify --}}
        @if ($errors->any())
            <div class="mb-2 form_error_notify bg-white rounded-lg overflow-hidden">
                <span class="block w-full p-4 bg-red-500 text-white">Error</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 p-2">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Success notify --}}
        @if (session('success'))
            <div class="form_success_notify">
                <div class="mb-2 form_error_notify bg-white rounded-lg overflow-hidden">
                    <span class="block w-full p-4 bg-green-500 text-white">Success</span>
                    <ul>
                        <li class="text-green-500 p-4">{{ session('success') }}</li>
                    </ul>
                </div>
            </div>
        @endif
        {{-- Header --}}
        <div class="bg-[var(--background-dark)] w-full p-2 flex items-center justify-between">
            <div class="flex items-center justify-start gap-3">
                <img src="{{ asset('images/icon-white.png') }}" alt="" class="w-[32px] h-[32px]">
                <button
                    class="ques_length p-4 rounded- flex items-center justify-center rounded-lg bg-[var(--input-form-bg)]">
                    0 / 0
                </button>
                <p>Back End và Front End Development</p>
            </div>
            <div>
                <button class="p-4 rounded- flex items-center justify-center rounded-lg bg-[var(--input-form-bg)]">
                    <i class="fa-regular fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="w-full flex-1 bg-[var(--primary)]">
            <div class="ques_wrapper w-full h-full flex items-center justify-center flex-col pt-[50px]">
                <div class="flex-1 ">
                    <h3 class="question_title text-[42px] font-[500] max-w-[1024px] text-center">Ngôn ngữ lập trình nào được
                        sử dụng cho phát triển front-end?</h3>
                </div>

                <div class="grid ans_wrapper select-none cursor-pointer grid-cols-2 gap-4 w-full px-[200px] py-[60px]">
                </div>
            </div>
        </div>
        <div class="w-full bg-[var(--background)] p-4 text-right">
            <button class="bg-[var(--primary)] btn_next text-white p-4 rounded-lg">
                Next Question
            </button>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script>
        let questionIndex = 0;
        let questions = [];
        let userAnswers = [];
        const questionTitle = document.querySelector('.question_title');
        const questionAnswerWrapper = document.querySelector('.ans_wrapper');
        const buttonNext = document.querySelector(".btn_next");
        const questionLength = document.querySelector(".ques_length");
        const dialog = document.querySelector(".dialog");
        const dialogTitle = document.querySelector(".dialog-title");
        const dialogDescription = document.querySelector(".dialog-description");
        const dialogImage = document.querySelector(".dialog-image");
        const quesWrapper = document.querySelector(".ques_wrapper");
        const TIMER = 2000;


        // Get question of room
        const getQuestion = async () => {
            const response = await fetch(`{{ route('get_room_quizz', $room_id) }}`);
            const data = await response.json();
            questions = data.room.quiz.questions;
            return data;
        }

        const handleClickAnswer = (target, ansId) => {
            target.classList.toggle("active");
            userAnswers.push(ansId);
        }

        const escapeHtml = (unsafe) => {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        getQuestion().then((result) => {
            // Render question
            questionLength.textContent = `${questionIndex + 1} / ${questions.length}`;
            questionTitle.textContent = questions[questionIndex].excerpt;
            questions[questionIndex].answers.forEach(element => {
                questionAnswerWrapper.innerHTML += `
                    <div class="answer bg-[var(--text)] w-full p-2 rounded-lg h-full text-[var(--background)] text-center text-[32px]" onclick="handleClickAnswer(this, ${element.id})">
                        ${escapeHtml(element.content)}
                    </div>
                `;
            });
        }).catch((err) => {
            console.log(err);
        });

        buttonNext.addEventListener('click', () => {
            const answerElements = document.querySelectorAll(".answer");
            // Check answer of current question
            let point = 0;
            let correctAnswers = true;
            let correctAnswerStr = "";
            userAnswers.forEach(uanswer => {
                questions[questionIndex].answers.forEach((answer, index) => {
                    if (uanswer === answer.id && answer.is_correct) {
                        point++;
                    } else if (uanswer === answer.id && !answer.is_correct) {
                        answerElements[index].classList.add("incorrect");
                        correctAnswers = false;
                        return;
                    }

                    if (answer.is_correct) {
                        answerElements[index].classList.add("correct");
                        correctAnswerStr += `${answer.content}, `;
                    } else {
                        answerElements[index].classList.add("incorrect");
                    }
                });
            });

            // Animation
            const animate = setTimeout(() => {
                if (correctAnswers) {
                    correctAnswerStr = correctAnswerStr.slice(0, -2);
                    dialogTitle.textContent = "Correct !";
                    dialogDescription.innerHTML =
                        `Question: ${questions[questionIndex].excerpt}<br> Answer: ${escapeHtml(correctAnswerStr)}`;
                    dialogImage.src = "{{ asset('icon_imgs/tick.webp') }}";
                    quesWrapper.classList.add("active");
                    dialog.classList.add("active");
                } else {
                    dialogTitle.textContent = "Incorrect !";
                    dialogDescription.textContent =
                        `${questions[questionIndex].excerpt}: ${correctAnswerStr}`;
                    dialogImage.src = "{{ asset('icon_imgs/cross.webp') }}";
                    quesWrapper.classList.add("active");
                    dialog.classList.add("active");
                }
            }, TIMER);


            const handleShowNextQuestion = setTimeout(() => {
                clearTimeout(animate);
                dialog.classList.remove("active");
                userAnswers = [];
                correctAnswerStr = "";
                correctAnswers = true;
                // Go to next question
                questionIndex++;
                if (questionIndex < questions.length) {
                    questionLength.textContent = `${questionIndex + 1} / ${questions.length}`;
                    questionTitle.textContent = questions[questionIndex].excerpt;
                    questionAnswerWrapper.innerHTML = '';
                    questions[questionIndex].answers.forEach(element => {
                        questionAnswerWrapper.innerHTML += `
                        <div class="answer bg-[var(--text)] w-full p-2 rounded-lg h-full text-[var(--background)] text-center text-[32px]" onclick="handleClickAnswer(this, ${element.id})">
                            ${escapeHtml(element.content)}
                        </div>
                    `;
                    });
                  quesWrapper.classList.remove("active")
                } else {

                }
            }, TIMER + 2000)
        });
    </script>
@endsection
