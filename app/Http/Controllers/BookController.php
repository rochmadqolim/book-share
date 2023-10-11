<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books  = Book::all();
        return view('book', ['books'=> $books]);
    }

    public function add(){
        
        $categories = Category::all();
        return view('bookAdd',['categories' => $categories]);
    
    }

    public function create(Request $request){
        
        $request->validate([
            'title' => 'required',
            'book_code' => 'required|unique:books',
        ]);

        $newname = '';
        if ($request->file('image')) {
            $extendsion = $request->file('image')->getClientOriginalExtension();
            $newname = $request->title.'-'.now()->timestamp.'-'.$extendsion;
            $request->file('image')->storeAs('cover', $newname);
        }
        
        $request['cover'] =$newname;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status','Add New Book Successfully');
    
    }

    public function edit($slug){
       $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('bookEdit', ['categories'=> $categories, 'book'=> $book]);
    }

    public function update(Request $request, $slug){
        if ($request->file('image')) {
            $extendsion = $request->file('image')->getClientOriginalExtension();
            $newname = $request->title.'-'.now()->timestamp.'-'.$extendsion;
            $request->file('image')->storeAs('cover', $newname);
            $request['cover'] =$newname;
        }

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'Book Updated Successfully');
    }
}