<?php

namespace App\Livewire;

use Livewire\Component;

class BarCreateQuiz extends Component
{
    public $quiz;
    public $currentBar = 1;
    public function mount($quiz=null){
        $this->quiz = $quiz;
    }
    public function render()
    {
        return view('livewire.bar-create-quiz');
    }

    public function textBar(){
        $this->currentBar = 1;
    }

    public function manualBar(){
        $this->currentBar = 2;
    }

    public function imageBar(){
        $this->currentBar = 3;
    }

}
