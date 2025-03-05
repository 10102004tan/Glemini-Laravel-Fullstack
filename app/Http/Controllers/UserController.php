<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('quizzes')->withCount('quizzes')->get();
        return view('admin.users.index', compact('users'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password || '12345'),
        ]);

        $user->loadCount('quizzes');
        
        return response()->json(['success' => true, 'user' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Add other necessary fields here
        ]);

        return response()->json(['success' => true, 'user' => $user], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function quizzes()
    {
        $quizzes = auth()->user()->quizzes->load('questions');
        // $perPage = 4;
        // $total = ceil($quizzes->count() / $perPage);
        // $quizzes = Quiz::with('questions')->where('user_id', auth()->id())->skip(5)->limit($perPage)->get();
        return view('quizzes.my-quiz',['quizzes' => $quizzes]);
    }

    public function loadMore($page=1){
        $perPage = 4;
        $skip = ($page - 1) * $perPage;
        $quizzes = Quiz::with('questions')->where('user_id', auth()->id())->skip($skip)->limit($perPage)->get();
        return response()->json($quizzes);
    }
}
