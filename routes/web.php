<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogController;

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
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('admin');
    Route::get('profile', [UserController::class, 'profile'])->middleware('client');
    Route::get('books', [BookController::class, 'index']);
    
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categoryAdd', [CategoryController::class, 'add']);
    Route::post('categoryAdd', [CategoryController::class, 'store']);
    Route::get('categoryEdit/{slug}', [CategoryController::class, 'edit']);
    Route::put('categoryEdit/{slug}', [CategoryController::class, 'update']);
    
    Route::get('users', [UserController::class, 'index']);
    Route::get('logs', [LogController::class, 'index']);
});