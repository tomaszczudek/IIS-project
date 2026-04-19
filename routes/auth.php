<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/processLogin', [UserController::class, 'processLogin']);
    Route::post('/processRegister', [UserController::class, 'processRegister']);
});
