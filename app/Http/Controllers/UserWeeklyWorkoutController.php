<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserWeeklyWorkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserWeeklyWorkoutController extends BaseController
{
    public function index()
    {
        $userWeeklyWorkouts = UserWeeklyWorkout::where('user_id', Auth::id())->get();
        return $this->sendResponse($userWeeklyWorkouts, 'Adatok elküldve');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Define and validate the input data
        $input = $request->all();
        $validator = Validator::make($input, [
            'workouts_id' => 'required|exists:workouts,id',
            'dayOfWeek' => 'required|in:Hétfő,Kedd,Szerda,Csütörtök,Péntek,Szombat,Vasárnap',
            'sets' => 'required|numeric',
            'reps' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Add the authenticated user ID to the input data
        $input['user_id'] = $user->id;

        // Create a new user weekly workout entry
        $userWeeklyWorkout = UserWeeklyWorkout::create($input);


        return $this->sendResponse($userWeeklyWorkout, 'Adatok sikeresen elküldve!', 201);
    }

    //Delete a user weekly workout entry
    public function destroy($id)
    {
        // Find the user weekly food entry by ID
        $userWeeklyWork = UserWeeklyWorkout::find($id);

        // If the user weekly food entry does not exist, return an error response
        if (!$userWeeklyWork) {
            return $this->sendError('Nem található a keresett adat!', [], 404);
        }

        // Delete the user weekly food entry
        $userWeeklyWork->delete();

        // Return success response after deletion
        return $this->sendResponse([], 'Adat sikeresen törölve!', 204);
    }
}
