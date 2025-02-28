<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    //Get all workouts with pagination
    public function workouts(Request $request)
    {
        try {
            // Oldalakénti elemek száma
            $perPage = $request->input('per_page', 9);
            $page = $request->input('page', 1);

            // Lezárdezés építése
            $query = Workout::query();

            $workouts = $query
                ->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'data' => $workouts->items(),
                'pagination' => [
                    'current_page' => $workouts->currentPage(),
                    'per_page' => $workouts->perPage(),
                    'total' => $workouts->total(),
                    'last_page' => $workouts->lastPage(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error while fetching data'], 500);
        }
    }

    //Get a specific workout by Muscle Group
    public function workout($muscleGroup)
    {
        $workout = Workout::where('muscleGroup', $muscleGroup)->get();

        if ($workout->isEmpty()) {
            return response()->json(['message' => 'No workout found for this muscle group'], 404);
        }

        return response()->json($workout);
    }
}
