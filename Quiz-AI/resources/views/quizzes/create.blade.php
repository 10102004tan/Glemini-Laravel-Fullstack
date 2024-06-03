@extends('layouts.app')
@section('content')
<div class="shadow-bar sticky top-0 left-0 right-0 bg-primary z-[9999]">
    <div class="container">
        <div>
            @isset($quiz)
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="inline-block py-5 font-[500] text-white">{{$quiz->title}}</h2>
                    <button type="button" class="btn-edit-quiz"><i class="fa-light fa-pen-to-square"></i></button>
                </div>

                <div class="flex items-center gap-2">
                <button data-modal-target="default-modal" data-modal-toggle="default-modal" id="btn-share" type="button" class="flex items-center py-1 px-2 rounded border border-[#eee]">
                <i class="fa-sharp fa-regular fa-share-nodes p-2"></i>
                    Share
                    </button>
                    <button id="btn-settings" type="button" class="flex items-center py-1 px-2 rounded border border-[#eee]">
                    <i class="fa-regular fa-gear p-2"></i>
                    Setting
                    </button>
                    <button type="button" class="py-2 px-2 rounded bg-blue-500">
                    Play
                    </button>

                    @if ($quiz->status == 0)
                    <button quizId="{{$quiz->id}}" type="button" class="py-2 px-2 rounded btn-published bg-green-500">
                        Publish
                    </button>
                    @elseif($quiz->status == 1)
                    <button type="button" class="py-2 px-2 rounded bg-yellow-200">
                        Pendding
                    </button>
                    @elseif($quiz->status == 3)
                    <button type="button" class="py-2 px-2 rounded bg-red-500">
                        Reject
                    </button>
                    @endif
                </div>
            </div>
            <!-- edit -->
            <div class="bg-overlay fixed z-[999] w-[100vw] h-[100vh] top-0 invisible opacity-0 left-0  modal-edit-quiz">
                <form class="py-4 px-5 border-[1px] border-gray-200 rounded-[10px] center md:w-[60%] w-[80%] bg-primary modal-update-quiz">
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

<!-- settings start -->
<div class="settings lg:w-[20vw] w-[40vw] z-[9999] h-[100vh] fixed top-0 right-[-100%] bg-primary p-3">
   <div class="flex justify-between">
   <h2>Default setting</h2>
    <button type="button" class="btn-close-settings"><i class="fa-light fa-xmark"></i></button>
   </div>
   <hr>
   <ul>
    <li>Share</li>
    <li>Behaviour</li>
    <li>Share</li>
   </ul>
</div>
<!-- settings end -->

