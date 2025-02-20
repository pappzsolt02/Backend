<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Foods;

class FoodController extends BaseController
{
    // Get all foods
    public function foods()
    {
        $foods = Foods::all();
        return response()->json($foods);
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
