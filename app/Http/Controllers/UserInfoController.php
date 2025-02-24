<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends BaseController
{
    // Show current user's info
    public function index()
    {
        $userInfo = UserInfo::all();
        return $this->sendResponse($userInfo, 'Adatok elküldve');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $validator = Validator::make($input, [
            'height' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'weight' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 400);
        }
        $input['user_id'] = $user->id;
        $userInfo = UserInfo::create($input);
        return $this->sendResponse($userInfo, 'Adatok sikeresen elküldve!', 201);
    }


    // // Update the user's info
    // public function update(Request $request)
    // {
    //     $userId = Auth::id(); // Get the logged-in user ID

    //     // Validate incoming data
    //     $validator = Validator::make($request->all(), [
    //         'Height' => 'required|numeric|min:50|max:300',
    //         'Weight' => 'required|numeric|min:20|max:500',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error', $validator->errors());
    //     }

    //     $userInfo = UserInfo::where('UserID', $userId)->first();

    //     // If user info does not exist, create a new record
    //     if (!$userInfo) {
    //         $userInfo = new UserInfo();
    //         $userInfo->UserID = $userId;
    //     }

    //     // Update or create user info
    //     $userInfo->Height = $request->input('Height');
    //     $userInfo->Weight = $request->input('Weight');
    //     $userInfo->save();

    //     return $this->sendResponse($userInfo, 'User info updated successfully.');
    // }
}
