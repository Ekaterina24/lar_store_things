<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getSignup() {
        return view('auth.signup');
    }

    public function postSignup(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'username' => ['required', 'string', 'unique:users', 'max:20'],
            'password' => ['required', 'min:6']
        ]);

        User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect(route('home'))->with('info', 'Вы успешно зарегистрировались! Можно войти на сайт.');
    }

    public function getSignin() {
        return view('auth.signin');
    }

    public function postSignin(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'min:6']
        ]);

        if (auth('web')->attempt($data)) {
            return redirect(route('home'))->with('info', 'Вы вошли на сайт.');
        }

        return redirect(route('auth.signin'))->with('info', 'Неправильный логин или пароль.');
    }

    public function getSignout() {
        auth('web')->logout(); //разлогинит текущюю сессию пользователя
        return redirect(route('welcome'));
    }
}
