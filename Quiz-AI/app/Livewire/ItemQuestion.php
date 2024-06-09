<?php

namespace App\Livewire;

use App\Livewire\Forms\QuestionEditForm;
use App\Models\Answer;
use App\Models\Question;
use Livewire\Component;

class ItemQuestion extends Component
{
    public $question;
    public $isHidden;
    public QuestionEditForm $form;

    public $test = 0;


    public function mount($question)
    {
        $this->question = $question;
        $this->isHidden = true;
        $this->form->excerpt = $question->excerpt;
        $this->form->answers = $question->answers->pluck('content')->toArray();
        $this->form->corrects = array_keys($question->answers->pluck('is_correct')->toArray(), 1);
    }

    public function showModalEditQuestion()
    {

        $this->isHidden = false;
    }

    public function hidenModalEditQuestion()
    {
       
        $this->isHidden = true;
    }

    public function destroy(){
        $question = Question::find($this->question->id);
        $quizId = $question->quiz->id;
        if ( $question->delete()){
            $this->dispatch('quiz-created',quizId: $quizId);
            $this->dispatch('toast',message: 'Xoa thanh cong',status: 'success');
        }
        else{
            $this->dispatch('toast',message: 'Loi khi xoa, thu lai sai',status: 'error');
        }
        
    }

    public function update(){

        $question = Question::find($this->question->id);
        if ($question) {
            $question->excerpt = $this->form->excerpt;
            $question->optional = "tét";
            foreach ($question->answers as $key => $answer) {
                $answerUpdate = Answer::find($answer->id);
                $answerUpdate->content = $this->form->answers[$key];
                //checktype
                if (is_array($this->form->corrects)){
                    $answerUpdate->is_correct = in_array($key,$this->form->corrects) ? 1 : 0;
                }
                else{
                    $answerUpdate->is_correct =($key == $this->form->corrects) ? 1 : 0;
                }
                $answerUpdate->save();
            }
            $question->save();
            $this->isHidden = true;
            $this->test = 1;
            $this->dispatch('toast',message: 'Cap nhat câu hỏi thành công',status: 'success');
        }
        else{
            $this->dispatch('toast',message: 'Cap nhat loi',status: 'error');
        }

    }

    public function render()
    {
        return view('livewire.item-question',['question' => $this->question]);
    }
}
