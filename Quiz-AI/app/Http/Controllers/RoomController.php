<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    // Show wating room
    public function wating($id)
    {
        $user = Auth::guard('web')->user();
        $data['title'] = "Joined Room";
        $data['content'] = "$user->name joned room";
        $data['user'] = $user;

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        // Update user joined room
        $room = Room::where('room_id', $id)->first();
        // Check if user already joined room
        if (!$room->joinedUsers()->where('user_id', $user->id)->exists()) {
            $room->joinedUsers()->attach($user->id);
        }
        $pusher->trigger('UserJoinedRoom', 'send-notify', $data);
        return view('quizz-mode-multiple.wating', ["room_id" => $id, "id" => $room->id, "user_created" => $room->created_at_by]);
    }

    // Show quizz room
    public function show($id)
    {

        $room = Room::where('room_id', $id)->first();
        if ($room->created_at_by === Auth::user()->id) {
            $user = Auth::guard('web')->user();
            $data['title'] = "Start Room";
            $data['content'] = "$user->name just start room";
            $data['user'] = $user;

            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pusher->trigger('UserStartRoom', 'send-notify', $data);
        }

        return view('quizz-mode-multiple.show', ["room_id" => $id]);
    }

    // User left room
    public function left($id)
    {
        // Update user left room in database

        // Update user left room in pusher
        $user = Auth::guard('web')->user();
        $data['title'] = "Joined Room";
        $data['content'] = "$user->name left room";
        $data['user'] = $user;

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        // Delete user from room
        $room = Room::where('room_id', $id)->first();
        $room->joinedUsers()->detach($user->id);

        $pusher->trigger('UserLeftRoom', 'send-notify', $data);
        return redirect()->route('home');
    }

    //
    public function create()
    {
        // Find quizz by user id
        $quizzes = Quiz::where('user_id', Auth::user()->id)->get();
        // Find rooms by user id
        $rooms = Room::where('created_at_by', Auth::user()->id)->get();

        return view("rooms.create", ["quizzes" => $quizzes, "rooms" => $rooms]);
    }

    // Create new room
    public function createRoom(Request $request)
    {
        // Create unique room id
        $uuid = Str::uuid();

        // Create new room
        $room = new Room();
        $room->created_at_by = $request->user()->id;
        $room->room_id = $uuid;
        $room->quizz_id = $request->quizz_id;
        $room->room_name = $request->room_name;
        $room->room_description = $request->room_description;

        $room->save();
        $room->joinedUsers()->attach($request->user()->id);
        return redirect()->route('quiz.multiple.join', ['id' => $uuid]);
    }

    // Update room when user join


}
