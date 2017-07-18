<?php

namespace App\Http\Controllers\APi;

use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    //
    public function index()
    {
        $listData = Post::all();
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $listData
        ]);
    }
    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'title'  =>  'required|unique:posts',
            'thumb'  =>  'required',
            'content'    =>  'required',
            'markdown'    =>  'required',
        ]);
        $post->title = $request->title;
        $post->thumb = $request->thumb;
        $post->cat_id = $request->cat_id;
        $post->content = $request->content;
        $post->markdown = $request->markdown;
        $post->save();
        return response()->json([
            'status'    =>  'success'
        ]);
    }
}
