<?php

namespace App\Livewire;

use Livewire\Component;

class FormCreateQuizManual extends Component
{
    public $question;
    public $answer;
    public $options = [];
    public $quiz_id;

    public function mount($quiz_id=null)
    {
        $this->quiz_id = $quiz_id;
    }
    public function render()
    {
        return view('livewire.form-create-quiz-manual');
    }
}
