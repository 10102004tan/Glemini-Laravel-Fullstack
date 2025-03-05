<?php

namespace App\Livewire;

use App\Models\Answer;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\UserAnswer;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListQuestions extends Component
{
    public $questions = [];
    public $quiz;

    public function mount($quiz)
    {
        $this->quiz = $quiz;
        $this->questions = $quiz['questions'];
    }
    

    #[On('quiz-created')] 
    public function refreshQuestions($quizId)
    {
        
        $this->quiz = Quiz::find($quizId);
        $this->questions = $this->quiz->questions()->orderBy('id','desc')->get();
    }

    public function render()
    {
        return view('livewire.list-questions');
    }
}