<!-- main start-->
@if(!session('error'))
<section>
    <div class="grid grid-cols-12">
        <div class="px-[2rem] py-4 create bg-primary relative lg:col-span-4 col-span-12">
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
                    <x-inputs.input title="Enter Your Text " placeholder="Type or copy and paste your notes to generate questions from text. Maximum 4,000 characters. Paid accounts can use up to 30,000 characters." name="content" row="10"></x-inputs.input>
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
                    @if(Auth::check())
                    <button class="w-[100%] py-3 rounded-[10px] text-white font-[500] bg-blue-600 btn-generate-ai">Generate</button>
                    @else
                    <a href="{{route('login')}}" class="block text-center py-3 rounded-[10px] text-white font-[500] bg-blue-600">Generate</a>
                    @endif
                </div>

            </form>
            <form class="modal-show-option-manual hidden" quizId="{{(isset($quiz)) ? $quiz->id : "-1"}}">
                <label for="" class="flex flex-col items-start">
                    <span class="text-white mb-2 block">Question type</span>
                    <select required name="type" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 select-option-manual-question">
                        <option value="radio">One chocie</option>
                        <option value="checkbox">Multiple Choice</option>
                    </select>
                </label>

                <x-inputs.input class="mb-3" required="required" row="5" title="Enter Your Text" name="excerpt" placeholder="Type or copy and paste your notes to generate questions from text. Maximum 4,000 characters. Paid accounts can use up to 30,000 characters."></x-inputs.input>

                <!--4 answer use textarea -->
                <div class="flex flex-col gap-3">
                    @for ($i = 1; $i <= 4; $i++) <x-inputs.input required="required" row="1" title="Answer {{$i}}" name="answer" placeholder="Enter answer {{$i}}"></x-inputs.input>
                    @endfor
                </div>

                <!-- correct choice -->
                <label for="" class="flex flex-col items-start mb-3">
                    <span class="text-white mb-2 block">Correct Answer</span>
                    <select name="is_correct" required class="bg-primary
                    p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%] select-option-manual-correct">
                        <option value="0">A</option>
                        <option value="1">B</option>
                        <option value="2">C</option>
                        <option value="3">D</option>
                    </select>
                </label>

                <!-- Answer Info (optional) -->
                <div class="mb-3">
                    <label for="">
                        <span class="text-white
                    block mb-2">Answer Info (optional)</span>
                        <textarea rows="5" class="p-3 w-[100%] outline-none border-2 border-gray-400 rounded-[10px] bg-primary" name="optional" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                    <p class="text-white text-[14px]">This will be shown to the user after they answer the question.</p>
                </div>

                @if(Auth::check())
                    <button class="w-[100%] py-3 rounded-[10px] text-white font-[500] bg-blue-500 mb-3">Add question</button>
                @else
                    {{Session::put('unlogin', 'true');}}
                    <a href="{{route('login')}}" class="block text-center py-3 rounded-[10px] text-white font-[500] bg-blue-600 mb-3">Add question</a>
                @endif
                <button class="w-[100%] py-3 rounded-[10px] border-[1px] border-gray-200 text-white font-[500] bg-transparent hover:bg-gray-400 mb-3 btn-reset-form" type="button">Reset</button>

                <!-- notification Info -->
                <div class="px-4 py-2 rounded-[5px] flex bg-blue-500 items-start gap-3">
                    <i class="fa-light fa-circle-info"></i>
                    <p class="text-[13px] text-blue-200">Add additional questions to your quiz by submitting the form again. Feel free to adjust the question type and content, or add individual questions manually.</p>
                    <button class="w-[100px] h-[30px] flex items-center justify-center rounded hover:bg-blue-600"><i class="fa-light fa-xmark"></i></button>
                </div>
            </form>
        </div>
        <div class="result lg:col-span-8 py-4 px-5 bg-secondary relative col-span-12">
            @isset($quiz)
            <div class=" result-questions md:mb-5">
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
            <div class="p-5 rounded bg-primary w-[50%] mx-auto lg:mt-[150px] mt-3 relative result-intro">
                <h2 class="mb-2 text-[26px]">Generate quizzes</h2>
                <p>Generate quizzes from your notes, study materials, or any text you have. You can also create quizzes manually.<i class="fa-duotone fa-microchip-ai text-yellow-400 text-[20px]"></i> <i class="fa-duotone fa-cloud-bolt text-yellow-400 text-[20px]"></i> </p>
            </div>
            @endisset
        </div>
    </div>
</section>
@else
<div class="bg-primary text-white p-5">
    <h2 class="text-[26px]">Error</h2>
    <p>{{session('error')}}</p>
</div>
@endif

<!-- main end -->



<!-- modal publish -->


<div class="overlay-loading hidden fixed top-0 left-0 w-[100vw] h-[100vh] z-[9999] bg-primary justify-center items-center">
    Dang tai ...
</div>
@endsection
@section('script')
<script>
    window.routes = {
        quizzesQuestionsStoreAI: "{{ route('quizzes.storeWithAI') }}",
        quizzesUpdate: "{{ route('quizzes.update')}}",
        quizzesQuestionDestroy: "{{ route('quizzes.question.destroy') }}",
        quizzesQuestionUpdate: "{{route('quizzes.question.update')}}",
        quizzesQuestionStore: "{{route('quizzes.question.store')}}",
        quizzesPublished: "{{route('quizzes.published')}}",
    };
</script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection