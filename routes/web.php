<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/check-username', [AuthController::class, 'checkUsername']);
Route::post('/check-email', [AuthController::class, 'checkEmail']);
Route::post('/check-login', [AuthController::class, 'login']);

Route::post('/confirm-registration', [AuthController::class, 'confirmRegistration']);
Route::post('/confirm-login', [AuthController::class, 'confirmLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/news-data', [NewsController::class, 'getNewsData']);
Route::get('/players-data', [AccountController::class, 'getCharacters']);
Route::get('/auth-data', [AccountController::class, 'getAuth']);

Route::middleware('auth')->group(function () {

    Route::get('/private', function(){
        return redirect()->to('/login');
    });

});

Route::fallback(function(){
    return redirect()->to('/');
});

Route::get('{any?}', fn () => view('app'))->where('any', '.*');
