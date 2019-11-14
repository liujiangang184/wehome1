<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/9
 * Time: 9:42
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Online extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    //查看导航
    public function index(){
        return $this->fetch();
    }
    public function query(){
        $data=Db::table('online')->select();
        $count =Db::table('online')->count();
        return json([
            'code'=>0,
            'msg'=>'',
            'data'=>$data,
            'count'=>$count,
        ]);
    }
    public function delete(){
        $method=$this->request->method();
        if($method != 'POST'){
            return json(['code'=>'404','msg'=>'请求方式错误']);
        };
        $data=input('post.');
        $validate=validate('Online');
        if (!$validate->scene('delete')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $id=$data['id'];
        $result = Db::table('online')->where("id='$id'")->delete();
        if($result>0){
            return json(['code'=>'200','msg'=>'删除成功']);
        }else{
            return json(['code'=>'404','msg'=>'删除失败']);
        }
    }
    public function edit(){
        $method=$this->request->method();
        if($method != 'POST'){
            return json(['code'=>'404','msg'=>'请求方式错误']);
        };
        $data=input('post.');
        $id=$data['id'];
        $validate=validate('Online');
        if (!$validate->scene('update')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $result = Db::table('online')->where("id='$id'")->update([$data['field']=>$data['value']]);
        if($result>0){
            return json(['code'=>'200','msg'=>'导航更新成功']);
        }else{
            return json(['code'=>'404','msg'=>'导航更新失败']);
        }
    }
}