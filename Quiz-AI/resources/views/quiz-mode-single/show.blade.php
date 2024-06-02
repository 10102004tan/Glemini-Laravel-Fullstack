<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="progress-bar" x-data="{ progressValue: 0 }" x-modelable="progressValue" class="fixed top-0 left-0 w-full h-1 z-50">
        <div class="h-1 bg-indigo-300" x-bind:style="`width: ${progressValue}%`" style="width: 10%"></div>
    </div>
    <div class="bg-gray-800 p-3 h-[9vh]">
        <div class="grid grid-cols-4">
            <div class="col-span-2 flex space-x-2">
                <div class="hidden lg:block">
                    <span class="rounded-xl p-2 flex items-center mr-1">
                        <a href="#">
                            <img src="{{ asset('images/icon-white.png') }}" alt="Icon" class="w-5 h-5">
                        </a>
                    </span>
                </div>
                <span x-show="!quizFinished" class="p-2 text-white  bg-gray-700 rounded-md">
                    <span class="currentQuestion">1</span>
                    /
                    <span class="questionsCount">10</span>
                </span>
                <a href="{{ route('quiz.index') }}" class="p-2 text-white rounded-md truncate max-w-sm text-xs lg:block hidden cursor-pointer mt-1 -ml-1">
                    <span class="flex">
                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                            <g>
                                <path d="M0,0h24v24H0V0z" fill="none"></path>
                            </g>
                            <g>
                                <path d="M4,6H2v14c0,1.1,0.9,2,2,2h14v-2H4V6z M20,2H8C6.9,2,6,2.9,6,4v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V4 C22,2.9,21.1,2,20,2z M20,16H8V4h12V16z M13.51,10.16c0.41-0.73,1.18-1.16,1.63-1.8c0.48-0.68,0.21-1.94-1.14-1.94 c-0.88,0-1.32,0.67-1.5,1.23l-1.37-0.57C11.51,5.96,12.52,5,13.99,5c1.23,0,2.08,0.56,2.51,1.26c0.37,0.6,0.58,1.73,0.01,2.57 c-0.63,0.93-1.23,1.21-1.56,1.81c-0.13,0.24-0.18,0.4-0.18,1.18h-1.52C13.26,11.41,13.19,10.74,13.51,10.16z M12.95,13.95 c0-0.59,0.47-1.04,1.05-1.04c0.59,0,1.04,0.45,1.04,1.04c0,0.58-0.44,1.05-1.04,1.05C13.42,15,12.95,14.53,12.95,13.95z"></path>
                            </g>
                        </svg> Human Computer Interaction: Interactive Products
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-gray-600 p-4 h-[80vh] flex flex-col">
        <div class=" h-[30%] text-center text-4xl text-white font-semibold">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse maiores amet hic alias earum eos est voluptate consectetur
        </div>
        <div class="flex flex-col h-full">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-2 h-full md:mt-12 lg:mt-28 xl:mt-48">
                <template x-for="(answer, index) in question?.answers ?? []" :key="answer?id">
                    <div x-tooltip="`Press ${index + 1}`" x-tooltip-evaluate="" class="p-1 sm:p-2 flex-grow rounded-lg cursor-pointer text-center flex items-center justify-center z-40" :class="{
                                                    'bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600': !questionAnswered,
                                                
                                                    // Applied when an incorrect answer is selected. Changes border and background color to red.
                                                    ' bg-red-500 border-red-500 text-white ': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId == answer.id,
                                                
                                                    // Applied when the correct answer is selected. Changes border and background color to green.
                                                    'border-white bg-green-400 text-white': answeredCorrectly == true &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer has been selected. Changes border and background color to gray.
                                                    'border-gray-200 bg-gray-50 text-gray-800': answeredQuestionId &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer check is loading or the question has been answered. Changes cursor to not-allowed.
                                                    'cursor-not-allowed ': loadingAnswerCheck || questionAnswered,
                                                
                                                    // Applied when the wrong answer is selected. The correct answer will have a green border and a pulse animation.
                                                    'border-green-100 bg-green-500 text-white animate__animated animate__fast animate__pulse': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId != answer.id &amp;&amp; answer.id ==
                                                        answerResponse?.correct_answer_id,
                                                
                                                    // Applied to the unselected and incorrect answers when a question is answered. These answers will have a fade-out animation.
                                                    'animate__animated animate__fast animate__fadeOut animate__faster': questionAnswered &amp;&amp;
                                                        !(answeredQuestionId == answer.id || answer.id == answerResponse
                                                            ?.correct_answer_id),
                                                
                                                }" @click="answerQuestion(answer.id)">
                        <p class="text-lg md:text-2xl font-semibold leading-7 drop-shadow-sm quiz-markdown" x-html="$markdown(answer.text)"></p>
                    </div>
                </template>
                <div x-tooltip="`Press ${index + 1}`" x-tooltip-evaluate="" class="p-1 sm:p-2 flex-grow rounded-lg cursor-pointer text-center flex items-center justify-center z-40 bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" :class="{
                                                    'bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600': !questionAnswered,
                                                
                                                    // Applied when an incorrect answer is selected. Changes border and background color to red.
                                                    ' bg-red-500 border-red-500 text-white ': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId == answer.id,
                                                
                                                    // Applied when the correct answer is selected. Changes border and background color to green.
                                                    'border-white bg-green-400 text-white': answeredCorrectly == true &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer has been selected. Changes border and background color to gray.
                                                    'border-gray-200 bg-gray-50 text-gray-800': answeredQuestionId &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer check is loading or the question has been answered. Changes cursor to not-allowed.
                                                    'cursor-not-allowed ': loadingAnswerCheck || questionAnswered,
                                                
                                                    // Applied when the wrong answer is selected. The correct answer will have a green border and a pulse animation.
                                                    'border-green-100 bg-green-500 text-white animate__animated animate__fast animate__pulse': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId != answer.id &amp;&amp; answer.id ==
                                                        answerResponse?.correct_answer_id,
                                                
                                                    // Applied to the unselected and incorrect answers when a question is answered. These answers will have a fade-out animation.
                                                    'animate__animated animate__fast animate__fadeOut animate__faster': questionAnswered &amp;&amp;
                                                        !(answeredQuestionId == answer.id || answer.id == answerResponse
                                                            ?.correct_answer_id),
                                                
                                                }" @click="answerQuestion(answer.id)">
                    <p class="text-lg md:text-2xl font-semibold leading-7 drop-shadow-sm quiz-markdown" x-html="$markdown(answer.text)">
                    <p>Maintaining stock rotation</p>
                    </p>
                </div>
                <div x-tooltip="`Press ${index + 1}`" x-tooltip-evaluate="" class="p-1 sm:p-2 flex-grow rounded-lg cursor-pointer text-center flex items-center justify-center z-40 bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" :class="{
                                                    'bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600': !questionAnswered,
                                                
                                                    // Applied when an incorrect answer is selected. Changes border and background color to red.
                                                    ' bg-red-500 border-red-500 text-white ': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId == answer.id,
                                                
                                                    // Applied when the correct answer is selected. Changes border and background color to green.
                                                    'border-white bg-green-400 text-white': answeredCorrectly == true &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer has been selected. Changes border and background color to gray.
                                                    'border-gray-200 bg-gray-50 text-gray-800': answeredQuestionId &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer check is loading or the question has been answered. Changes cursor to not-allowed.
                                                    'cursor-not-allowed ': loadingAnswerCheck || questionAnswered,
                                                
                                                    // Applied when the wrong answer is selected. The correct answer will have a green border and a pulse animation.
                                                    'border-green-100 bg-green-500 text-white animate__animated animate__fast animate__pulse': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId != answer.id &amp;&amp; answer.id ==
                                                        answerResponse?.correct_answer_id,
                                                
                                                    // Applied to the unselected and incorrect answers when a question is answered. These answers will have a fade-out animation.
                                                    'animate__animated animate__fast animate__fadeOut animate__faster': questionAnswered &amp;&amp;
                                                        !(answeredQuestionId == answer.id || answer.id == answerResponse
                                                            ?.correct_answer_id),
                                                
                                                }" @click="answerQuestion(answer.id)">
                    <p class="text-lg md:text-2xl font-semibold leading-7 drop-shadow-sm quiz-markdown" x-html="$markdown(answer.text)">
                    <p>Reducing storage space</p>
                    </p>
                </div>
                <div x-tooltip="`Press ${index + 1}`" x-tooltip-evaluate="" class="p-1 sm:p-2 flex-grow rounded-lg cursor-pointer text-center flex items-center justify-center z-40 bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" :class="{
                                                    'bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600': !questionAnswered,
                                                
                                                    // Applied when an incorrect answer is selected. Changes border and background color to red.
                                                    ' bg-red-500 border-red-500 text-white ': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId == answer.id,
                                                
                                                    // Applied when the correct answer is selected. Changes border and background color to green.
                                                    'border-white bg-green-400 text-white': answeredCorrectly == true &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer has been selected. Changes border and background color to gray.
                                                    'border-gray-200 bg-gray-50 text-gray-800': answeredQuestionId &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer check is loading or the question has been answered. Changes cursor to not-allowed.
                                                    'cursor-not-allowed ': loadingAnswerCheck || questionAnswered,
                                                
                                                    // Applied when the wrong answer is selected. The correct answer will have a green border and a pulse animation.
                                                    'border-green-100 bg-green-500 text-white animate__animated animate__fast animate__pulse': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId != answer.id &amp;&amp; answer.id ==
                                                        answerResponse?.correct_answer_id,
                                                
                                                    // Applied to the unselected and incorrect answers when a question is answered. These answers will have a fade-out animation.
                                                    'animate__animated animate__fast animate__fadeOut animate__faster': questionAnswered &amp;&amp;
                                                        !(answeredQuestionId == answer.id || answer.id == answerResponse
                                                            ?.correct_answer_id),
                                                
                                                }" @click="answerQuestion(answer.id)">
                    <p class="text-lg md:text-2xl font-semibold leading-7 drop-shadow-sm quiz-markdown" x-html="$markdown(answer.text)">
                    <p>Enhancing stock security</p>
                    </p>
                </div>
                <div x-tooltip="`Press ${index + 1}`" x-tooltip-evaluate="" class="p-1 sm:p-2 flex-grow rounded-lg cursor-pointer text-center flex items-center justify-center z-40 bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" :class="{
                                                    'bg-white border-4 border-gray-200 shadow text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600': !questionAnswered,
                                                
                                                    // Applied when an incorrect answer is selected. Changes border and background color to red.
                                                    ' bg-red-500 border-red-500 text-white ': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId == answer.id,
                                                
                                                    // Applied when the correct answer is selected. Changes border and background color to green.
                                                    'border-white bg-green-400 text-white': answeredCorrectly == true &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer has been selected. Changes border and background color to gray.
                                                    'border-gray-200 bg-gray-50 text-gray-800': answeredQuestionId &amp;&amp;
                                                        answeredQuestionId == answer.id,
                                                
                                                    // Applied when an answer check is loading or the question has been answered. Changes cursor to not-allowed.
                                                    'cursor-not-allowed ': loadingAnswerCheck || questionAnswered,
                                                
                                                    // Applied when the wrong answer is selected. The correct answer will have a green border and a pulse animation.
                                                    'border-green-100 bg-green-500 text-white animate__animated animate__fast animate__pulse': answeredCorrectly ==
                                                        false &amp;&amp; answeredQuestionId != answer.id &amp;&amp; answer.id ==
                                                        answerResponse?.correct_answer_id,
                                                
                                                    // Applied to the unselected and incorrect answers when a question is answered. These answers will have a fade-out animation.
                                                    'animate__animated animate__fast animate__fadeOut animate__faster': questionAnswered &amp;&amp;
                                                        !(answeredQuestionId == answer.id || answer.id == answerResponse
                                                            ?.correct_answer_id),
                                                
                                                }" @click="answerQuestion(answer.id)">
                    <p class="text-lg md:text-2xl font-semibold leading-7 drop-shadow-sm quiz-markdown" x-html="$markdown(answer.text)">
                    <p>Improving product visibility</p>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-800 p-2 h-[11vh] flex">

    </div>
</body>

</html>