<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quizId = $request->quiz_id;
        $isFirst = true;
        $quiz = null;
        if ($quizId != -1) { //Them vao quiz
            $quiz = Quiz::find($quizId);
            $isFirst = false;
        } else { //Tao quiz moi
            $quiz = new Quiz();
            $quiz->name = "Quiz created by AI";
            $quiz->description = "Quiz created by AI";
            $quiz->save();
        }

        $question = new Question();
        $question->excerpt = $request->excerpt;
        $question->quiz_id = $quizId;
        $question->type = $request->type;
        $question->save();
        $answers = json_decode($request->answers, true);
        foreach ($answers as $answer) {
            $answerModel = new Answer();
            $answerModel->content = $answer['content'];
            $answerModel->is_correct = $answer['is_correct'];
            $answerModel->question_id = $question->id;
            $answerModel->save();
        }

        if ($isFirst) {
            return response()->json(
                [
                    'message' => 'Question created successfully',
                    'status' => 200
                ]
            );
        }
        return response()->json(
            [
                'message' => 'Question created successfully',
                'question' => $question->load('answers'),
                'status' => 200
            ]
        );
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);
        if ($question) {
            $question->excerpt = $request->excerpt;
            $answers = json_decode($request->answers, true);
            foreach ($answers as $answer) {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $questionId = $request->id;
        $question = Question::find($questionId);
        if ($question) {
            $question->delete();
            return response()->json([
                'message' => 'Question deleted successfully',
                'status' => 200
            ]);
        }
        return response()->json([
            'message' => 'Question not found',
            'status' . $questionId => 404
        ]);
    }
}
