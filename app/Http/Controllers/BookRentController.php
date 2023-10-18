<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index(){

        $users = User::where('id','!=',1)->where('status', '!=', 'in active')->get();
        $books = Book::all();
        return view('bookRent',['users'=>$users, 'books'=> $books]);
    }

    public function store(Request $request){
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        if($book['status'] != 'in stock'){
            Session::flash('message', 'Buku tidak tersedia dan sedang dipinjam');
            Session::flash('alert-class','alert-danger');
            return redirect('bookRent');
        } else {
            $count =RentLogs::where('user_id', $request->user_id)->where('actual_date', null)->count();

            if($count >= 3){
                Session::flash('message', 'User sudah mencapai limit peminjaman buku');
                Session::flash('alert-class','alert-danger');
                return redirect('bookRent');
            }

            try {
                DB::beginTransaction();
                RentLogs::create($request->all());
                $book = Book::findOrFail($request->book_id);
                $book->status = 'not available';
                $book->save();
                DB::commit();

                Session::flash('message', 'Rent Book Succes!');
                Session::flash('alert-class','alert-success');
                return redirect('bookRent');   
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }        

    }

    public function return(){
        $users = User::where('id','!=',1)->where('status', '!=', 'in active')->get();
        $books = Book::all();
        return view('bookReturn',['users'=>$users, 'books'=> $books]);
    
    }

    public function returnPost(Request $request) {
        try {
            // Mencari data peminjaman buku
            $rentData = RentLogs::where('user_id', $request->user_id)
                ->where('book_id', $request->book_id)
                ->where('actual_date', null)
                ->first();
    
            if (!$rentData) {
                Session::flash('message', 'Error: Book not found or already returned.');
                Session::flash('alert-class', 'alert-danger');
                return redirect('bookReturn');
            }
    
            DB::beginTransaction();
    
            // Menyimpan data pengembalian
            $rentData->actual_date = Carbon::now()->toDateString();
            $rentData->save();
    
            // Mengubah status buku menjadi "in stock"
            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();
    
            DB::commit();
    
            Session::flash('message', 'Book Returned Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('bookReturn');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('message', 'Error: An unexpected error occurred.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('bookReturn');
        }
    }
}    