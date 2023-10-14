<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
    return view('profile');
    }

    public function index(){
        $users = User::where('role_id',2)->where('status', 'active')->get();
        return view('user',['users'=>$users]);
    }

    public function registeredUser(){
        $users = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('unregistered',['users'=>$users]);
    }

    public function detail($slug){
        $user = User::where('slug',$slug)->first();
        return view('userDetail', ['user'=>$user]);
    }
  
    public function approved($slug){
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        
        return redirect('user/'.$slug)->with('status','User Approved Successfully');
    }

    public function delete($slug){
        $user = User::where('slug', $slug)->first();
        return view('userBan',['user'=>$user]);
    }

    public function destroy($slug){
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('users')->with('status','User Deleted Successfully');
    }

    public function banned() {
        $usersbanned = User::onlyTrashed()->get();
        return view('userDeleted', ['usersbanned' => $usersbanned]);
    }

    public function restore($slug){
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        return redirect('users')->with('status','User Restored Successfully');
    }
}