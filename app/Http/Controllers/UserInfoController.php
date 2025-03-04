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

    // Update the user info using PUT method
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'height' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'weight' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $userInfo = UserInfo::find($id);
        if (!$userInfo) {
            return $this->sendError('A felhasználói adatok nem találhatóak', [], 404);
        }

        // Frissítési adatok meghatározása csak a benyújtott mezők alapján
        $updateData = [];
        if ($request->filled('height')) {
            $updateData['height'] = $request->input('height');
        }
        if ($request->filled('weight')) {
            $updateData['weight'] = $request->input('weight');
        }

        // Felhasználói adatok frissítése
        $userInfo->update($updateData);

        return $this->sendResponse($userInfo, 'Adatok sikeresen frissítve!');
    }
}
