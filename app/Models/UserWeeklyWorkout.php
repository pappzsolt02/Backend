<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeeklyWorkout extends Model
{
    use HasFactory;

    protected $table = 'user_weekly_workouts';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'workouts_id',
        'dayOfWeek',
        'sets',
        'reps',
        'date',
    ];

    // 1 -> N
    public function user()
    {
        return $this->belongsTo(User::class, 'User_id', 'id');
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class, 'Workout_id', 'id');
    }
}
