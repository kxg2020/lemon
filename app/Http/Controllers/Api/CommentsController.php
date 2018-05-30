<?php

namespace APP\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $page_size = $request->page_size > 0 ? $request->page_size : 20;
        $comments = Comment::select('*', DB::raw('left(body, 100) as body_show'))->orderBy('created_at', 'desc')->paginate($page_size);
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $comments
        ]);
    }

    public function destroy(Request $request)
    {
        if(empty($request->id)){
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'ID不能为空'
            ]);
        }
        $result = Comment::destroy($request->id);
        return response()->json([
            'status'    =>  $result ? 'success' : 'error',
            'message'   =>  $result ? '删除成功' :  '删除失败'
        ]);
    }

}