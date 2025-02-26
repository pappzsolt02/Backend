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
        'food_id',
        'date',
        'dayOfWeek',
        'mealType',
        'time',
        'quantity',
        'dailyCalorieTarget',
        'dailyProteinTarget'
    ];
}
