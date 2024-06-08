<?php

namespace App\Livewire;

use Livewire\Component;

class ItemQuestion extends Component
{
    public $question;
    public $isHidden;

    public function mount($question)
    {
        $this->question = $question;
        $this->isHidden = true;
    }

    public function showModalEditQuestion()
    {
        $this->isHidden = false;
    }

    public function hidenModalEditQuestion()
    {
        $this->isHidden = true;
    }

    public function update(){
        
    }

    public function render()
    {
        return view('livewire.item-question');
    }
}
