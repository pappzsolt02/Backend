<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends BaseController
{
    // Show current user's info
    public function show()
    {
        $userId = Auth::id(); // Get the logged-in user ID
        $userInfo = UserInfo::where('UserID', $userId)->first(); // Assuming UserID is the foreign key

        if (!$userInfo) {
            return $this->sendError('User information not found.');
        }

        return $this->sendResponse($userInfo, 'User info retrieved successfully.');
    }

    // Update the user's info
    public function update(Request $request)
    {
        $userId = Auth::id(); // Get the logged-in user ID

        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'Height' => 'required|numeric|min:50|max:300',
            'Weight' => 'required|numeric|min:20|max:500',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $userInfo = UserInfo::where('UserID', $userId)->first();

        // If user info does not exist, create a new record
        if (!$userInfo) {
            $userInfo = new UserInfo();
            $userInfo->UserID = $userId;
        }

        // Update or create user info
        $userInfo->Height = $request->input('Height');
        $userInfo->Weight = $request->input('Weight');
        $userInfo->save();

        return $this->sendResponse($userInfo, 'User info updated successfully.');
    }

    // Delete user info
    public function destroy()
    {
        $userId = Auth::id(); // Get the logged-in user ID
        $userInfo = UserInfo::where('UserID', $userId)->first();

        if (!$userInfo) {
            return $this->sendError('User information not found.');
        }

        $userInfo->delete();

        return $this->sendResponse([], 'User info deleted successfully.');
    }
}

