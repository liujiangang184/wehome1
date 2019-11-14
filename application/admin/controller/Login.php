<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
    public function index(){
        return view();
    }
    public function check(){
        if(!request()->isPost()){
            return json([
                'code'=>404,
                'msg'=>'请求方式错误'
            ]);
        }
        $data=input('post.');
        if(!captcha_check($data['code'])){
            return json([
                'code' => 404,
                'msg' => '验证码错误'
            ]);
        };
        $username=$data['username'];

        $password = crypt($data['password'],md5('wehome1'));
//        var_dump($password);

        $result=Db::name('manager')->where(['username'=>$username,'password'=>$password])->find();
        if($result){
            Session::set('user',$result);
            return json([
                'code'=>200,
                'msg'=>'登录成功'
            ]);
         }else{
                return json([
                'code'=>404,
                'msg'=>'请输入正确的用户名和密码'
                ]);
            }
    }
}