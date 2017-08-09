<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/8/9
 * Time: 15:23
 */

namespace APP\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Post;

class MainController extends Controller
{
    public function getData()
    {
        $post_count = Post::count();
        $page_view = 100;
        return response()->json([
            'status'    =>  'success',
            'data'      =>  [
                'post_count'    =>  $post_count,
                'page_view'     =>  $page_view
            ]
        ]);
    }
}