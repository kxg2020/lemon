<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/8/24
 * Time: 10:11
 */

namespace App\Lemon;

use GuzzleHttp\Client;

class BaiduTransApi
{
    private $apiUrl = "http://api.fanyi.baidu.com/api/trans/vip/translate?q=%s&from=%s&to=%s&appid=%s&salt=%s&sign=%s";
    private $appId;
    private $secretKey;

    public function __construct()
    {
        $this->appId = config('services.baidu_trans.access_key');
        $this->secretKey = config('services.baidu_trans.secret_key');

    }

    public function translate($query, $from = 'zh', $to = 'en')
    {
        $args = [
            'q' => $query,
            'appid' => $this->appId,
            'salt' => rand(10000, 99999),
            'from' => $from,
            'to' => $to,
        ];
        $args['sign'] = $this->bulidSign($query, $args['salt']);
        $url = sprintf($this->apiUrl, urlencode($args['q']), $from, $to, $this->appId, $args['salt'], $args['sign']);
        $client = new Client();
        $response = $client->request('GET', $url);
        if($response->getStatusCode() != 200) {
            return [
                'status' => 'error',
                'message' => '翻译接口调用失败'
            ];
        }
        $res = json_decode($response->getBody(), true);
        if(isset($res['error_code'])){
            return [
                'status' => 'error',
                'message' => $this->getMessageByCode($res['error_code']),
            ];
        }else{
            return [
                'status' => 'success',
                'data' => $res['trans_result'][0]
            ];
        }
    }

    protected function getMessageByCode($error_code){
        $error = [
            52000 => '成功',
            52001 => '请求超时,重试',
            52002 => '系统错误,重试',
            52003 => '未授权用户,检查您的appid是否正确',
            54000 => '必填参数为空,检查是否少传参数',
            58000 => '客户端IP非法,检查您填写的IP地址是否正确,可修改您填写的服务器IP地址',
            54001 => '签名错误,请检查您的签名生成方法',
            54003 => '访问频率受限,请降低您的调用频率',
            58001 => '译文语言方向不支持,检查译文语言是否在语言列表里',
            54004 => '账户余额不足,前往管理控制台为账户充值',
            54005 => '长query请求频繁,请降低长query的发送频率，3s后再试',
        ];
        return !empty($error[$error_code]) ? $error[$error_code] : '未知错误';
    }

    protected function bulidSign($query, $salt)
    {
        $str = $this->appId . $query . $salt . $this->secretKey;
        return md5($str);
    }
}