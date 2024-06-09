<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Question;
use Livewire\Component;

class ItemQuestion extends Component
{
    public $question;
    public $isHidden;
    public $excerpt;
    public $optional;
    public $answers = [];
    public $corrects = [];

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
        $question = Question::find($this->question->id);
        if ($question) {
            $question->excerpt = $this->excerpt;
            $question->optional = $this->optional;
            foreach ($this->answers as $answer) {
                $answerUpdate = Answer::find($answer['id']);
                $answerUpdate->content = $answer['content'];
                $answerUpdate->is_correct = $answer['is_correct'];
                $answerUpdate->save();
            }
            $question->save();
            return response()->json(
                [
                    'message' => 'Question updated successfully',
                    'question' => $question->load('answers'),
                    'status' => 200
                ]
            );
        }

        return response()->json([
            'message' => 'Question not found',
            'status' => 404
        ]);
    }

    public function render()
    {
        return view('livewire.item-question');
    }
}
