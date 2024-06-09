<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at_by', 'room_id', 'quizz_id', 'room_name', 'room_description',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_at_by');
    }

    public function joinedUsers()
    {
        return $this->belongsToMany(User::class, 'joined_rooms', 'room_id', 'user_id');
    }

    public function roomPoints()
    {
        return $this->hasMany(RoomPoint::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quizz_id');
    }
}
    