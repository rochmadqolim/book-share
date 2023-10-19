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

class UserBookController extends Controller
{



    public function detail($slug){
        $user = User::where('slug',$slug)->first();
        return view('userDetail', ['user'=>$user]);
    }
  
    public function approved($slug){
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();
        $rent = RentLogs::where('slug', $slug)->first();
        $rent->status = 'Borrowing';
        $rent->save();
        
        return redirect('user/'.$slug)->with('status','User Approved Successfully');
    }

    public function history(){

        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();
        return view('userHistory', ['rent_logs' => $rentlogs]);
    }

}