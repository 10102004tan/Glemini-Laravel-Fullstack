<div class="flex flex-col-reverse gap-3">
    @foreach($questions as $question)
        <livewire:item-question :question="$question" :key="$question->id" />
    @endforeach
</div>
@script 
<script>
</script>
@endscript