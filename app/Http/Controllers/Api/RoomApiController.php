<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomPoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;
use Pusher\Pusher;

class RoomApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get room
        $room = Room::find($id);
        // Get room join user from room

        // Check if room exist
        if (!$room) {
            return response()->json([
                'message' => 'Room not found',
            ], 404);
        }

        $room->joinedUsers;
        return response()->json([
            'room' => $room,
        ]);
    }

    public function initRoomPoint(string $id, Request $request)
    {
        // Get room
        $room = Room::find($id);
        // Check if room exist
        if (!$room) {
            return response()->json([
                'message' => 'Room not found',
            ], 404);
        }

        // Get room join user from room
        $room->joinedUsers;
        // Check if point have already exsist
        $roomPoints = $room->roomPoints;
        $exsistUser = [];
        if (count($roomPoints) > 0) {
            foreach ($roomPoints as $roomPoint) {
                foreach ($room->joinedUsers as $user) {
                    if ($roomPoint->user_id == $user->id) {
                        array_push($exsistUser, $user->id);
                    }
                }
            }
            //dd($exsistUser);
        }

        if (count($exsistUser) > 0) {
            foreach ($room->joinedUsers as $user) {
                if (!in_array($user->id, $exsistUser)) {
                    RoomPoint::create([
                        'room_id' => $room->id,
                        'user_id' => $user->id,
                        'points' => 0,
                    ]);
                }
            }
        } else {
            foreach ($room->joinedUsers as $user) {
                RoomPoint::create([
                    'room_id' => $room->id,
                    'user_id' => $user->id,
                    'points' => 0,
                ]);
            }
        }

        $room->is_open = true;
        $room->save();

        // Send pusher event
        if ($room->created_at_by == Auth::user()->id) {
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

        return response()->json([
            'status' => "success",
            'room' => $room,
        ]);
    }

    public function getQuestion(string $id)
    {
        // Get room
        $room = Room::where('room_id', $id)->first();
        // Get room join user from room

        // Check if room exist
        if (!$room) {
            return response()->json([
                'message' => 'Room not found',
            ], 404);
        }

        // Get room join user from room
        $room->joinedUsers;

        // Get quizz by quizz id
        $questions = $room->quiz->questions;
        foreach ($questions as $key => $ques) {
            $questions[$key]->answers;
        }

        return response()->json([
            "status" => "success",
            'room' => $room,
        ]);
    }

    public function updateUserPoint(Request $request)
    {
        $room = Room::where('room_id', $request->id)->first();

        if (!$room) {
            return response()->json([
                'status' => 'error',
                'message' => 'Room not found',
            ], 404);
        }
        $room->joinedUsers;
        $roomPoints = $room->roomPoints;
        foreach ($roomPoints as $roomPoint) {
            if ($roomPoint->user_id == $request->user_id) {
                // Update room point here
                $roomPoint->update([
                    "points" => (int) $request->point
                ]);
            }
        }

       return response()->json([
            'status' => 'success',
            'room' => $room,
        ]);
    }

    public function getAllUserInRoom($id)
    {
        $room = Room::where('room_id', $id)->first();
        $users = $room->joinedUsers;

        foreach ($users as $user) {
            $user->roomPoints;
        }

        return response()->json([
            'status' => 'success',
            'users' => $users,
        ]);
    }

    public function closeRoom($id)
    {
        $room = Room::where('room_id', $id)->first();
        $room->is_finish = true;
        $room->save();

        return response()->json([
            'status' => 'success',
            'room' => $room,
        ]);
    }


    public function restartRoom($id)
    {
        $room = Room::where('room_id', $id)->first();
        $room->is_finish = false;
        $room->save();

        return response()->json([
            'status' => 'success',
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
}
