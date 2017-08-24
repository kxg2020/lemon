<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/8/24
 * Time: 11:19
 */

namespace APP\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Lemon\BaiduTransApi;

class TransController extends Controller
{
    public function trans($query)
    {
        $baidu_trans = new BaiduTransApi();
        return $baidu_trans->translate($query);
    }
}