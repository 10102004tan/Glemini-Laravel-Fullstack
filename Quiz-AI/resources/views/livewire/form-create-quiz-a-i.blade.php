<form id="modal-show-option-text" wire:submit="store" class="modal-show-option-text">
    <!-- <button type="button" wire:click="getCookieRecipes">Test</button> -->
    @isset($quiz_id)
    <input type="hidden" wire:model="quiz_id" value="{{$quiz_id}}" class="text-black">
    @endisset
    <div class="create-box mt-4 px-4 py-5 bg-primary ">
        <label for="">
            <span class="text-white block mb-2 ">Enter Your Text </span>
            <textarea wire:model="content" rows="10" class="p-3 w-[100%] outline-none border-[2px] border-gray-400 focus:border-blue-500 rounded-[10px] bg-primary" id="" placeholder="Type or copy and paste your notes to generate questions from text. Maximum 4,000 characters. Paid accounts can use up to 30,000 characters."></textarea>
        </label>
        <div class="grid grid-cols-2 gap-2 mb-3">
            <label for="" class="flex flex-col items-start">
                <span class="text-white mb-2 block">Question type</span>
                <select wire:model="type" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                    <option value="checkbox">Multiple Choice</option>
                    <option value="radio">One Choice</option>
                    <option value="true/false">True/False</option>
                    <option value="short answer">Short Answer</option>
                </select>
            </label>

            <label for="" class="flex flex-col items-start">
                <span class="text-white mb-2 block">Language</span>
                <select wire:model="language" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                    <option value="english">English</option>
                    <option value="vietnamese">Vietnam</option>
                    <option value="japanese">Japanese</option>
                </select>
            </label>

            <label for="" class="flex flex-col items-start">
                <span class="text-white mb-2 block">Difficulty</span>
                <select wire:model="difficulty" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
            </label>

            <label for="" class="flex flex-col items-start">
                <span class="text-white mb-2 block">Max Questions</span>
                <select wire:model="size_questions" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>
            </label>
        </div>
        @if(Auth::check())
        <button type="submit" class="w-[100%] cursor-pointer py-3 rounded-[10px] text-white font-[500] bg-blue-600 btn-generate-ai">{{$titleButton}}</button>
        @else
        <a href="{{route('login')}}" class="block text-center py-3 rounded-[10px] text-white font-[500] bg-blue-600">Generate</a>
        @endif
    </div>
    <div wire:loading class="fixed bg-slate-800 w-[100vw] h-[100vh] z-[99999] top-0 left-0">
        <div class="w-[100%] h-[100%] flex items-center justify-center">
            <div class="loader"></div>
        </div>
    </div>
</form>