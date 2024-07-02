<form wire:submit.prevent="store" class="modal-show-option-manual" wire:ignore>
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

    <label for="">
        <span class="text-white block mb-2 ">Enter Your Text </span>
        <textarea wire:model="excerpt" rows="10" class="p-3 w-[100%] outline-none border-[2px] border-gray-400 focus:border-blue-500 rounded-[10px] bg-primary" id="" placeholder="Type or copy and paste your notes to generate questions from text. Maximum 4,000 characters. Paid accounts can use up to 30,000 characters."></textarea>
    </label>
    <!--4 answer use textarea -->
    <div class="flex flex-col gap-3">
        @for ($i = 1; $i <= 4; $i++) 
        <x-inputs.input model="answers.{{$i}}" required="required" row="1" title="Answer {{$i}}"  placeholder="Enter answer {{$i}}"></x-inputs.input>
        @endfor
    </div>

    <!-- correct choice -->
    <label for="" class="flex flex-col items-start mb-3">
        <span class="text-white mb-2 block">Correct Answer</span>
        <select wire:model="corrects" required class="bg-primary
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

@script
<script>
const selectOptionQuestion = document.querySelector('.select-option-manual-question');
const btnResetForm = document.querySelector('.btn-reset-form');
const modalShowOptionManual = document.querySelector('.modal-show-option-manual');

if (selectOptionQuestion != null) {
selectOptionQuestion.addEventListener('change', function () {
    if (selectOptionQuestion.value == "checkbox") {
        selectOptionManualCorrect.multiple = true;
    } else {
        selectOptionManualCorrect.multiple = false;
    }
});
}

btnResetForm.addEventListener('click', function (e) {
    e.preventDefault();
    modalShowOptionManual.reset();
});
</script>
@endscript