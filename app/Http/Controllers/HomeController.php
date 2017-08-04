<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->getPosts();
        return view('home', ['posts' => $posts]);
    }

    /**
     *
     * @param $tag_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag($tag_id)
    {
        $tag = Tag::where('id', $tag_id)->first();
        !empty($tag) ?: abort(404, "404 NOT FOUND.");
        $posts = $this->getPosts(null, null, $tag_id);
        return view('home', ['posts' => $posts, 'tag_id' => $tag_id]);
    }

    /**
     * @param $cat_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($cat_id)
    {
        $category = Category::where('id', $cat_id)->first();
        !empty($category) ?: abort(404, "404 NOT FOUND.");

        $posts = $this->getPosts(null, $cat_id, null);
        return view('home', ['posts' => $posts, 'cat_id' => $cat_id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($id){
        $post = Post::where('id', $id)->first();
        !empty($post) ?: abort(404, "404 NOT FOUND.");

        $post = $this->getPosts($id, null, null);
        return view('post', ['post' => $post]);
    }

    /**
     * @param null $post_id
     * @param null $cat_id
     * @param null $tag_id
     * @return array
     */
    protected function getPosts($post_id = null, $cat_id = null, $tag_id = null)
    {
        $post =  Post::with([
            'tags'  =>  function($query) use($tag_id){
                $query->select("tag_id", "tag_name");
                if(!empty($tag_id)){
                    $query->whereRaw("tags.id = $tag_id");
                }
            },
            'category'  =>  function($query) use($cat_id){
                $query->select("id", "cat_name");
                if(!empty($cat_id)){
                    $query->whereRaw("categorys.id = $cat_id");
                }
            }
        ]);
        if(!empty($post_id)){
            $post->whereRaw( "posts.id = $post_id");
            return $post->orderBy("created_at", "desc")->first()->toArray();
        }else{
            return $post->orderBy("created_at", "desc")->get()->toArray();
        }
    }


}
