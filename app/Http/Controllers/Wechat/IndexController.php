<?php

namespace App\Http\Controllers\Wechat;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function posts()
    {
        return response()->json(['posts' => Post::select('id', 'cat_id', 'slug', 'title', 'created_at')->with('tags','category')->orderBy('created_at', 'desc')->get()->toArray()]);
    }

    public function categorys()
    {
        return response()->json(['cstagorys' => Category::select('id', 'cat_name')->where('is_nav', 1)->orderBy('cat_desc', 'desc')->get()->toArray()]);
    }

    public function tags()
    {
        return response()->json(['tags' => Tag::select('id', 'tag_name')->orderBy('click', 'desc')->get()->toArray()]);
    }

    public function post($post_id)
    {
        return response()->json(['post' => $post = Post::with('tags', 'category')->find($post_id)->toArray()]);
    }

}