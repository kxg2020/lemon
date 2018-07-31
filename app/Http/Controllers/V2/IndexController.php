<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2018-07-30
 * Time: 11:22
 */

namespace App\Http\Controllers\V2;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Support\Facades\DB;

class IndexController
{

    public function __construct()
    {
        view()->share('nav_categorys', Category::select('cat_name')->where('is_nav', 1)->orderBy('cat_desc', 'desc')->take(4)->get()->toArray());
    }

    public function index()
    {
        $posts = Post::with(['tags' => function ($query){
            $query->select('tag_name');
        }, 'category'])->orderBy('created_at', 'desc')->simplePaginate(5);
        return view('v2.posts', ['posts' => $posts]);
    }

    public function tag($tag_name)
    {
        $tag = Tag::where('tag_name', $tag_name)->first();
        !empty($tag) ?: abort(404, "404 NOT FOUND.");

        $posts = $tag->posts()->with(['tags' => function ($query){
            $query->select('tag_name');
        }, 'category'])->orderBy('created_at', 'desc')->simplePaginate(5);
        return view('v2.posts', ['posts' => $posts, 'tag_name' => $tag_name]);
    }

    public function category($cat_name)
    {
        $catetory = Category::where('cat_name', $cat_name)->first();
        !empty($catetory) ?: abort(404, "404 NOT FOUND.");

        $posts = $catetory->posts()->with(['tags' => function ($query){
            $query->select('tag_name');
        }, 'category'])->orderBy('created_at', 'desc')->simplePaginate(5);
        return view('v2.posts', ['posts' => $posts, 'cat_name' => $cat_name]);
    }

    public function post($id, $slug)
    {
        $post = Post::with('tags', 'category')->find($id);
        if ($post) {
            DB::table('posts')->where('id', $id)->increment('views');
            return view('v2.post', ['post' => $post]);
        }else {
            abort(404);
        }
    }

    public function post_slug($slug)
    {
        $post = Post::with('tags', 'category')->where('slug', $slug)->first();
        if ($post) {
            DB::table('posts')->where('slug', $slug)->increment('views');
            return view('v2.post', ['post' => $post]);
        }else {
            abort(404);
        }
    }
}