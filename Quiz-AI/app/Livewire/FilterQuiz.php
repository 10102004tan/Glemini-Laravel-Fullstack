<?php

namespace App\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class FilterQuiz extends Component
{

    public $currentCategory;
    public function mount()
    {
        $this->currentCategory = -1;
    }
    public function render()
    {
        return view('livewire.filter-quiz');
    }

    public function filterByCategory($category)
    {
        $this->currentCategory = $category;
        $quizzes = null;
        $status = -1;
        if ($this->currentCategory == -1) {
            $quizzes = auth()->user()->quizzes->load('questions');
        } elseif ($this->currentCategory == 0) {
            $status = 0;
            $quizzes = auth()->user()->quizzes->where('status', '0')->load('questions');
        } elseif ($this->currentCategory == 1) {
            $status = 1;
            $quizzes = auth()->user()->quizzes->where('status', '1')->load('questions');
        } elseif ($this->currentCategory == 2) {
            $status = 2;
            $quizzes = auth()->user()->quizzes->where('status', '2')->load('questions');
        } else {
            $status = 3;
            $quizzes = auth()->user()->quizzes->where('status', '3')->load('questions');
        }
        $this->dispatch('filter-quizzes', quizzes: $quizzes,status: $status);
    }
}
