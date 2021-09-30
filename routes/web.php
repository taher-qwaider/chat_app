<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('')->middleware('auth:user')->group(function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/dashboard', function () {
        $users = \App\Models\User::all();
        return view('page', [
            'users' =>$users
        ]);
    })->name('dashboard');

    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::get('logout', [\App\Http\Controllers\auth\AuthController::class, 'logout'])->name('logout');
});


Route::prefix('')->middleware('guest')->group(function (){
    Route::get('login', [\App\Http\Controllers\auth\AuthController::class, 'view'])->name('login');
    Route::post('login', [\App\Http\Controllers\auth\AuthController::class, 'login']);
});
