<div class="flex flex-col-reverse gap-3">
    @foreach($questions as $question)
    <x-questions.question :question="$question"></x-questions.question>
    @endforeach
</div>
@script 
<script>
</script>
@endscript