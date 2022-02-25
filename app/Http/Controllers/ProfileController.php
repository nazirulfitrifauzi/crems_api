<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePostRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class ProfileController extends Controller
{
    public function updateProfile(ProfilePostRequest $request)
    {
        $user = User::find(auth()->user()->id);

        if ($request->hasFile('avatar')) {
            $request->file('avatar')->storeAs('public/' . $user->name, 'avatar.' . $request->file('avatar')->extension());
            User::whereId(auth()->user()->id)->update([
                'avatar'  => 'storage/' . $user->name . '/avatar.' . $request->file('avatar')->extension(),
            ]);
        }

        return $this->successResponse("Avatar successfully upload", [
            'user' => new UserResource($user),
        ], 201);
    }
}
