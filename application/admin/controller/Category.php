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

class Category extends Base
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
        $data=Db::table('category')->select();
        $count =Db::table('category')->count();
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
        $validate=validate('Category');
        if (!$validate->scene('delete')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $id=$data['cid'];
        $result = Db::table('category')->where("cid='$id'")->delete();
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
        $id=$data['cid'];
        $validate=validate('Category');
        if (!$validate->scene('update')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $result = Db::table('category')->where("cid='$id'")->update([$data['field']=>$data['value']]);
        if($result>0){
            return json(['code'=>'200','msg'=>'导航更新成功']);
        }else{
            return json(['code'=>'404','msg'=>'导航更新失败']);
        }
    }
}