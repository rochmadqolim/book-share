<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all();
        return view('category',['categories' =>$categories]);
    }

    public function add(){
        return view('categoryAdd');
    }
    
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        
        Category::create($request->all());
        return redirect('categories')->with('status','Add New Category Successfully');
    }
}