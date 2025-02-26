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
        $foods = Foods::paginate($perPage);

        // Return a response
        return response()->json($foods);
    }

    // // Get a specific food by type
    public function food($type)
    {
        $food = Foods::where('type', $type)->get();

        if (!$food->empty()) {
            return response()->json(['message' => 'Nincs ilyen típusú étek'], 404);
        }

        return response()->json($food);
    }
}
