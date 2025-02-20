<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    //Get all workouts
    public function workouts()
    {
        $workouts = Workout::all();
        return response()->json($workouts);
    }

    //Get a specific workout by ID
    public function workout($id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json(['message' => 'Workout not found'], 404);
        }

        return response()->json($workout);
    }
}
