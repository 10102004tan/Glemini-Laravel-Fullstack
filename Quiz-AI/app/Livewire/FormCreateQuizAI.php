<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\UserAnswer;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Masmerise\Toaster\Toaster;

class FormCreateQuizAI extends Component
{
    public $quiz;
    public $quiz_id;
    public $titleButton;
    public $difficulty;
    public $size_questions;
    public $content;
    public $language;
    public $type;

    public function mount($quiz_id = null)
    {
        $this->quiz_id = $quiz_id;
        $this->titleButton = "Generate Quiz";
        $this->difficulty = 'easy';
        $this->size_questions = 5;
        $this->language = 'en';
        $this->type = 'checkbox';
    }
    public function render()
    {
        return view('livewire.form-create-quiz-a-i');
    }

   public function store()
    {
        $isFirst = true;
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';
        $prompt = 'Please give me randomly <<total_questions : '
                            . $this->size_questions . '>> questions of type <<type:'
                            . $this->type . '>> on a random topic within <<title: '
                            . $this->content . ' >>. 
        I want the questions to have a difficulty level of <<difficulty : ' . $this->difficulty . ' >>. 
        I want the language for all content to be <<language : ' . $this->language . ' >>.
        I want each question to have 4 answers. 
        I want the questions to include: excerpt, type,optional and answers. 
        I want the answers to include: content, is_correct. 
        I want the result returned to be an array of questions. 
        I want the values in <<giá trị>> to be valid, if not valid, return an empty questions array []. 
        I want to handle invalid characters in the json data type. 
        I want the returned result to be unique in json data type starting with { and ending with }.
        Here is a valid example of the json data type: 
        {
            "questions": [
                {
                    "excerpt": "Câu hỏi 1",
                    "type": "radio",
                    "optional": "Chi tiết về đáp án",
                    "answers": [
                        {
                            "content": "Đáp án 1",
                            "is_correct": true
                        },
                        {
                            "content": "Đáp án 2",
                            "is_correct": false
                        }
                        ]
                        }
               
                        ]
                        }.
                        ';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url . '?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json',
            ],
        ]);


        $data = json_decode(($response['candidates'][0]['content']['parts'][0]['text']),true);
        try {
            if (isset($data['questions']) && count($data['questions']) > 0) {
                $quiz = null;
                if (isset($this->quiz_id)) {
                    $quiz = Quiz::find($this->quiz_id);
                    if ($quiz->status != 0) {
                        $quiz->status = 1; // pending
                    }
                    $isFirst = false;
                    $quiz->save();
                } else {
                    $quiz = Quiz::create([
                        'title' => 'Quiz with AI',
                        'description' => 'Hello world',
                        'user_id' => auth()->id(),
                    ]);
                }

                foreach ($data['questions'] as $question) {
                    $newQuestion = $quiz->questions()->create([
                        'excerpt' => $question['excerpt'],
                        'type' => $question['type'],
                        'optional' => $question['optional'],
                    ]);
                    foreach ($question['answers'] as $answer) {
                        $newQuestion->answers()->create([
                            'content' => $answer['content'],
                            'is_correct' => $answer['is_correct'],
                        ]);
                    }
                }

                //xóa file json
                $this->content = '';
                if ($isFirst) {
                    return redirect()->route('quizzes.create', $quiz->id);
                } else {
                    $this->dispatch('toast', message: 'Tạo câu hỏi thành công', status: 'success');
                }
                $this->dispatch('quiz-created', quizId: $this->quiz_id);
            } else {
                $this->dispatch('toast', message: 'Tạo câu hỏi thất bại', status: 'error');
            }
        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Tạo câu hỏi thất bại', status: 'error');
        }

    }
}
