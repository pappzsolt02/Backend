<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foods;

class FoodController extends BaseController
{
    // Get all foods
    public function foods(Request $request)
    {
        try {
            // Oldalankénti elemek száma
            $perPage = $request->input('per_page', 12);
            $page = $request->input('page', 1);

            // Lekérdezés építése
            $query = Foods::query();

            $foods = $query
                ->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'data' => $foods->items(),
                'pagination' => [
                    'current_page' => $foods->currentPage(),
                    'per_page' => $foods->perPage(),
                    'total' => $foods->total(),
                    'last_page' => $foods->lastPage(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hiba történt az adatok lekérésekor'], 500);
        }
    }

    // Get a specific food by type
    public function food($type)
    {
        $food = Foods::where('type', $type)->get();

        if ($food->isEmpty()) {
            return response()->json(['message' => 'Nincs ilyen típusú étel'], 404);
        }

        return response()->json($food);
    }
}
