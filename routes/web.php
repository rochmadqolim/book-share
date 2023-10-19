<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserBookController;
use App\Models\Category;
use App\Models\RentLogs;

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

Route::get('/',[PublicController::class,'index']);

Route::middleware('guest_only')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authen']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerPost']);
});

Route::middleware('auth')->group(function(){
    Route::get('userRent',[UserController::class,'rent']);
    Route::post('userRent',[UserController::class,'userRent']);
    Route::get('userHistory', [UserController::class, 'history']);
    Route::get('logout',[AuthController::class, 'logout']);
    
    Route::middleware('admin')->group(function(){
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('userList', [AdminController::class, 'userList']);
        Route::get('unActivatedList', [AdminController::class, 'unActivatedList']);
        Route::post('activated', [AdminController::class, 'activated']);
        Route::get('userApproved/{slug}', [AdminController::class, 'approved']);
        Route::get('bannedList', [AdminController::class, 'bannedList']);
        Route::get('user/{slug}', [AdminController::class, 'detail']);
        Route::get('userBann/{slug}', [AdminController::class, 'deleteView']);
        Route::get('userBanned/{slug}', [AdminController::class, 'deleted']);
        Route::get('userRestore/{slug}', [AdminController::class, 'restoreUser']);
        Route::get('userAdd', [AdminController::class, 'userAdd']);
        Route::post('userAdd', [AdminController::class, 'userAdded']);

        Route::get('bookList', [BookController::class, 'bookList']);
        Route::get('bookAdd', [BookController::class, 'bookAdd']);
        Route::post('bookAdded', [BookController::class, 'bookAdded']);
        Route::get('bookUpdate/{slug}', [BookController::class, 'bookUpdate']);
        Route::post('bookUpdate/{slug}', [BookController::class, 'bookUpdated']);
        Route::get('bookDelete/{slug}', [BookController::class, 'bookDelete']);
        Route::get('bookDeleted/{slug}', [BookController::class, 'bookDeleted']);
        Route::get('bookRestore',[BookController::class, 'listBookDeleted']);
        Route::get('bookRestored/{slug}',[BookController::class, 'restored']);
        
        Route::get('categoryList', [CategoryController::class, 'categoryList']);
        Route::get('categoryAdd', [CategoryController::class, 'categoryAdd']);
        Route::post('categoryAdd', [CategoryController::class, 'categoryAdded']);
        Route::get('categoryUpdate/{slug}', [CategoryController::class, 'categoryUpdate']);
        Route::put('categoryUpdate/{slug}', [CategoryController::class, 'categoryUpdated']);
        Route::get('categoryDelete/{slug}', [CategoryController::class, 'categoryDelete']);
        Route::get('categoryDeleted/{slug}', [CategoryController::class, 'categoryDeleted']);
        Route::get('categoryRestore',[CategoryController::class, 'listCategoryDeleted']);
        Route::get('categoryRestored/{slug}',[CategoryController::class, 'restored']);
        
        Route::get('rentList',[RentController::class,'rentList']);
        Route::post('rentList',[RentController::class,'bookReturn']);
        Route::get('bookRent',[RentController::class,'bookRentForm']);
        Route::post('bookRent',[RentController::class,'bookRent']);
        
    });
});