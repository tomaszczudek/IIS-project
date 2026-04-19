<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Enums\UserGroupEnum;

class UserController extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function processLogin() {
        if (! Auth::attempt(['email' => request('email'), 'password' => request('password'), 'active' => true])) {
            Session::flash('error', 'Špatný email nebo heslo');
            return redirect('login');
        }
        Session::flash('status', 'logged');
        Session::regenerate();

        return redirect('/');
    }

    public function processRegister() {

        if (!(Auth::user() && Auth::user()->group == UserGroupEnum::ADMIN) && (request('password') !== request('password_repeat'))) {
            Session::flash('error', 'Hesla se neshodují');
            return redirect('register');
        }

        $group = UserGroupEnum::tryFrom(request('group'));

        if (Auth::user() && !$group) {
            return false;
        } elseif(!Auth::user()) {
            $group = UserGroupEnum::CUSTOMER;
        }

        // Někdo kdo není admin se chce zaregistrovat pod ne-zákaznákem
        if(!(Auth::user() && Auth::user()->group == UserGroupEnum::ADMIN) && $group != UserGroupEnum::CUSTOMER) {
            return false;
        }

        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->group = $group;
        $user->email_verified_at = now();
        $user->save();

        if (!Auth::user()) {
            Auth::login($user);
        }

        return redirect('/');
    }

    public function logout() {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
