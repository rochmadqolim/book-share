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

        $users = User::where('id','!=',1)->get();
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
}