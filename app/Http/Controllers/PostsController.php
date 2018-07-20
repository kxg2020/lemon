<?php

namespace App\Http\Controllers;

use App\Model\Post;

class PostsController extends Controller
{
    //

    public function index()
    {
       $posts =  Post::with('tags','category')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $posts
        ]);
    }
}
