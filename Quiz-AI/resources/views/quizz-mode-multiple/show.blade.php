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
        <div class="dialog-fisish min-w-[600px] p-4  shadow-lgrounded-lg bg-[var(--background)]">
            <h3 class="text-[42px] font-semibold">Finished!</h3>
            <div class="bg-[var(--gray)]">
                <p class="point">Point: 0 / 0</p>
                <p class="correct">Correct: 0 / 0</p>
                <p class="incorrect">Incorrect: 0</p>
            </div>
            <div class="mt-[20px] border-t">
                <h3 class="text-center mt-4 mb-4">Score ranking</h3>
                <div>
                    <table class="w-full bxh">
                        <thead>
                            <tr>
                                <th class="text-start">Rank</th>
                                <th class="text-start">Name</th>
                                <th class="text-start">Point</th>
                            </tr>
                        </thead>
                        <tbody class="table_fished_content">

                        </tbody>
                    </table>

                    <div class="pt-4 flex items-center justify-center">
                        @if ($user_created === Auth::user()->id)
                            <button
                                class="btn_restart_room p-4 rounded- flex items-center justify-center rounded-lg bg-[var(--input-form-bg)] gap-3 ">
                                <i class="fa-regular fa-rotate-right"></i>
                                Restart
                            </button>
                        @endif
                    </div>
                </div>
            </div>
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
        <div class="relative bg-[var(--background-dark)] w-full p-2 flex items-center justify-between">
            <div class="flex items-center justify-start gap-3">
                <img src="{{ asset('images/icon-white.png') }}" alt="" class="w-[32px] h-[32px]">
                <button
                    class="ques_length p-4 rounded- flex items-center justify-center rounded-lg bg-[var(--input-form-bg)]">
                    0 / 0
                </button>
                <p class="quizz_title"></p>
            </div>
            <div class="flex items-center justify-center gap-3">
                <button
                    class="btn_zoom p-4 rounded- flex items-center justify-center rounded-lg bg-[var(--input-form-bg)] ">
                    <i class="fa-regular fa-expand"></i>
                </button>

                @if ($user_created === Auth::user()->id)
                    <button
                        class="btn_close_room p-4 rounded- flex items-center justify-center rounded-lg bg-[var(--input-form-bg)] gap-3 ">
                        <i class="fa-duotone fa-flag-checkered"></i>
                    </button>
                @endif

            </div>

            <div
                class="time_slide transition-all duration-1000 ease-linear absolute left-0 w-[0%] bottom-0 h-[4px] bg-[var(--text)]">

            </div>
        </div>
        <div class="w-full flex-1 bg-[var(--primary)]">
            <div class="ques_wrapper w-full h-full flex items-center justify-center flex-col pt-[50px]">
                <div class="flex-1 ">
                    <h3 class="question_title text-[42px] font-[500] max-w-[1024px] text-center"></h3>

                    <div class="flex items-center justify-center">
                        <img src="" class="ques_img max-h-[400px]" alt="">
                    </div>
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
        let questionIndex = 9;
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
        const quesImg = document.querySelector(".ques_img");
        const quizzTitle = document.querySelector(".quizz_title");
        const point = document.querySelector(".point");
        const correct = document.querySelector(".correct");
        const incorrect = document.querySelector(".incorrect");
        const timeSlide = document.querySelector('.time_slide');
        const tableRanking = document.querySelector('.table_fished_content');
        const btnCloseRoom = document.querySelector('.btn_close_room');
        const btnRestartRoom = document.querySelector('.btn_restart_room');
        const btnZoom = document.querySelector('.btn_zoom');
        const TIMER = 2000;
        let POINT = 0;
        let questionTimer = 30000;
        let timeCount = 0;
        let timeSlider;
        let animateQues;
        let showNextQuestionAnimate;
        let correctAnswers = true;
        let correctAnswerStr = "";

        const startInterval = () => {
            timeCount = 0;
            if (timeSlider) {
                clearInterval(timeSlider);
            }

            timeSlider = setInterval(() => {
                if (questionIndex < questions.length) {
                    timeCount++;
                    if (timeCount <= questionTimer / 1000) {
                        timeSlide.style.width = `${timeCount * 10 / 3}%`;
                        if (timeCount * 10 / 3 >= 65) {
                            timeSlide.classList.add("bg-red-500");
                        } else {
                            timeSlide.classList.remove("bg-red-500");
                        }
                        // console.log(timeCount * 10 / 3);
                    } else {
                        clearInterval(timeSlider);
                        handleCheckAnswer();
                    }
                }
            }, 1000);
        };

        // Get question of room
        const getQuestion = async () => {
            const response = await fetch(`{{ route('get_room_quizz', $room_id) }}`);
            const data = await response.json();
            quizzTitle.textContent = data.room.quiz.title;
            questions = data.room.quiz.questions;
            if (data.room.is_finish) {
                return false
            }
            return true;
        }

        const handleClickAnswer = (target, ansId, ansType) => {
            if (ansType === "radio") {
                // Choose only one answer
                userAnswers = [];
                userAnswers.push(ansId);
                // Clear active class
                document.querySelectorAll(".answer").forEach((element) => {
                    element.classList.remove("active");
                });
            } else if (ansType === "checkbox") {
                // Choose multiple answer
                if (userAnswers.includes(ansId)) {
                    userAnswers = userAnswers.filter((answer) => answer !== ansId);
                } else {
                    userAnswers.push(ansId);
                }
            }
            // Active choose answer
            target.classList.toggle("active");
        }

        const escapeHtml = (unsafe) => {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        const savePoint = async (userId, point) => {
            const response = await fetch(`{{ route('quiz.multiple.update.user.point', $room_id) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    point: point,
                    user_id: userId
                })
            });
            const data = await response.json();
            console.log(data);
            const users = data.room.room_points;
            console.log(users);
            users.forEach((user, index) => {
                const username = data.room.joined_users.find((u) => u.id === user.user_id).name;
                tableRanking.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${username}</td>
                        <td>${user.points}</td>
                    </tr>
                `;
            });
            // return data;
        }

        const roomFinished = async () => {
            // Display dialog finish
            const response = await fetch(`{{ route('quiz.multiple.users', $room_id) }}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            });
            const data = await response.json();
            const users = data.users;
            correct.style.display = "none";
            point.style.display = "none";
            incorrect.style.display = "none";
            buttonNext.style.display = "none";
            document.querySelector(".dialog-fisish").classList.add("active");
            users.forEach((user, index) => {
                user.room_points.forEach(roomPoint => {
                    if (parseInt(roomPoint.room_id) === {{ $id }}) {
                        tableRanking.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.name}</td>
                            <td>${roomPoint.points}</td>
                        </tr>
                    `;
                    }
                });
            });
        }

        getQuestion().then((result) => {
            if (!result) {
                roomFinished();
            } else {
                // Render question
                questionLength.textContent = `${questionIndex + 1} / ${questions.length}`;
                questionTitle.textContent = questions[questionIndex].excerpt;
                if (questions[questionIndex].image) {
                    quesImg.src = `{{ asset('${questions[questionIndex].image}') }}`
                }
                questions[questionIndex].answers.forEach(element => {
                    questionAnswerWrapper.innerHTML += `
                    <div class="answer bg-[var(--text)] w-full p-2 rounded-lg h-full text-[var(--background)] text-center text-[32px]" onclick="handleClickAnswer(this, ${element.id}, '${questions[questionIndex].type}')">
                        ${escapeHtml(element.content)}
                    </div>
                `;
                });
                startInterval();
            }
        }).catch((err) => {
            console.log(err);
        });

        const animationNextQues = (isChoseAnswer = true) => {
            // Animation
            if (animateQues) {
                clearTimeout(animateQues);
            }

            if (showNextQuestionAnimate) {
                clearTimeout(showNextQuestionAnimate);
            }

            // Dialog check answer
            if (isChoseAnswer) {
                animateQues = setTimeout(() => {
                    if (correctAnswers) {
                        correctAnswerStr = correctAnswerStr.slice(0, -1);
                        dialogTitle.textContent = "Correct !";
                        dialogDescription.innerHTML =
                            `Question: ${questions[questionIndex].excerpt}<br> Answer: ${escapeHtml(correctAnswerStr)}`;
                        dialogImage.src = "{{ asset('icon_imgs/tick.webp') }}";
                        quesWrapper.classList.add("active");
                        dialog.classList.add("active");
                    } else {
                        correctAnswerStr = correctAnswerStr.slice(0, -1);
                        dialogTitle.textContent = "Incorrect !";
                        dialogDescription.innerHTML =
                            `Question: ${questions[questionIndex].excerpt}<br> Answer: ${escapeHtml(correctAnswerStr)}`;
                        dialogImage.src = "{{ asset('icon_imgs/cross.webp') }}";
                        quesWrapper.classList.add("active");
                        dialog.classList.add("active");
                    }
                }, TIMER);
            } else {
                if (questionIndex <= questions.length) {
                    dialogTitle.textContent = "Time out !";
                    dialogDescription.textContent = `You must choose answer in ${questionTimer / 1000} seconds.`;
                    dialogImage.src = "{{ asset('icon_imgs/timeout.png') }}";
                    quesWrapper.classList.add("active");
                    dialog.classList.add("active");
                }
            }

            // Show next question
            showNextQuestionAnimate = setTimeout(() => {
                clearTimeout(animateQues);
                startInterval();
                dialog.classList.remove("active");
                userAnswers = [];
                correctAnswerStr = "";
                correctAnswers = true;

                // Go to next ques
                questionIndex++;
                if (questionIndex < questions.length) {
                    questionLength.textContent = `${questionIndex + 1} / ${questions.length}`;
                    questionTitle.textContent = questions[questionIndex].excerpt;
                    if (questions[questionIndex].image) {
                        quesImg.src = `{{ asset('${questions[questionIndex].image}') }}`
                    }

                    questionAnswerWrapper.innerHTML = '';
                    questions[questionIndex].answers.forEach(element => {
                        questionAnswerWrapper.innerHTML += `
                        <div class="answer bg-[var(--text)] w-full p-2 rounded-lg h-full text-[var(--background)] text-center text-[32px]" onclick="handleClickAnswer(this, ${element.id}, '${questions[questionIndex].type}')">
                            ${escapeHtml(element.content)}
                        </div>
                    `;
                    });
                    quesWrapper.classList.remove("active")
                } else {
                    // Finish quizz
                    // quesWrapper.classList.remove("active");
                    correct.textContent = `Correct: ${POINT}`;
                    point.textContent = `Point: ${POINT}`;
                    incorrect.textContent = `Incorrect: ${questions.length - POINT}`;
                    document.querySelector(".dialog-fisish").classList.add("active");
                    buttonNext.style.display = "none";
                    // Save point user into database
                    savePoint({{ Auth::user()->id }}, POINT);
                }
                buttonNext.textContent = "Next Question";
            }, TIMER + 2000)
        }

        const handleCheckAnswer = () => {
            const answerElements = document.querySelectorAll(".answer");
            // Check answer of current question
            if (userAnswers.length > 0) {
                userAnswers.forEach(uanswer => {
                    questions[questionIndex].answers.forEach((answer, index) => {
                        if (uanswer === answer.id && answer.is_correct === 1) {
                            POINT++;
                        } else if (uanswer === answer.id && answer.is_correct === 0) {
                            answerElements[index].classList.add("incorrect");
                            correctAnswers = false;
                            return;
                        }

                        if (answer.is_correct) {
                            answerElements[index].classList.add("correct");
                            correctAnswerStr += `${answer.content},`;
                        } else {
                            answerElements[index].classList.add("incorrect");
                        }
                    });
                });

                // Animation
                animationNextQues();
            } else {
                // User don't choose answer
                console.log("require choose answer");
                animationNextQues(false);
            }
        }

        buttonNext.addEventListener('click', () => {
            buttonNext.textContent = "Checking ...";
            handleCheckAnswer();
            buttonNext.textContent = "Next Question";
        });

        btnZoom.addEventListener('click', () => {
            // Full screen
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                document.documentElement.msRequestFullscreen();
            }

            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { // IE/Edge
                document.msExitFullscreen();
            }
        });

        if (btnCloseRoom) {
            btnCloseRoom.addEventListener('click', async () => {
                const response = await fetch(`{{ route('quiz.multiple.close.room', $room_id) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });
                const res = await response.json();

                if (res.status === "success") {
                    window.location.href = `{{ route('home') }}`;
                }
            });
        }

        if (btnRestartRoom) {
            btnRestartRoom.addEventListener("click", async () => {
                const response = await fetch(`{{ route('quiz.multiple.restart.room', $room_id) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });
                const res = await response.json();

                if (res.status === "success") {
                    window.location.href = `{{ route('quiz.multiple.play', $room_id) }}`;
                }
            })
        }
    </script>
@endsection
