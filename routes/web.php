<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::middleware('guest_only')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authen']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerPost']);
});

Route::middleware('auth')->group(function(){
    Route::get('logout',[AuthController::class, 'logout']);
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth','admin']);
    Route::get('profile', [UserController::class, 'profile'])->middleware(['auth', 'client']);
    Route::get('books', [BookController::class, 'index'])->middleware('auth');
});