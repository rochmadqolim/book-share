<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){

        return view('layouts.login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register(){

        return view('layouts.register');
    }

    public function registerPost(Request $request){

        $request->validate([
            'username' =>'required|unique:users',
            'password' =>'required',
            'phone' =>'required',
            'address' =>'required',
        ]);

       User::create($request->all());

       Session::flash('status', 'success');
       Session::flash('message','register succes, please wait admin for approval');
       return redirect('register');
    }

    public function authen(Request $request){

    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        if (Auth::user()->status != 'active') {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Session::flash('status', 'failed');
            Session::flash('message', 'Your account is not active');
            return redirect('/login');
        }

        $request->session()->regenerate();
        if (Auth::user()->role_id == 1){
            return redirect('dashboard');
        }

        if (Auth::user()->role_id == 2){
            return redirect('/');
        }
    } else {
        Session::flash('status', 'failed');
        Session::flash('message', 'Login failed. Invalid username or password');
        return redirect('/login');
    }
    }

}