<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeeklyFood extends Model
{
    use HasFactory;

    protected $table = 'user_weekly_foods';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'foods_id',
        'date',
        'dayOfWeek',
        'mealType',
        'time',
        'quantity',
        'dailyCalorieTarget',
        'dailyProteinTarget'
    ];

    // 1 -> N
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id', 'id');
    }
}
