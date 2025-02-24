<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    //Get all workouts with pagination
    public function workouts(Request $request)
    {
        // Define how many records you want to display on a page
        $perPage = $request->input('per_page', 9);
        // Retrieve the records by paging
        $workouts = Workout::paginate($perPage);

        // Return a response
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
