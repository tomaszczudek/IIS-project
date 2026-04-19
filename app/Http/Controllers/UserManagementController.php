<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index() {
        return view('management/management', ['activeUsers' => User::where('active', true)->get(), 'inactiveUsers' => User::where('active', false)->get(), 'groups' => \App\Enums\UserGroupEnum::cases()]);
    }

    public function createAccount() {
        return view('management/createAccount', ['groups' => \App\Enums\UserGroupEnum::cases()]);
    }

    public function deactivate() {
        User::query()
            ->whereIn('id', request('user_ids'))
            ->where('active', true)
            ->update(['active' => false]);
    }

    public function activate() {
        User::query()
            ->whereIn('id', request('user_ids'))
            ->where('active', false)
            ->update(['active' => true]);
    }

    public function update() {
        User::query()
            ->whereId(request('id'))
            ->update([request('field') => request('value')]);
    }

    public function logAs($id) {
        Auth::loginUsingId($id);
        return redirect('/');
    }
}
