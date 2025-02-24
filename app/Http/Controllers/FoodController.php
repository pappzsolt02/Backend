<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Foods;

class FoodController extends BaseController
{
    // Get all foods
    public function foods(Request $request)
    {
        // Define how many records you want to display on a page
        $perPage = $request->input('per_page', 12);

        // Retrieve the records by paging
        $workouts = Foods::paginate($perPage);

        // Return a response
        return response()->json($workouts);
    }

    // // Get a specific food by ID
    public function food($id)
    {
        $food = Foods::find($id);

        if (!$food) {
            return response()->json(['message' => 'Food not found'], 404);
        }

        return response()->json($food);
    }
}
