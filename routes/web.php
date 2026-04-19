<?php

use App\Enums\UserGroupEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanovaniController;
use App\Http\Controllers\OsetreniController;
use App\Http\Controllers\SpravaRadkuController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\NakupyController;
use App\Http\Controllers\VinoController;
use App\Http\Controllers\KosikController;
use App\Http\Controllers\SklizenController;
use App\Http\Controllers\UserController;

//Vsichni
Route::middleware('active')->group(function () {

Route::get('/', [VinoController::class, 'nabidka']);
Route::get('/nabidka/seznam', [VinoController::class, 'nabidka']);
Route::get('/nabidka/detail-{id}', [VinoController::class, 'nabidka_detail']);
Route::get('/kosik', [KosikController::class, 'zobraz']);
Route::post('/kosik/pridej', [KosikController::class, 'pridej']);
Route::post('/kosik/odeber-{id}', [KosikController::class, 'odeber']);
Route::post('/kosik/zmena', [KosikController::class, 'zmena_poctu']);
Route::post('/kosik/vytvorit-nakup', [KosikController::class, 'vytvorit_nakup']);

Route::middleware('auth')->group(function () {
    // Registrovany uzivatel
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/nakupy/seznam', [NakupyController::class, 'nakupy']);
    Route::get('/nakupy/detail-{id}', [NakupyController::class, 'nakup_detail']);

    // Vinar
    Route::middleware('group:'.UserGroupEnum::WINEMAKER->value)->group(function () {
        Route::get('/planovat', [PlanovaniController::class, 'planovat']);
        Route::post('/planovat/evidovat', [PlanovaniController::class, 'planovat_post']);
        Route::get('/planovat/list', [PlanovaniController::class, 'list']);
        Route::get('/radky', [SpravaRadkuController::class,'radky']);
        Route::post('/radky/detail', [SpravaRadkuController::class,'radky_detail']);
        Route::post('/radky/update', [SpravaRadkuController::class,'radky_update']);
        Route::post('/vyroba/store', [VinoController::class, 'store']);
        Route::get('/vino/seznam', [VinoController::class, 'vino']);
        Route::get('/vino/detail-{id}', [VinoController::class, 'vino_detail']);
        Route::get('/vino/edit-{id}', [VinoController::class, 'edit']);
        Route::post('/vino/update-{id}', [VinoController::class, 'update']);
        Route::get('/vino/stahnout-{id}', [VinoController::class, 'stahnout']);
    });

    // Robotnik
    Route::middleware('group:'.UserGroupEnum::WORKER->value)->group(function () {
        Route::get('/osetreni', [OsetreniController::class, 'osetreni']);
    });

    // Robotnik a Vinar
    Route::middleware('group:'.UserGroupEnum::WINEMAKER->value.','.UserGroupEnum::WORKER->value)->group(function () {
        Route::post('/osetreni/detail', [OsetreniController::class, 'detail']);
        // akce_done resi i logiku detailu a zruseni cinnosti
        Route::post('/osetreni/mark-done', [OsetreniController::class, 'akce_done']);

        Route::get('/sklizen/seznam', [SklizenController::class, 'sklizen']);
        Route::get('/sklizen/detail-{id}', [SklizenController::class, 'detail']);
        Route::post('/sklizen/create', [SklizenController::class, 'create']);
        Route::post('/sklizen/store', [SklizenController::class, 'store']);
        Route::get('/sklizen/edit-{id}', [SklizenController::class, 'edit']);
        Route::post('/sklizen/update-{id}', [SklizenController::class, 'update']);
    });

    // Admin
    Route::middleware('group:'.UserGroupEnum::ADMIN->value)->group(function () {
        Route::post('/adminRegister', [UserController::class, 'processRegister']);
        Route::get('/management', [UserManagementController::class, 'index']);
        Route::get('/createAccount', [UserManagementController::class, 'createAccount']);
        Route::post('/user/deactivate', [UserManagementController::class, 'deactivate']);
        Route::post('/user/activate', [UserManagementController::class, 'activate']);
        Route::post('/user/update', [UserManagementController::class, 'update']);
        Route::get('/logAs/{userId}', [UserManagementController::class, 'logAs']);
    });
});
});

require __DIR__.'/auth.php';
