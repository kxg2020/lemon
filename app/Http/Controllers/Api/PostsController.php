<?php

namespace App\Http\Controllers\APi;

use App\Lemon\QiniuUploads;
use App\Model\Post;
use App\Model\Post_tag;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

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
            'slug'  =>  'required|unique:posts',
            'thumb'  =>  'required',
            'content'    =>  'required',
            'markdown'    =>  'required',
            'tags'   =>  'required',
        ]);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->thumb = $request->thumb;
        $post->cat_id = $request->cat_id;
        $post->content = $request->content;
        $post->markdown = $request->markdown;
        $post->save();
        $post->tags()->attach($this->rewriteTag($request->tags));
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
            'tags' => function($query){
                $query->select("tag_id");
            }
        ])->find($id)->toArray();
        $tag_ids = [];
        foreach ($post['tags'] as $tag){
            array_push($tag_ids, $tag['tag_id']);
        }
        $post['tags'] = $tag_ids;
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
            'slug'  =>  'required',
            'thumb'  =>  'required',
            'content'    =>  'required',
            'markdown'    =>  'required',
        ]);
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->thumb = $request->thumb;
        $post->cat_id = $request->cat_id;
        $post->content = $request->content;
        $post->markdown = $request->markdown;
        $post->save();
        Redis::del('post:'.$post->slug);
        Post_tag::where('post_id', $post->id)->delete();
        $post->tags()->attach($this->rewriteTag($request->tags));
        return response()->json([
            'status'    =>  'success'
        ]);
    }

    protected function rewriteTag($tags){
        $newTags = [];
        foreach ($tags as $k => $tag){
            if(is_string($tag)){
                $tagModel = new Tag();
                $tagModel->tag_name = $tag;
                $tagModel->save();
                $tag = $tagModel->id;
            }
            array_push($newTags, $tag);
        }
        return $newTags;
    }
}
