<?php

namespace App\Http\Controllers\APi;

use App\Lemon\QiniuUploads;
use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    protected $fileDir = 'blog';
    //
    public function index(Request $request)
    {
        $page_size = $request->page_size > 0 ? $request->page_size : 20;
        $listData = Post::with([
            'category' => function($query){
                $query->select("id", "cat_name");
            },
            'tags'  =>  function($query){
                $query->select('tag_id', "tag_name");
            }
        ])->paginate($page_size);
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
            'tags'   =>  'required',
        ]);
        $post->title = $request->title;
        $post->thumb = $request->thumb;
        $post->cat_id = $request->cat_id;
        $post->content = $request->content;
        $post->markdown = $request->markdown;
        $post->save();
        $post->tags()->attach($request->tags);
        return response()->json([
            'status'    =>  'success'
        ]);
    }
    public function upload(QiniuUploads $qiniuUploads, Request $request)
    {
        $reult =  $qiniuUploads->upload($this->fileDir, $request);
        return response()->json($reult);
    }
    public function show($id){
        $post = Post::with([
            'category' => function($query){
                $query->select("id", "cat_name");
            },
            'tags'  =>  function($query){
                $query->select('tag_id');
            }
        ])->find($id);
        return response()->json([
            'status'    =>  'success',
            'data'  =>  $post
        ]);
    }
    public function update(Request $request){
        if (empty($request->id)) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'ID 不能为空'
            ]);
        }
        $this->validate($request, [
            'title'  =>  'required',
            'thumb'  =>  'required',
            'content'    =>  'required',
            'markdown'    =>  'required',
        ]);
        $post = Post::find($request->id);
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
