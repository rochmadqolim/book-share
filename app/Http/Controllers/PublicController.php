<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        
        $books = Book::when($request->category, function ($query) use ($request) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        })
        ->when($request->title, function ($query) use ($request) {
            
                $query->orWhere('title', 'like', '%' . $request->title . '%');
                
            
        })
        ->get();
    
    return view('bookList', ['books' => $books, 'categories' => $categories]);
    }

}