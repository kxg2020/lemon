<?php

namespace APP\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Lemon\QiniuUploads;
use App\Model\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $page_size = $request->page_size > 0 ? $request->page_size : 20;
        $listData = File::ofDir($request->dir)->paginate($page_size);
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $listData
        ]);
    }

    public function store(QiniuUploads $qiniuUploads, Request $request)
    {
        $reult =  $qiniuUploads->upload($request->dir, $request);
        return response()->json($reult);
    }

    public function dirs(File $file){
        $dirs = $file->getDirs();
        return response()->json([
            'status'    =>  'success',
            'data'      =>  $dirs
        ]);
    }
}