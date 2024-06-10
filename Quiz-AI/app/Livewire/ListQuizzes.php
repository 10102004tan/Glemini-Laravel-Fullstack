<?php
namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
class ListQuizzes extends Component
{
    public $quizzes;
    public $status = -1;
    public function mount($quizzes)
    {
        $this->quizzes = $quizzes;
    }
    public function render()
    {
        return view('livewire.list-quizzes');
    }

    #[On('filter-quizzes')] 
    public function refreshQuizzes($quizzes,$status)
    {
        // Cache the quizzes
        $this->quizzes = $quizzes;
        $this->status = $status;
    }

}
