<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\RegisterController;

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

Route::view('/dashboard', 'dashboard')->middleware('auth');

Route::view('/login', 'login')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::view('/register', 'register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', [SystemController::class, 'index']);
Route::view('/license', 'license');
Route::post('/license', [SystemController::class, 'check']);
Route::get('/{user}', [SystemController::class, 'show']);
Route::patch('/{user}', [SystemController::class, 'update']);


