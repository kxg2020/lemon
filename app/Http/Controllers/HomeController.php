<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;
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

    public function category($cat_id)
    {
        $posts = $this->getPosts($cat_id);
        return view('home', ['posts' => $posts, 'cat_id' => $cat_id]);
    }

    public function post($id){
        $post = Post::with('category')->find($id)->toArray();
        return view('post', ['post' => $post]);
    }

    protected function getPosts($cat_id = null)
    {
        if(empty($cat_id)){
            return Post::with('category')->orderBy('created_at', 'desc')->offset(0)->limit(10)->get()->toArray();
        }else {
            return Post::with('category')->where('cat_id', $cat_id)->orderBy('created_at', 'desc')->get()->toArray();
        }
    }

}
