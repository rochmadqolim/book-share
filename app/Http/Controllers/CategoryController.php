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

    public function edit($slug){
        $category = Category::where('slug', $slug)->first();
        return view('categoryEdit', ['category'=>$category]);
    }

    public function update(Request $request, $slug){

        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug =null;
        $category->update($request->all());
        return redirect('categories')->with('status','Category Updated Successfully');
        
    }
}