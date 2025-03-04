<?php

namespace App\Http\Controllers;

use App\Models\UserWeeklyFood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserWeeklyFoodsController extends BaseController
{
    public function index()
    {
        $userWeeklyFoods = UserWeeklyFood::where('user_id', Auth::id())->get();
        return $this->sendResponse($userWeeklyFoods, 'Adatok elküldve');
    }

    //Post a user weekly food entry
    public function store(Request $request)
    {
        $user = Auth::user();

        // Define and validate the input data
        $input = $request->all();
        $validator = Validator::make($input, [
            'foods_id' => 'required|exists:foods,id',
            'date' => 'required|date',
            'dayOfWeek' => 'required|in:Hétfő,Kedd,Szerda,Csütörtök,Péntek,Szombat,Vasárnap',
            'mealType' => 'required|in:Reggeli,Ebéd,Vacsora,Nasi',
            'time' => 'required|date_format:H:i',
            'quantity' => 'required|numeric',
            'dailyCalorieTarget' => 'required|numeric',
            'dailyProteinTarget' => 'required|numeric',
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 400);
        }

        // Add the authenticated user ID to the input data
        $input['user_id'] = $user->id;

        // Create a new user weekly food entry
        $userWeeklyFood = UserWeeklyFood::create($input);

        return $this->sendResponse($userWeeklyFood, 'Adatok sikeresen elküldve!', 201);
    }

    //Delete a user weekly food entry
    public function destroy($id)
    {
        // Find the user weekly food entry by ID
        $userWeeklyFood = UserWeeklyFood::find($id);

        // If the user weekly food entry does not exist, return an error response
        if (!$userWeeklyFood) {
            return $this->sendError('Nem található a keresett adat!', [], 404);
        }

        // Delete the user weekly food entry
        $userWeeklyFood->delete();

        // Return success response after deletion
        return $this->sendResponse([], 'Adat sikeresen törölve!', 204);
    }
}
