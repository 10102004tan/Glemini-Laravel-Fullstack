<?php

namespace App\Livewire;

use App\Livewire\Forms\QuestionEditForm;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ItemQuestion extends Component
{
    use WithFileUploads;
    public $question;
    public $isHidden;
    public QuestionEditForm $form;


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
        if (!empty($question->image)){
            //remove image
            Storage::disk('public')->delete($question->image);
        }
        if ( $question->delete()){
            $this->dispatch('quiz-created',quizId: $quizId);
            $this->dispatch('toast',message: 'Xoa thanh cong',status: 'success');
        }
        else{
            $this->dispatch('toast',message: 'Loi khi xoa, thu lai sai',status: 'error');
        }
    }

    public function update(){
        if ($this->question) {
            $this->question->excerpt = $this->form->excerpt;
            $this->question->optional = "tét";
            if ($this->form->image){
                $imagePath = $this->form->image->store('images', 'public');
                $this->question->image = $imagePath;
            }
            foreach ($this->question->answers as $key => $answer) {
                $answer->content = $this->form->answers[$key];
                //checktype
                if (is_array($this->form->corrects)){
                    $answer->is_correct = in_array($key,$this->form->corrects) ? 1 : 0;
                }
                else{
                    $answer->is_correct =($key == $this->form->corrects) ? 1 : 0;
                }
                $answer->save();
            }
            $this->question->save();
            $this->isHidden = true;
            $this->dispatch('toast',message: 'Cap nhat câu hỏi thành công',status: 'success');
        }
        else{
            $this->dispatch('toast',message: 'Cap nhat loi',status: 'error');
        }

    }
    public function render()
    {
        return view('livewire.item-question');
    }
}
