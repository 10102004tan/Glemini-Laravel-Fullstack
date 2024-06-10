<div>
    @if($isHidden)
    <div id="submitQuestion" class="rounded-[10px] bg-primary mx-auto p-5 shadow-md mb-3 modal-question" data-question-id="{{ $question->id }}">
        <div class="excerpt" id="questionContent" class="mb-4">
            <p class="text-[20px] text-[#eee]">{!! $question->excerpt !!}</p>
        </div>
        <div id="answerOptions" class="mb-5">
            <!-- Kiem tra truong hop la radio -->
            @if ($question->type === 'radio')
            @foreach ($question->answers as $answer)
            <div class="mb-3">
                <input disabled type="radio" name="answer_{{$answer->id }}" value="{{ $answer->id }}" {{($answer->is_correct == 1) ? "checked" : "" }} id="answer_{{ $answer->id }}">
                <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
            </div>
            @endforeach
            @elseif ($question->type === 'checkbox')
            @foreach ($question->answers as $answer)
            <div class="mb-3">
                <input disabled type="checkbox" name="answer_{{$answer->id }}" value="{{ $answer->id }}" id="answer_{{ $answer->id }}" {{($answer->is_correct == 1) ? "checked" : "" }}>
                <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
            </div>
            @endforeach
            @elseif ($question->type === 'text')
            <textarea name="answer" class="shadow mb-3 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3"></textarea>
            @endif
        </div>

        <!-- option question -->
        <hr>
        <div class="py-3 flex items-center justify-end gap-5 relative">
            <div class="relative group">
                <button wire:click="showModalEditQuestion" type="button" class="btn-edit-question hover:"><i class="fa-light fa-pen-to-square"></i></button>
                <span class="absolute text-[14px] hidden bottom-[100%] text-nowrap left-[50%] translate-x-[-50%] p-1 rounded bg-slate-300 group-hover:inline-block">Edit question</span>
            </div>
            <div>
                <label for="delete" class="btn-delete-question relative group">
                    <input id="delete" class="opacity-0 absolute cursor-pointer w-[30px] top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] delete action-checkbox" type="checkbox">
                    <i class="fa-light fa-trash-alt cursor-pointer"></i>
                    <div class="wrapper-confirm absolute right-0 p-3 border-[1px] border-gray-400 rounded bg-primary w-[150px] flex-col items-start">
                        <p class="text-[12px]">Are you sure you want to delete this question?</p>
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" class="text-gray-400 hover:text-gray-500 text-[12px]">Cancel</button>
                            <form wire:submit="destroy" class="modal-destroy-question">
                                <button type="submit" class="text-red-600 hover:text-red-700 text-[12px]">Delete</button>
                            </form>
                        </div>
                    </div>
                    <span class="absolute text-[14px] hidden bottom-[100%] text-nowrap left-[50%] translate-x-[-50%] p-1 rounded bg-slate-300 group-hover:inline-block">Delete</span>
                </label>
            </div>
        </div>
    </div>
    @endif
    <!-- form edit question -->
    @if(!$isHidden)
    <form wire:submit="update"  class="p-4 rounded-[10px] bg-primary flex-col gap-3  mb-3 modal-edit-question">
        <h5>Edit Multiple Choice Question</h5>
        <x-inputs.file></x-inputs.file>
        <label for="">
            <span class="text-white block mb-2 ">Question</span>
            <textarea  wire:model="form.excerpt" required rows="5" class="p-3 w-[100%] outline-none border-[2px] border-gray-400 focus:border-blue-500 rounded-[10px] bg-primary" placeholder="Enter question"></textarea>
        </label>
        @foreach($question->answers as $key => $answer)
        <label for="" wire:key="answer_{{ $answer->id }}">
            <span class="text-white block mb-2 ">Answer {{$key+1}}</span>
            <textarea wire:model="form.answers.{{$key}}" required rows="1" class="p-3 w-[100%] outline-none border-[2px] border-gray-400 focus:border-blue-500 rounded-[10px] bg-primary"  placeholder="Enter answer" ></textarea>
        </label>
        @endforeach
        <!-- data correct -->
        @if ($question->type === 'radio')
        <label class="flex flex-col items-start ">
            <span class="text-white mb-2 block">Correct Answer</span>
            <select wire:model="form.corrects" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
            </select>
        </label>
        @elseif($question->type === 'checkbox')
        <label class="flex flex-col items-start ">
            <span class="text-white mb-2 block">Correct Answer</span>
            <select  wire:model="form.corrects" multiple name="correct" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
            </select>
        </label>
        @endif
        <!-- optional info -->
        <x-inputs.input title="Answer Info (optional)" name="optional" placeholder="Enter explain">{{$question->optional}}</x-inputs.input>
        <!-- buttons -->
        <div class="flex items-center justify-end gap-3">
            <button wire:click="hidenModalEditQuestion" type="button" class="bg-primary text-[#eee] p-2 rounded-[5px] border-[1px] border-gray-400  text-[14px] btn-cancel">
                Cancel
            </button>
            <x-buttons.primary class="text-[14px]">{{"Save"}}</x-buttons.primary>
        </div>
    </form>
    @endif
</div>