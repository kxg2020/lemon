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

    public function info($id)
    {
        $post = Post::with([
            'category' => function($query){
                $query->select("id", "cat_name");
            },
            'tags' => function($query){
                $query->select("tag_id", "tag_name");
            }
        ])->find($id);
        if ($post) {
            return response()->json([
                'status'    =>  'success',
                'data'      =>  $post
            ]);
        }else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Not Find.'
            ]);
        }
    }
}
