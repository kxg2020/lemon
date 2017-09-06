<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        view()->share('categorys', Category::select('id', 'cat_name')->where('is_nav', 1)->orderBy('cat_desc', 'desc')->get()->toArray());
        view()->share('tags', Tag::select('id', 'tag_name')->orderBy('click', 'desc')->get()->toArray());
        view()->share('posts_hot', Post::select('id', 'slug', 'title', 'created_at')->orderBy('created_at', 'desc')->take(3)->get()->toArray());
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('tags','category')->orderBy('created_at', 'desc')->paginate(5);
        return view('home', ['posts' => $posts]);
    }

    /**
     *
     * @param $tag_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag($tag_id)
    {
        $tag = Tag::find($tag_id);
        !empty($tag) ?: abort(404, "404 NOT FOUND.");

        $posts = $tag->posts()->with('tags', 'category')->orderBy('created_at', 'desc')->paginate(5);
        return view('home', ['posts' => $posts, 'tag_id' => $tag_id]);
    }

    /**
     * @param $cat_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($cat_id)
    {
        $category = Category::find($cat_id);
        !empty($category) ?: abort(404, "404 NOT FOUND.");

        $posts = $category->posts()->with('tags','category')->orderBy('created_at', 'desc')->paginate(5);
        return view('home', ['posts' => $posts, 'cat_id' => $cat_id]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($slug){
        if($post_str = Redis::get('post:'.$slug)){
            $post = unserialize($post_str);
        }else {
            $post = Post::where('slug', $slug)->first();
            !empty($post) ?: abort(404, "404 NOT FOUND.");

            $post = Post::with('tags', 'category')->find($post->id)->toArray();
            Redis::set('post:'.$slug, serialize($post));
        }
        return view('post', ['post' => $post]);
    }
}
