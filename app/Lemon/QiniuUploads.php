<?php
namespace App\Lemon;
use Illuminate\Http\Request;
use Qiniu\Etag;
use zgldh\QiniuStorage\QiniuStorage;

/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/7/12
 * Time: 11:34
 */
class QiniuUploads
{
    protected $client_id = '127.0.0.1';

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $this->client_id = $request->ip();

        if(!$file->isValid()){
            return ['status' => 400];
        }

        $fileUrl = $this->put($file);
        return ['status' => 200, 'fileUrl' => $fileUrl];
    }

    public function put($file)
    {
        $disk = QiniuStorage::disk('qiniu');
        $ext = $file->extension();
        $realPath = $file->getRealPath();
        $key = Etag::sum($realPath);
        $fileName = sprintf("%s.%s", $key[0], $ext);
        $result = $disk->put($fileName, fopen($realPath, 'r+'));
        if($result){

        }
        $download = $disk->downloadUrl($fileName, 'custom');
        return $download->getUrl();
    }
}