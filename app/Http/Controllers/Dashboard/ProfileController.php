<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ProfileUpdateNotification;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile', [
            'title' => 'My Profile',
            'user' => Auth::user()
        ]);
    }

    /** Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        //prevent other users from editing a user
        if ($id != Auth::user()->id) dd(401);
        $user = User::findOrFail($id);

        //update password if necessary
        if (!is_null($request->input('new_password'))) {

            //validate password request
            $request->validate([
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!Hash::check($value, $user->password)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    },
                ],
                'new_password' => 'required|string|min:6',
                'new_password_confirmation' => 'required|same:new_password'
            ]);

            //update password
            $user->update([
                'password' => Hash::make($request->input('new_password')),
            ]);

        }
        
        //validate request 'avatar' => 'nullable'
        $dataValid = $request->validate([
            'name' => 'required|min:4|max:30',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|max:64|unique:users,email,' . $user->id
        ]);

        //update avatar
        // if (!is_null($request->input('avatar'))) {
        //     $avatar = json_decode($request->input('avatar'));
        //     if ($avatar->input->size > 3000000) abort(500);

        //     $user->update([
        //         'avatar' => $avatar->output->image,
        //     ]);
        // } else {
        //     $user->update([
        //         'avatar' => null,
        //     ]);
        // }

        //update name and email
        $user->update($dataValid);
        $user->profileUpdateNotification();

        return redirect()->route('dashboard.profile')->with('success', 'Profile updated');
    }
}
