@extends('layouts.app')
@section('content')
<div class="shadow-bar sticky top-0 left-0 right-0 bg-primary z-[9999]">
    <div class="container">
        <h2 class="block py-5 font-[500] text-white">Add Questions</h2>
    </div>
</div>


<!-- main -->
<section>
    <div class="grid grid-cols-12">
        <div class="px-[2rem] py-4 create bg-primary relative col-span-4">
            <div class="flex gap-4 border-b-[1px] border-gray-400">
                <button class="py-3 border-b-[2px] border-transparent active:border-blue-700 active:text-blue-700 hover:border-slate-500 hover:text-slate-500 text-white">Text</button>
                <button class="py-3 border-b-[2px] active:border-blue-700 active:text-blue-700 hover:border-slate-500 hover:text-slate-500 text-white">Manual</button>
            </div>

            <div class="showOptions hidden">
                <div class="create-box mt-4 px-4 py-5 bg-primary ">
                    <label for="">
                        <span class="text-white block mb-2">Enter Your Text </span>
                        <textarea rows="10" class="p-3 w-[100%] outline-none border-2 border-blue-500 rounded-[10px] bg-primary" name="" id="" placeholder="Type off copy ..."></textarea>
                    </label>
                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <label for="" class="flex flex-col items-start">
                            <span class="text-white mb-2 block">Question type</span>
                            <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="1">Multiple Choice</option>
                                <option value="2">True/False</option>
                                <option value="3">Short Answer</option>
                            </select>
                        </label>

                        <label for="" class="flex flex-col items-start">
                            <span class="text-white mb-2 block">Language</span>

                            <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="1">English</option>
                                <option value="2">Hindi</option>
                                <option value="3">Marathi</option>
                            </select>
                        </label>

                        <label for="" class="flex flex-col items-start">

                            <span class="text-white mb-2 block"> Difficulty</span>
                            <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="1">Easy</option>
                                <option value="2">Medium</option>
                                <option value="3">Hard</option>
                            </select>
                        </label>

                        <label for="" class="flex flex-col items-start">

                            <span class="text-white mb-2 block">Max Questions</span>
                            <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </label>
                    </div>
                    <button class="w-[100%] py-3 rounded-[10px] text-white font-[500] bg-blue-600">Generate</button>
                </div>
            </div>

            <div class="showOptions">
                <label for="" class="flex flex-col items-start">
                    <span class="text-white mb-2 block">Question type</span>
                    <select class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400">
                        <option value="1">Multiple Choice</option>
                        <option value="2">True/False</option>
                        <option value="3">Short Answer</option>
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
                    p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
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
                <button class="w-[100%] py-3 rounded-[10px] border-[1px] border-gray-200 text-white font-[500] bg-transparent hover:bg-gray-400 mb-3">Reset</button>

                <!-- notification Info -->
                <div class="px-4 py-2 rounded-[5px] flex bg-blue-500 items-start gap-3">
                    <i class="fa-light fa-circle-info"></i>
                    <p class="text-[13px] text-blue-200">Add additional questions to your quiz by submitting the form again. Feel free to adjust the question type and content, or add individual questions manually.</p>
                    <button class="w-[100px] h-[30px] flex items-center justify-center rounded hover:bg-blue-600"><i class="fa-light fa-xmark"></i></button>
                </div>
            </div>
        </div>
        <div class="result col-span-8 py-4 px-5 bg-secondary">
            <div class="intro-binding flex justify-between p-3 mb-5 rounded bg-blue-500">
                <div class="pb-[30px]">
                    <h5 class="mb-2 text-[24px]">Study better</h5>
                    <p>Unlimited quizzes, unlimited questions. Upload long files, scan your notes and more</p>
                </div>
                <span class="font-bold text-[18px] mt-auto">View Deal</span>
            </div>

            <!-- thumb -->
            <div class="thumb overflow-hidden mb-5">
                <img class="w-[100%] rounded-[10px] object-cover h-[300px]" src="https://uploads.dailydot.com/2023/12/crying-cat-meme.jpg?q=65&auto=format&w=1200&ar=2:1&fit=crop" alt="">
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

            <!--list question -->
            <!-- <div>
            </div> -->
        </div>
    </div>

</section>
@endsection
@section('script')
<script>

</script>
@endsection