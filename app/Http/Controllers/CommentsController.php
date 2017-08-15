<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/8/14
 * Time: 14:30
 */

namespace App\Http\Controllers;


use App\Model\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {

    }

    public function comment($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->orderBy('created_at', 'desc')->get()->toArray();
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $comments
        ]);
    }

    public function store(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'email'  =>  'required|email',
            'url'  =>  'required|url',
            'body'    =>  'required'
        ]);
        $comment->post_id = $request->post_id;
        $comment->ip = $request->ip();
        $comment->email = $request->email;
        $comment->url = $request->url;
        $comment->body = $request->body;
        $comment->save();
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $comment->toArray()
        ]);
    }
}