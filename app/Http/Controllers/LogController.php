<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){

        $rentLogs = RentLogs::with(['user','book'])->get();
        return view('log', ['rent_logs' => $rentLogs]);
    }
}