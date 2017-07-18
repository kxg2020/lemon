<?php

namespace App\Http\Controllers\Api;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorysController extends Controller
{
    //

    public function index()
    {
        $listData = Category::all();
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $listData
        ]);
    }

    public function store(Category $category, Request $request)
    {
        $this->validate($request, [
            'cat_name'  =>  'required|unique:categorys|max:255',
            'cat_desc'  =>  'required|min:1',
            'is_nav'    =>  'in:0,1'
        ]);
        $category->cat_name = $request->cat_name;
        $category->cat_desc = $request->cat_desc;
        $category->is_nav = $request->is_nav;
        $category->save();
        return response()->json([
            'status'    =>  'success'
        ]);
    }
}
