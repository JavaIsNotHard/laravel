<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::middleware('auth') -> get('home', [HomeController::class, 'index']);

Route::get('login', [HomeController::class, 'login']) -> name('login');
Route::post('login', [HomeController::class, 'verify']);

Route::get('register', [HomeController::class, 'register']);

Route::post('register', [HomeController::class, 'store']);

Route::get('users', [HomeController::class, 'user']);

Route::get('/user/{id}', [HomeController::class, 'edit']);
Route::post('/user/{id}', [HomeController::class, 'update']);

Route::get('user/delete/{id}', [HomeController::class, 'delete']);

// Route::get('/user/{id}', [HomeController::class, 'delete']);

