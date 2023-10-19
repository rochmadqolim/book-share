<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function bookList(){
        $books  = Book::all();
        return view('adminBookList', ['books'=> $books]);
    }

    public function bookAdd(){
        
        $categories = Category::all();
        return view('adminBookAdd',['categories' => $categories]);
    
    }

    public function bookAdded(Request $request){
        
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
        return redirect('bookList')->with('status','Add New Book Successfully');
    
    }

    public function bookUpdate($slug){
       $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('adminBookEdit', ['categories'=> $categories, 'book'=> $book]);
    }

    public function bookUpdated(Request $request, $slug){
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

        return redirect('bookList')->with('status', 'Book Updated Successfully');
    }

    public function bookDelete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('adminBookDelete', ['book' => $book]);
    }

    public function bookDeleted($slug){
        $book =Book::where('slug',$slug)->first();
        $book->delete();
        return redirect('bookList')->with('status', "Book Deleted Successfully");
    }

    public function listBookDeleted(){

        $deletedBooks = Book::onlyTrashed()->get();
        return view('adminBookRestore', ['deletedBooks' => $deletedBooks]);
        
    }

    public function restored($slug){
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('bookList')->with('status','Book Restored Successfully');
    }
}