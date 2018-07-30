<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2018-07-30
 * Time: 11:22
 */

namespace App\Http\Controllers\V2;

use App\Model\Post;
use Illuminate\Support\Facades\DB;

class IndexController
{
    public function index()
    {
        $posts = Post::with('tags', 'category')->orderBy('created_at', 'desc')->paginate(20);
        return view('v2.posts', ['posts' => $posts]);
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
}