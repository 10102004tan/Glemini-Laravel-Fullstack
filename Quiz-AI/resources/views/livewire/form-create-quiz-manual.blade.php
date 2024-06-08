<form wire:submit="store" class="modal-show-option-manual hidden">
    @isset($quiz_id)
    <input type="hidden" wire:model="quiz_id" value="{{$quiz_id}}" class="text-black">
    @endisset
    <label for="" class="flex flex-col items-start">
        <span class="text-white mb-2 block">Question type</span>
        <select required wire:model="type" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 select-option-manual-question">
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
            <textarea rows="5" class="p-3 w-[100%] outline-none border-2 border-gray-400 rounded-[10px] bg-primary" wire:model="optional" id="" placeholder="Type off copy ..."></textarea>
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