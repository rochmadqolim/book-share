<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RentController extends Controller
{
    public function rentList(){
        
        $rentLogs = RentLogs::with(['user','book'])->where('actual_date', null)->get();
        return view('adminRentList',['rent_logs' => $rentLogs]);
    }

    public function bookRentForm(){

        $users = User::where('id','!=',1)->where('status', '!=', 'in active')->get();
        
        $books = Book::where('status','!=','not available')->get();
        return view('adminBookRent',['users'=>$users, 'books'=> $books]);
    }

    public function bookRent(Request $request){
        
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
    
    
    
    public function bookReturn(Request $request) {
        $user_id = $request->input('user_id');
        $book_id = $request->input('book_id');
        
        try {
            DB::beginTransaction();
    
            $rentData = RentLogs::where('user_id', $user_id)
                ->where('book_id', $book_id)
                ->firstOrFail();
    
            $rentData->actual_date = Carbon::now()->toDateString();
            $rentData->save();
            
    
            $book = Book::findOrFail($book_id);
            $book->status = 'in stock';
            $book->save();

            $rentData->status = 'Returned';
        $rentData->save();
    
            DB::commit();
    
            Session::flash('message', 'Book Returned Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('rentList');
        } catch (ModelNotFoundException $ex) {
            DB::rollBack();
            Session::flash('message', 'Error: Book not found or user has not borrowed this book.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('rentList');
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('message', 'Error: An unexpected error occurred.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('rentList');
        }
    }


}