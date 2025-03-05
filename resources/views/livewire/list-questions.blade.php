<div>
    @foreach($questions as $question)
    <livewire:item-question :question="$question" :key="$question->id" />
    @endforeach
</div>
@script
<script>
</script>
@endscript