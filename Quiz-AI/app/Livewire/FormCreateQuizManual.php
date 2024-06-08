<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class FormCreateQuizManual extends Component
{

    public $excerpt;
    public $type;
    public $optional;
    public $answers = [];

    public $quiz_id;
    public $corrects = [];

    public function mount($quiz_id=null)
    {
        $this->quiz_id = $quiz_id;
        $this->type = "radio";
        $this->corrects = [
            0
        ];
        
    }
    public function render()
    {
        return view('livewire.form-create-quiz-manual');
    }

    public function store(){
        $isFirst = true;
        $quiz = null;
        if (isset($this->quiz_id)) { //Them vao quiz
            $quiz = Quiz::find($this->quiz_id);
            if ($quiz->status != 0){
                $quiz->status = 1; // pending
            }
            $quiz->save();
            $isFirst = false;
        } else { //Tao quiz moi
            $quiz = new Quiz();
            $quiz->title = "New Quiz";
            $quiz->description = "New Quiz Description";
            $quiz->save();
        }

        $question = new Question();
        $question->excerpt = $this->excerpt;
        $question->optional = $this->optional;
        $question->type = $this->type;
        $question->quiz_id = $quiz->id;
        $question->save();

        $collection = collect($this->corrects);
        foreach($this->answers as $key => $answer ){
            $answerModel = new Answer();
            $answerModel->content = $answer;
            $answerModel->is_correct = ($collection->contains(($key - 1))) ? 1 : 0;
            $answerModel->question_id = $question->id;
            $answerModel->save();
        }
       
        if ($isFirst) {
            return redirect()->route('quizzes.create', $quiz->id);
        }
        else{
            $this->type = "radio";
            $this->excerpt = "";
            $this->optional = "";
            $this->answers = [];
            $this->corrects = [
                0
            ];
            $this->dispatch('toast-manual',message: 'Tạo câu hỏi thành công',status: 'success');
            $this->dispatch('quiz-created',quizId: $this->quiz_id); 
        }
    }
}
