<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\UserAnswer;
use Exception;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Reverb\Loggers\Log;

class QuizController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', ['quizzes' => $quizzes]);
    }

    public function create($id = null)
    {
        if ($id != null && Auth::check()) {
            $quiz = Quiz::find($id)->load(['questions' => function ($query) {
                $query->orderBy('id','desc');
            }, 'questions.answers']);
            if (isset($quiz)) {
                $quiz->user_id = auth()->id();
                $quiz->save();
                return view('quizzes.create', ['quiz' => $quiz]);
            } else {
                return redirect()->route('quizzes.create')->with('error', 'Không tìm thấy quiz');
            }
        } else {
            return view('quizzes.create');
        }
    }

    public function show(Quiz $quiz)
    {
        return view('quizzes.show', ['quiz' => $quiz]);
    }

    public function getQuiz($id)
    {
        $quiz = Quiz::find($id);
        return view('quizz-mode-single.index', ['quiz' => $quiz]);
    }

    // Bắt đầu quiz và hiển thị câu hỏi đầu tiên
    public function startQuiz($id)
    {
        // Xóa kết quả trò chơi cũ của người dùng nếu có
        Result::where('user_id', auth()->id())->where('quiz_id', $id)->delete();

        $quiz = Quiz::with('user')->findOrFail($id);
        $firstQuestion = $quiz->questions()->first();
        // Chuyển tiếp người dùng đến giao diện câu hỏi đầu tiên
        return view('quizz-mode-single.question.show', [
            'quiz' => $quiz,
            'question' => $firstQuestion,
            'questionIndex' => 1,
            'totalQuestions' => $quiz->questions()->count()
        ]);
    }



    public function store(Request $request)
    {
        // Validate dữ liệu từ request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // ... các trường khác
        ]);

        // Tạo quiz mới
        $quiz = Quiz::create($validatedData);

        // Trả về phản hồi JSON
        return response()->json([
            'message' => 'Quiz đã được tạo thành công!',
            'quiz' => $quiz, // Có thể trả về thông tin quiz mới để cập nhật giao diện
        ]);
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.edit', ['quiz' => $quiz]);
    }

    public function update(Request $request)
    {
        $id = $request->quiz_id;
        if (isset($id)) {
            $quiz = Quiz::findOrFail($id);
            //validate
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                // ... các trường khác
            ]);


            if ($quiz->update($validatedData)) {
                if ($quiz->status != 0) {
                    $quiz->status = 1; // pending
                }
                $quiz->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Cập nhật thành công!',
                    'quiz' => $quiz, // Có thể trả về thông tin quiz mới để cập nhật giao diện
                ]);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'Cập nhật thất bại!',
                ]);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Cập nhật thất bại!',
            ]);
        }
    }

    //create new question
    public function storeQuestion(Request $request) // Dependency Injection
    {
        // Validate dữ liệu từ request
        $validatedData = $request->validate([
            'excerpt' => 'required|string',
            'type' => 'required|in:radio,checkbox,text', // Kiểm tra loại câu hỏi
            // ... các trường khác
        ]);

        // // Tạo câu hỏi mới
        $quiz = Quiz::findOrFail($request->input('quiz_id'));
        $question = $quiz->questions()->create($validatedData);

        // // Xử lý các đáp án (tùy thuộc vào loại câu hỏi)
        if ($validatedData['type'] === 'radio' || $validatedData['type'] === 'checkbox') {
            $answersData = $request->input('answers'); // Lấy dữ liệu các đáp án
            foreach ($answersData as $answerData) {
                $question->answers()->create([
                    'content' => $answerData['content'],
                    'is_correct' => isset($answerData['is_correct']) ? true : false,
                ]);
            }
        }

        // // Trả về phản hồi JSON
        return response()->json([
            'message' => 'Câu hỏi đã được tạo thành công!',
            'question' => $question, // Có thể trả về thông tin câu hỏi mới để cập nhật giao diện
        ]);
    }

    //ham choi
    public function submitAnswer(Request $request, $quizId, $questionId)
    {
        $userId = auth()->id();
        $answerIds = $request->input('answer');
        $correctAnswerIds = []; // Danh sách các ID của các câu trả lời đúng
        $correct = true;

        if (is_array($answerIds)) {
            foreach ($answerIds as $answerId) {
                $answer = Answer::find($answerId);
                if (!$answer || !$answer->is_correct) {
                    $correct = false;
                } else {
                    $correctAnswerIds[] = $answerId; // Thêm ID của câu trả lời đúng vào danh sách
                }
            }
        } else {
            $answer = Answer::find($answerIds);
            if (!$answer || !$answer->is_correct) {
                $correct = false;
            } else {
                $correctAnswerIds[] = $answerIds; // Thêm ID của câu trả lời đúng vào danh sách
            }
        }

        // Cập nhật điểm số của người dùng nếu cần thiết
        if ($correct) {
            $result = Result::firstOrCreate(['user_id' => $userId, 'quiz_id' => $quizId]);
            $result->increment('score');
        }

        // Xác định URL của câu hỏi tiếp theo hoặc trang kết quả
        $quiz = Quiz::find($quizId);
        $totalQuestions = $quiz->questions()->count();
        $nextQuestionIndex = $questionId + 1;

        if ($nextQuestionIndex > $totalQuestions) {
            $nextQuestionUrl = route('quiz.result', ['id' => $quizId]);
        } else {
            $nextQuestionUrl = route('quiz.question.show', ['id' => $quizId, 'questionIndex' => $nextQuestionIndex]);
        }

        // Trả về phản hồi JSON với thông tin về tính chính xác và danh sách các câu trả lời đúng
        return response()->json([
            'correct' => $correct,
            'correctAnswerIds' => $correctAnswerIds, // Trả về danh sách các câu trả lời đúng
            'nextQuestionUrl' => $nextQuestionUrl,
            'message' => $correct ? 'Câu trả lời chính xác!' : 'Câu trả lời không chính xác. Vui lòng thử lại.'
        ]);
    }




    // Kết quả
    public function showResult($id)
    {
        $quiz = Quiz::findOrFail($id);
        $userId = Auth::id();
        $result = Result::where('user_id', $userId)->where('quiz_id', $id)->first();

        return view('quizz-mode-single.result', [
            'quiz' => $quiz,
            'result' => $result
        ]);
    }

    //lay toan bo questions cua 1 quiz
    public function getQuestions($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $questions = $quiz->questions;
        return response()->json([
            'questions' => $questions,
        ]);
    }

    public function showQuestion($id, $questionIndex)
    {
        $quiz = Quiz::find($id);
        $questions = $quiz->questions;
        $question = $questions[$questionIndex - 1];
        return view('quizz-mode-single.question.show', [
            'quiz' => $quiz,
            'question' => $question,
            'questionIndex' => $questionIndex,
            'totalQuestions' => $questions->count(),
        ]);
    }




    function hashFileName($fileName)
    {
        $hashedName = md5($fileName . time()); // Thêm thời gian để tránh trùng lặp
        return "{$hashedName}.json";
    }

    public function storeQuizWithAI(Request $request)
    {

        $difficulty = $request->difficulty;
        $size_questions = $request->size_questions;
        $content = $request->content;
        $language = $request->language;
        $type = $request->type;
        $prompt = '
        Please give me randomly <<total_questions : '
            . $size_questions . '>> questions of type <<type:'
            . $type . '>> on a random topic within <<title: '
            . $content . ' >>. 
        I want the questions to have a difficulty level of <<difficulty : ' . $difficulty . ' >>. 
        I want the language for all content to be <<language : ' . $language . ' >>.
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

        This is an invalid case : ```json{
            "questions": {}
        }``` because it does not start with { and end with }.
        ';
        $result = Gemini::geminiPro()->generateContent($prompt);
        $result = str_replace('`json', '', $result->text());
        $result = str_replace('`', '', $result);
        $fileName = $this->hashFileName($content);
        Storage::disk('public')->put("datajson/$fileName", $result);
        $data = Storage::disk('public')->get("datajson/$fileName");
        $data = json_decode($data, true);
        try {
            if (isset($data['questions']) && count($data['questions']) > 0) {
                $quiz = null;
                if (isset($request->quiz_id)) {
                    $quiz = Quiz::find($request->quiz_id);
                    if ($quiz->status != 0) {
                        $quiz->status = 1; // pending
                    }
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
                Storage::disk('public')->delete("datajson/$fileName");
                return redirect()->route('quizzes.create', $quiz->id);
            } else {
                Storage::disk('public')->delete("datajson/$fileName");
                return response()->json([
                    'status' => 'error',
                ]);
            }
        } catch (\Exception $e) {
            Storage::disk('public')->delete("datajson/$fileName");
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function createQuizWithAI()
    {
        return view('quizzes.create-ai');
    }

    public function indexAdmin()
    {
        $quizzes = Quiz::where('status', '!=', 0)->with('questions', 'user')->withCount('questions')->get();
        return view('admin.quiz.index', ['quizzes' => $quizzes]);
    }

    public function published(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quizId);
        $quiz->status = 1; // pending
        $quiz->save();
        return response()->json([
            'status' => 200,
            'message' => 'Quiz của bạn đang được duyệt, vui lòng đợi thông báo từ chúng tôi!',
        ]);
    }

    public function getDetailsQuiz(Request $request)
    {
        $questions = Quiz::findOrFail($request->quizId)->questions()->with('answers')->get();
        return response()->json([
            'status' => 200,
            'questions' => $questions,
        ]);
    }

    public function appectQuiz(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quizId);
        $quiz->status = 2; // published
        $quiz->save();
        return response()->json([
            'status' => 200,
            'message' => 'Duyệt quiz thành công',
        ]);
    }

    public function rejectQuiz(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quizId);
        $quiz->status = 3; // rejected
        $quiz->save();
        return response()->json([
            'status' => 200,
            'message' => 'Từ chối quiz thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quizId);
        $quiz->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa quiz thành công',
        ]);
    }
}
