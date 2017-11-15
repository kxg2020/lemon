<?php

namespace App\Http\Controllers\Wechat;

use App\Lemon\QiniuUploads;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function posts()
    {
        return response()->json(['posts' => $this->addIntro(Post::select('id', 'content', 'cat_id', 'slug', 'title', 'created_at')->with('tags','category')->orderBy('created_at', 'desc')->get()->toArray())]);
    }

    public function categorys()
    {
        return response()->json(['categorys' => Category::select('id', 'cat_name')->where('is_nav', 1)->orderBy('cat_desc', 'desc')->get()->toArray()]);
    }

    public function tags()
    {
        return response()->json(['tags' => Tag::select('id', 'tag_name')->orderBy('click', 'desc')->get()->toArray()]);
    }

    public function post($post_id)
    {
        return response()->json(['post' => $post = Post::with('tags', 'category')->find($post_id)->toArray()]);
    }

    public function bind(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $code = $request->code;
        $appId= "wx3d1867534a7cebad";
        $appSecret = "fb8ba8095a41b495dea3a34185365c4f";
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appId."&secret=".$appSecret."&js_code=".$code."&grant_type=authorization_code";
        $client = new Client();
        $response = $client->request('GET', $url);
        $res = json_decode($response->getBody(), true);
        var_dump($res);exit;
        return response()->json([
            'username' => $username,
            'password' => $password,
            'code' => $code
        ]);
    }

    public function upload(QiniuUploads $qiniuUploads, Request $request)
    {
        $reult =  $qiniuUploads->upload('wechat', $request);
        return response()->json($reult);
    }

    protected function addIntro($posts){
        foreach ($posts as &$post){
            $post['intro'] = mb_substr(strip_tags($post['content']), 0, 100, 'utf-8');
            unset($post['content']);
        }
        return $posts;
    }

}