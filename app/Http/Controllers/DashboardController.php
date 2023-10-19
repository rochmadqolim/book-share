<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentLogs = RentLogs::with(['user','book'])->get();
        return view('dashboard',['rent_logs' => $rentLogs,'book_count'=> $bookCount, 'category_count'=> $categoryCount, 'user_count'=>$userCount]);
    }
}