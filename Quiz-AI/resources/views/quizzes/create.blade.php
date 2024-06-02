@extends('layouts.app')
@section('content')
<div class="shadow-bar sticky top-0 left-0 right-0 bg-primary z-[9999]">
    <div class="container">
        <div>
            @isset($quiz)
            <h2 class="inline-block py-5 font-[500] text-white">{{$quiz->title}}</h2>
            <button type="button" class="btn-edit-quiz"><i class="fa-light fa-pen-to-square"></i></button>
            <!-- edit -->
            <div class="bg-overlay fixed z-[999] w-[100vw] h-[100vh] top-0 invisible opacity-0 left-0  modal-edit-quiz">
                <form class="py-4 px-5 border-[1px] border-gray-200 rounded-[10px] center w-[60%] bg-primary modal-update-quiz">
                    <div class="flex justify-between items-center">
                        <h2 class="text-[26px]">Edit Title and Description</h2>
                        <button type="button" class="btn-close-modal-edit-quiz"><i class="fa-light fa-xmark"></i></button>
                    </div>
                    <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                    <x-inputs.input class="input-quiz-title" title="Title" placeholder="Enter title" name="title" row="1">{{$quiz->title}}</x-inputs.input>
                    <x-inputs.input class="input-quiz-description" title="Description" placeholder="Enter description" row="3" name="description">{{$quiz->description}}</x-inputs.input>
                    <div class="mt-[80px] flex justify-end items-center gap-3">
                        <x-buttons.secondary>View</x-buttons.secondary>
                        <x-buttons.primary class="btn-update-quiz">Update</x-buttons.primary>
                    </div>
                </form>
            </div>
            @else
            <h2 class="inline-block py-5 font-[500] text-white">Add Questions</h2>
            @endisset
        </div>
    </div>
