<?php

namespace App\Livewire;

use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FormCreateQuizImage extends Component
{
    use WithFileUploads;
    public $imageInput;
    public $quiz_id;

    public $isShow = false;
    public function showModal(){
        $this->isShow = true;
    }

    public function hiddenModal(){
        $this->isShow = false;
    }

    public function mount($quiz_id = null)
    {
        $this->quiz_id = $quiz_id;
    }
    public function render()
    {
        return view('livewire.form-create-quiz-image');
    }

    public function store()
    {
        $this->validate([
            'imageInput' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imagePath = $this->imageInput->store('images', 'public');
        $fullImagePath = storage_path('app/public/' . $imagePath); // Correctly build the full path to the stored image
        $imageData = base64_encode(Storage::get('public/' . $imagePath)); // Adjust the path for Storage::get
        
        // Determine the correct mime type based on file extension
        $mimeType = mime_content_type($fullImagePath);

        $prompt = '
       I want questions of type <<type:'
                            . 'random[checkbox,radio]' . '>>. 
        I want you to transfer all the content in the text in the photo to the question.
        I want the language for all content to be <<language : ' . 'Vietnameses' . ' >>.
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
                        }
        ';
        
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url . '?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                        [
                            'inlineData' => [
                                'mimeType' => $mimeType, // Use the determined mime type
                                'data' => $imageData, // Base64 encoded image data
                            ]
                        ]
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
            dd($e);
            $this->dispatch('toast', message: 'Tạo câu hỏi thất bại', status: 'error');
        }
        $this->isShow = false;
    }
}
