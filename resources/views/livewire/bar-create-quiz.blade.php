<div>
    <div class="flex gap-4 border-b-[1px] border-gray-400">
        <button type="button" wire:click="textBar" class="{{$currentBar == 1 ? 'active' : ''}}  py-3 border-b-[2px] border-transparent active:border-blue-700 active:text-blue-700 hover:border-slate-500 hover:text-slate-500 text-white show-option">Text</button>
        <button type="button" wire:click="manualBar" class="{{$currentBar == 2 ? 'active' : ''}} py-3 border-b-[2px] border-transparent hover:border-slate-500 hover:text-slate-500 text-white show-option">Manual</button>
        <button type="button" wire:click="imageBar" class="{{$currentBar == 3 ? 'active' : ''}}py-3 border-b-[2px] border-transparent hover:border-slate-500 hover:text-slate-500 text-white show-option">Image</button>
    </div>
    @isset($quiz)
    @if ($currentBar == 1)
    <livewire:form-create-quiz-a-i :quiz_id="$quiz->id" />
    @elseif($currentBar == 2)
    <livewire:form-create-quiz-manual :quiz_id="$quiz->id" />
    @else
    <livewire:form-create-quiz-image :quiz_id="$quiz->id" />
    @endif
    @else
    @if ($currentBar == 1)
    <livewire:form-create-quiz-a-i  />
    @elseif($currentBar == 2)
    <livewire:form-create-quiz-manual  />
    @else
    <livewire:form-create-quiz-image  />
    @endif
    @endisset
</div>