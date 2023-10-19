<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList(){

        $categories = Category::all();
        return view('adminCategoryList',['categories' =>$categories]);
    }

    public function categoryAdd(){
        return view('adminCategoryAdd');
    }
    
    public function categoryAdded(Request $request){
        
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        
        Category::create($request->all());
        return redirect('categoryList')->with('status','Add New Category Successfully');
    }

    public function categoryUpdate($slug){
        $category = Category::where('slug', $slug)->first();
        return view('adminCategoryUpdate', ['category'=>$category]);
    }

    public function categoryUpdated(Request $request, $slug){

        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug =null;
        $category->update($request->all());
        return redirect('categoryList')->with('status','Category Updated Successfully');
        
    }

    public function categoryDeleted($slug){
        $category =Category::where('slug',$slug)->first();
        $category->delete();
        return redirect('categoryList')->with('status', "category Deleted Successfully");
    }

    public function listCategoryDeleted(){

        $deletedList = Category::onlyTrashed()->get();
        return view('adminCategoryRestoreList', ['deletedCategories' => $deletedList]);
        
    }

    public function restored($slug){
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('categoryList')->with('status','Category Restored Successfully');
    }
}