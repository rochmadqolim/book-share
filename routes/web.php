<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogController;
use App\Models\Category;

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
    Route::get('bookAdd', [BookController::class, 'add']);
    Route::post('bookAdd', [BookController::class, 'create']);
    Route::get('bookEdit/{slug}', [BookController::class, 'edit']);
    Route::post('bookEdit/{slug}', [BookController::class, 'update']);
    Route::get('bookDelete/{slug}', [BookController::class, 'delete']);
    Route::get('bookDestroy/{slug}', [BookController::class, 'destroy']);
    Route::get('bookRestore',[BookController::class, 'deletedBook']);
    Route::get('bookRestored/{slug}',[BookController::class, 'restore']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categoryAdd', [CategoryController::class, 'add']);
    Route::post('categoryAdd', [CategoryController::class, 'store']);
    Route::get('categoryEdit/{slug}', [CategoryController::class, 'edit']);
    Route::put('categoryEdit/{slug}', [CategoryController::class, 'update']);
    Route::get('categoryDelete/{slug}', [CategoryController::class, 'delete']);
    Route::get('categoryDestroy/{slug}', [CategoryController::class, 'destroy']);
    Route::get('categoryRestore',[CategoryController::class, 'deletedCategory']);
    Route::get('categoryRestored/{slug}',[CategoryController::class, 'restore']);
    
    Route::get('users', [UserController::class, 'index']);
    Route::get('unregistered', [UserController::class, 'registeredUser']);
    Route::get('user/{slug}', [UserController::class, 'detail']);
    Route::get('userApproved/{slug}', [UserController::class, 'approved']);
    Route::get('userBan/{slug}', [UserController::class, 'delete']);
    Route::get('userBanned/{slug}', [UserController::class, 'destroy']);
    Route::get('bannedList', [UserController::class, 'banned']);
    Route::get('userRestore/{slug}', [UserController::class, 'restore']);

    Route::get('logs', [LogController::class, 'index']);
});