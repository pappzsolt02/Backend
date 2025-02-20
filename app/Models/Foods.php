<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;

    protected $table = 'foods';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'weight',
        'calories',
        'protein',
        'carbohydrate',
        'fat',
        'type',
    ];
}
