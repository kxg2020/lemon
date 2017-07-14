<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/7/12
 * Time: 11:32
 */

namespace APP\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Lemon\QiniuUploads;
use Illuminate\Http\Request;
use Qiniu\Auth;
use Qiniu\Etag;
use Qiniu\Storage\UploadManager;

class FileController extends Controller
{
    public function index(QiniuUploads $qiniuUploads, Request $request)
    {

    }

    public function store(QiniuUploads $qiniuUploads, Request $request)
    {
        $reult =  $qiniuUploads->upload($request);
        return response()->json($reult);
    }

}