</div>
<!-- main -->
<section>
    <div class="grid grid-cols-12">
        <div class="px-[2rem] py-4 create bg-primary relative col-span-4">
            <div class="flex gap-4 border-b-[1px] border-gray-400">
                <button type="button" option-data="0" class="active py-3 border-b-[2px] border-transparent active:border-blue-700 active:text-blue-700 hover:border-slate-500 hover:text-slate-500 text-white show-option">Text</button>
                <button type="button" option-data="1" class="py-3 border-b-[2px] border-transparent hover:border-slate-500 hover:text-slate-500 text-white show-option">Manual</button>
            </div>

            <form method="post" id="modal-show-option-text" action="{{route('quizzes.storeWithAI')}}" class="modal-show-option-text">
                @csrf
                @isset($quiz)
                <input type="hidden" name="quiz_id" value="{{$quiz['id']}}">
                @endisset
                <div class="create-box mt-4 px-4 py-5 bg-primary ">
                    <x-inputs.input title="Enter Your Text " placeholder="Enter title" name="content" row="10"></x-inputs.input>
                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <label for="" class="flex flex-col items-start">
                            <span class="text-white mb-2 block">Question type</span>
                            <select name="type" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="checkbox">Multiple Choice</option>
                                <option value="radio">One Choice</option>
                                <option value="true/false">True/False</option>
                                <option value="short answer">Short Answer</option>
                            </select>
                        </label>

                        <label for="" class="flex flex-col items-start">
                            <span class="text-white mb-2 block">Language</span>
                            <select name="language" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="english">English</option>
                                <option value="vietnamese">Vietnam</option>
                                <option value="japanese">Japanese</option>
                            </select>
                        </label>

                        <label for="" class="flex flex-col items-start">
                            <span class="text-white mb-2 block">Difficulty</span>
                            <select name="difficulty" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select>
                        </label>

                        <label for="" class="flex flex-col items-start">
                            <span class="text-white mb-2 block">Max Questions</span>
                            <select name="size_questions" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </label>
                    </div>
                    <button class="w-[100%] py-3 rounded-[10px] text-white font-[500] bg-blue-600 btn-generate-ai">Generate</button>
                </div>

            </form>
            <div class="modal-show-option-manual hidden">
                <label for="" class="flex flex-col items-start">
                    <span class="text-white mb-2 block">Question type</span>
                    <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 select-option-manual-question">
                        <option value="0">One chocie</option>
                        <option value="1">Multiple Choice</option>
                        <option value="2">True/False</option>
                    </select>
                </label>

                <label for="" class="mb-3">
                    <span class="text-white block mb-2">Enter Your Text </span>
                    <textarea rows="5" class="p-3 w-[100%] outline-none border-2 border-blue-500 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                </label>

                <!--4 answer use textarea -->
                <div>
                    <label for="" class="mb-3">
                        <span class="text-white block mb-2">Answer 1</span>
                        <textarea rows="1" class="p-3 w-[100%] outline-none border-[1px] border-gray-400 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                    <label for="" class="mb-3">
                        <span class="text-white block mb-2">Answer 2</span>
                        <textarea rows="1" class="p-3 w-[100%] outline-none border-2 border-gray-400 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                    <label for="" class="mb-3">
                        <span class="text-white block mb-2">Answer 3</span>
                        <textarea rows="1" class="p-3 w-[100%] outline-none border-2 border-gray-400 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                    <label for="" class="mb-3">
                        <span class="text-white block mb-2">Answer 4</span>
                        <textarea rows="1" class="p-3 w-[100%] outline-none border-2 border-gray-400 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                </div>

                <!-- correct choice -->
                <label for="" class="flex flex-col items-start mb-3">
                    <span class="text-white mb-2 block">Correct Answer</span>
                    <select class="bg-primary
                    p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%] select-option-manual-correct">
                        <option value="1">Please select</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                    </select>
                </label>

                <!-- Answer Info (optional) -->
                <div class="mb-3">
                    <label for="">
                        <span class="text-white
                    block mb-2">Answer Info (optional)</span>
                        <textarea rows="5" class="p-3 w-[100%] outline-none border-2 border-gray-400 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                    <p class="text-white text-[14px]">This will be shown to the user after they answer the question.</p>
                </div>

                <button class="w-[100%] py-3 rounded-[10px] text-white font-[500] bg-gray-400 mb-3">Add question</button>
                <button class="w-[100%] py-3 rounded-[10px] border-[1px] border-gray-200 text-white font-[500] bg-transparent hover:bg-gray-400 mb-3 btn-reset-form">Reset</button>

                <!-- notification Info -->
                <div class="px-4 py-2 rounded-[5px] flex bg-blue-500 items-start gap-3">
                    <i class="fa-light fa-circle-info"></i>
                    <p class="text-[13px] text-blue-200">Add additional questions to your quiz by submitting the form again. Feel free to adjust the question type and content, or add individual questions manually.</p>
                    <button class="w-[100px] h-[30px] flex items-center justify-center rounded hover:bg-blue-600"><i class="fa-light fa-xmark"></i></button>
                </div>
            </div>
        </div>
        <div class="result col-span-8 py-4 px-5 bg-secondary relative">
            @isset($quiz)
            <div class=" result-questions">
                <div class="intro-binding flex justify-between p-3 mb-5 rounded bg-blue-500">
                    <div class="pb-[30px]">
                        <h5 class="mb-2 text-[24px]">Study better</h5>
                        <p>Unlimited quizzes, unlimited questions. Upload long files, scan your notes and more</p>
                    </div>
                    <span class="font-bold text-[18px] mt-auto">View Deal</span>
                </div>

                <!-- thumb -->
                <div class="thumb overflow-hidden mb-5">
                    <img class="w-[100%] rounded-[10px] object-cover h-[300px]" src="https://www.cshl.edu/wp-content/uploads/2023/01/cute_robot_reading_book.jpg" alt="">
                </div>

                <!-- bar -->
                <div class="bar mb-5">
                    <div class="flex gap-3">
                        <button class="bg-blue-500 text-white p-2 rounded-[5px]">Questions</button>
                        <button class="bg-red-500 text-white p-2 rounded-[5px]">Study Notes</button>
                    </div>
                </div>

                <!-- options -->
                <div class="flex justify-end mb-5">
                    <div class="flex gap-3">
                        <x-buttons.primary class="bg-blue-500 text-white p-2 rounded-[5px]">Show answer</x-buttons.primary>
                        <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400">
                            <option value="" disabled selected>Export</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <!-- questions -->
                <div>
                    @foreach($quiz['questions'] as $question)
                    <x-questions.question :question="$question"></x-questions.question>
                    @endforeach
                </div>

            </div>

            @else
            <!-- first -->
            <div class="p-5 rounded bg-primary w-[50%] center result-intro">
                <h2 class="mb-2 text-[26px]">Generate quizzes</h2>
                <p>Generate quizzes from your notes, study materials, or any text you have. You can also create quizzes manually.<i class="fa-duotone fa-microchip-ai text-yellow-400 text-[20px]"></i> <i class="fa-duotone fa-cloud-bolt text-yellow-400 text-[20px]"></i> </p>
            </div>
            @endisset
        </div>
    </div>
</section>

<div class="overlay-loading hidden fixed top-0 left-0 w-[100vw] h-[100vh] z-[9999] bg-primary justify-center items-center">
    Dang tai ...
</div>
clear
@endsection
@section('script')
<script>
    window.routes = {
        quizzesQuestionsStore: "{{ route('quizzes.storeWithAI') }}",
        quizzesUpdate: "{{ route('quizzes.update')}}",
        quizzesQuestionDestroy: "{{ route('quizzes.question.destroy') }}",
        quizzesQuestionUpdate: "{{ route('quizzes.question.update') }}",
    };
</script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection