<div>
    <div id="submitQuestion" class="rounded-[10px] bg-primary mx-auto p-5 shadow-md mb-3 modal-question" data-question-id="{{ $question->id }}">
        <div class="excerpt" id="questionContent" class="mb-4">
            <p class="text-[20px] text-[#eee]">{!! $question->excerpt !!}</p>
        </div>
        <div id="answerOptions" class="mb-5">
            <!-- Kiem tra truong hop la radio -->
            @if ($question->type === 'radio')
            @foreach ($question->answers as $answer)
            <div class="mb-3">
                <input type="radio" name="answer_{{$answer->id }}" value="{{ $answer->id }}" {{($answer->is_correct == 1) ? "checked" : "" }} id="answer_{{ $answer->id }}">
                <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
            </div>
            @endforeach
            @elseif ($question->type === 'checkbox')
            @foreach ($question->answers as $answer)
            <div class="mb-3">
                <input type="checkbox" name="answer_{{$answer->id }}" value="{{ $answer->id }}" id="answer_{{ $answer->id }}" {{($answer->is_correct == 1) ? "checked" : "" }}>
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
                <button type="button" class="btn-edit-question hover:"><i class="fa-light fa-pen-to-square"></i></button>
                <span class="absolute text-[14px] hidden bottom-[100%] text-nowrap left-[50%] translate-x-[-50%] p-1 rounded bg-slate-300 group-hover:inline-block">Edit question</span>
            </div>
            <div>
                <label for="delete" class="btn-delete-question relative group">
                    <input class="opacity-0 absolute w-[30px] top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] delete action-checkbox" type="checkbox">
                    <i class="fa-light fa-trash-alt"></i>
                    <div class="wrapper-confirm absolute right-0 p-3 border-[1px] border-gray-400 rounded bg-primary w-[150px] flex-col items-start">
                        <p class="text-[12px]">Are you sure you want to delete this question?</p>
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" class="text-gray-400 hover:text-gray-500 text-[12px]">Cancel</button>
                            <form class="modal-destroy-question" questionId="{{$question->id}}">
                                <button type="submit" class="text-red-600 hover:text-red-700 text-[12px]">Delete</button>
                            </form>
                        </div>
                    </div>
                    <span class="absolute text-[14px] hidden bottom-[100%] text-nowrap left-[50%] translate-x-[-50%] p-1 rounded bg-slate-300 group-hover:inline-block">Delete</span>
                </label>
            </div>
        </div>
    </div>
    <!-- form edit question -->
    <form questionId="{{$question->id}}" class="p-4 rounded-[10px] bg-primary flex-col gap-3 hidden mb-3  modal-edit-question">
        <h5>Edit Multiple Choice Question</h5>
        <x-inputs.file></x-inputs.file>
        <x-inputs.input title="Question" name="excerpt" placeholder="Enter question">{{$question->excerpt}}</x-inputs.input>
        @foreach($question->answers as $answer)
        <x-inputs.input name="answer" row="1">{{$answer->content}}</x-inputs.input>
        <input type="hidden" name="answer_id" value="{{$answer->id}}">
        @endforeach
        <!-- data correct -->
        @if ($question->type === 'radio')
        <label class="flex flex-col items-start ">
            <span class="text-white mb-2 block">Correct Answer</span>
            <select name="correct" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                @for($i = 0; $i < count($question->answers); $i++)
                    <option value="{{$i}}">{{$question->answers[$i]->content}}</option>
                @endfor
            </select>
        </label>
        @elseif($question->type === 'checkbox')
        <label class="flex flex-col items-start ">
            <span class="text-white mb-2 block">Correct Answer</span>
            <select multiple name="correct" class="bg-primary p-3 rounded-[10px] text-white border-2 border-gray-400 w-[100%]">
                @for($i = 0; $i < count($question->answers); $i++)
                    <option {{($question->answers[$i]->is_correct == 1) ? "selected" : ""}} value="{{$i}}">{{$question->answers[$i]->content}}</option>
                @endfor
            </select>
        </label>
        @endif
        <!-- optional info -->
        <x-inputs.input title="Answer Info (optional)" name="optional" placeholder="Enter explain"></x-inputs.input>
        <!-- buttons -->
        <div class="flex items-center justify-end gap-3">
            <x-buttons.secondary class="text-[14px] btn-cancel" type="button">{{"Cancel"}}</x-buttons.secondary>
            <x-buttons.primary class="text-[14px]">{{"Save"}}</x-buttons.primary>
        </div>
    </form>
</div>