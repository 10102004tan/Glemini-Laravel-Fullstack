<div>
    <div class="grid grid-cols-4 gap-4">
        @foreach ($quizzes as $quiz)
            <livewire:item-quiz :status="$status" :quiz="$quiz" :key="$quiz['id']" />
        @endforeach
    </div>
</div>