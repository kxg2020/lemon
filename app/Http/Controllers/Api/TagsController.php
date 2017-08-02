<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/8/1
 * Time: 11:12
 */

namespace APP\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $listData = Tag::all("id as tag_id", "tag_name");
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $listData
        ]);
    }
    public function store(Tag $tag, Request $request)
    {
        $this->validate($request, [
            'tag_name'  =>  'required|unique:tags'
        ]);
        $tag->tag_name = $request->tag_name;
        $tag->save();
        return response()->json([
            'status'    =>  'success'
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
            'tag_name'  =>  'required',
        ]);
        $tag = Tag::find($request->id);
        $tag->tag_name = $request->tag_name;
        $tag->save();
        return response()->json([
            'status'    =>  'success'
        ]);

    }

}