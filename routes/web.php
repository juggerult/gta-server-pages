<?php

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

Route::get('{any?}', fn () => view('app'))->where('any', '.*');



Route::post('/check-username', [AuthController::class, 'checkUsername']);
Route::post('/check-email', [AuthController::class, 'checkEmail']);
Route::post('/confirm-registration', [AuthController::class, 'confirmRegistration']);
Route::post('/confirm-login', [AuthController::class, 'confirmLogin']);


Route::get('/login')->name('login');
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/news-data', [NewsController::class, 'getNewsData']);

Route::prefix('user')->middleware('auth')->group(function () {

    Route::get('/private');

});
