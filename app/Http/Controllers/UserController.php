<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function rent(){

        $users = Auth::user();
        
        $books = Book::where('status','!=','not available')->get();
        return view('userRentBook',['users'=>$users, 'books'=> $books]);
    }

    public function userRent(Request $request){
        
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();
        $book = Book::findOrFail($request->book_id)->only('status');
        
        if($book['status'] != 'in stock'){
            Session::flash('message', 'Buku tidak tersedia dan sedang dipinjam');
            Session::flash('alert-class','alert-danger');
            return redirect('userRent');
        } else {
            $count =RentLogs::where('user_id', $request->user_id)->where('actual_date', null)->count();

            if($count >= 3){
                Session::flash('message', 'Sudah mencapai limit peminjaman buku');
                Session::flash('alert-class','alert-danger');
                return redirect('userRent');
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
                return redirect('userRent');   
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }        

    }

    public function history(){    
    $rentLogs = RentLogs::with(['user','book'])->get();
    return view('userRentLogs', ['rent_logs' => $rentLogs]);
    }

}