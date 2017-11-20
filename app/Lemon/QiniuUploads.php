<?php
namespace App\Lemon;
use App\Model\File;
use Illuminate\Http\Request;
use Qiniu\Etag;
use zgldh\QiniuStorage\QiniuStorage;

class QiniuUploads
{
    protected $client_id = '127.0.0.1';

    public function upload($dir, Request $request)
    {
        $file = $request->file('file');
        $this->client_id = $request->ip();

        if(!$file->isValid()){
            return ['status' => 'error', 'msg' => '文件不合格'];
        }

        $fileUrl = $this->put($dir, $file);
        return ['status' => 'success', 'fileUrl' => $fileUrl];
    }

    public function put($dir, $file)
    {
        $disk = QiniuStorage::disk('qiniu');
        $ext = $file->extension();
        $realPath = $file->getRealPath();
        $key = Etag::sum($realPath);
        $fileName = $dir.'/'.sprintf("%s.%s", $key[0], $ext);
        if($file = File::where('file_name', $fileName)->first()){
            $download = $disk->downloadUrl($fileName, 'custom');
            return $download->getUrl();
        }
        $result = $disk->put($fileName, fopen($realPath, 'r+'));
        if($result){
            $this->saveFileInfo($dir, $fileName, $ext);
        }
        $download = $disk->downloadUrl($fileName, 'custom');
        return $download->getUrl();
    }

    protected function saveFileInfo($dir, $fileName, $ext)
    {
        $file = new File();
        $file->dir = $dir;
        $file->file_name = $fileName;
        $file->file_ext = $ext;
        $file->save();
    }
}