<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class RoomController extends Controller
{
    public function wating()
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

        $pusher->trigger('UserJoinedRoom', 'send-notify', $data);
        return view('quizz-mode-multiple.wating');
    }

    public function show()
    {
        return view('quizz-mode-multiple.show');
    }

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

        $pusher->trigger('UserLeftRoom', 'send-notify', $data);
        return redirect()->route('dashboard');
    }
}
