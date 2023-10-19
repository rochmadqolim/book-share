<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(){
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentLogs = RentLogs::with(['user','book'])->get();
        return view('adminDashboard',['rent_logs' => $rentLogs,'book_count'=> $bookCount, 'category_count'=> $categoryCount, 'user_count'=>$userCount]);
    }

    public function userList(){
        $users = User::where('role_id',2)->where('status', 'active')->get();
        return view('adminUserList',['users'=>$users]);
    }

    public function unActivatedList(){
        $users = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('adminUserUnActive',['users'=>$users]);
    }
 
    public function approved($slug){
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        
        return redirect('user/'.$slug)->with('status','User Approved Successfully');
    }
    
    

    public function activated(Request $request) {
        $slug = $request->input('slug');
    
        $user = User::where('slug', $slug)->first();
    
        if ($user) {
            $user->status = 'active';
            $user->save();
    
            return redirect('userList')->with('status', 'User Approved Successfully');
        } else {
            return abort(404);
        }
    }
    

    public function bannedList() {
        $usersbanned = User::onlyTrashed()->get();
        return view('adminUserBanned', ['usersbanned' => $usersbanned]);
    }
    
    public function detail($slug){
        $user = User::where('slug',$slug)->first();
        return view('adminUserDetail', ['user'=>$user]);
    }
    
    
    public function deleteView($slug){
        $user = User::where('slug', $slug)->first();
        return view('adminUserBann',['user'=>$user]);
    }

    public function deleted($slug){
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('userList')->with('status','User Deleted Successfully');
    }


    public function restoreUser($slug){
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        return redirect('userList')->with('status','User Restored Successfully');
    }
    
    public function userAdd(){
    
        $roles = Role::all();
        return view('adminUserCreate',['roles'=> $roles]);
    }

    public function userAdded(Request $request){
        
        $request->validate([
            'username' =>'required|unique:users',
            'password' =>'required',
            'phone' =>'required',
            'address' =>'required',
        ]);
        $request['status'] ='active';
        User::create($request->all());

       Session::flash('status', 'success');
       Session::flash('message','Create User Successfullly');
       return redirect('userList');
    }
    
}