<?php

namespace App\Livewire;

use Livewire\Component;

class ItemQuiz extends Component
{
    public $quiz;
    public $action;
    public $show = false;
    public $status;
    public function mount($quiz,$status)
    {
        $this->quiz = $quiz;
        $this->show = false;
        $this->status = $status;
    }
    public function render()
    {
        return view('livewire.item-quiz');
    }

    public function showAndHidden()
    {
       $this->show = !$this->show;
    }

    public function delete()
    {
        $this->quiz->delete();
        $this->dispatch('toast', message: 'Xoa thanh cong', status: 'success');
    }
}
