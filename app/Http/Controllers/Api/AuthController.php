<?php
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/7/6
 * Time: 15:32
 */

namespace APP\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->input();
        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password']])){
            $user = Auth::user();
            $data = [
                'status'    =>  200,
                'msg'       =>  '登录成功',
                'user'      =>  [
                    'name'  =>  $user['name'],
                    'lemon' =>  Session::getId()
                ]
            ];
        }else{
            $data = [
                'status'    =>  403,
                'info'      =>  '用户名或密码不正确'
            ];
        }
        return response()->json($data);
    }

    public function check()
    {
        if(Auth::check()){
            return ['status' => true];
        }
        return ['status' => false];
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(
            [
                'status'    =>  200,
                'msg'       =>  '退出成功'
            ]
        );
    }
}