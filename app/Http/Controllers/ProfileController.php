<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($username) {
        $user = User::where('username', $username)->first();
        if (!$user) {
            abort(404);
        }
        return view('profile.index', compact('user'));
    }

    public function getEdit() {
        return view('profile.edit');
    }

    public function postEdit(Request $request) {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required', 'min:6']
        ]);

        Auth::user()->update([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect(route('profile.edit'))->with('info', 'Профиль успешно обновлен!');
    }
}
