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

class Aboutgoods extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    //查看导航
    public function index(){
        return $this->fetch();
    }
    //展示插入导航
    public function openinsert(){
        return view();
    }
    //插入逻辑
    public function insert(){
        //权限  请求方式 参数
        $method=$this->request->method();
        if($method != 'POST'){
            return json(['code'=>'404','msg'=>'请求方式错误']);
        }
        $data=input('post.');
        //验证规则
        $validate=validate('Aboutgoods');
        if (!$validate->scene('insert')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $data=input('post.');
        $result = Db::table('aboutgoods')->insert($data);
        if($result>0){
            return json(['code'=>'200','msg'=>'导航插入成功']);
        }else{
            return json(['code'=>'404','msg'=>'导航插入失败']);
        }
    }
    public function query(){
        $data=Db::table('aboutgoods')->select();
        $count =Db::table('aboutgoods')->count();
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
        $validate=validate('Aboutgoods');
        if (!$validate->scene('delete')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $id=$data['agid'];
        $result = Db::table('aboutgoods')->where("agid='$id'")->delete();
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
        $id=$data['agid'];
        $validate=validate('Aboutgoods');
        if (!$validate->scene('update')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $result = Db::table('aboutgoods')->where("agid='$id'")->update([$data['field']=>$data['value']]);
        if($result>0){
            return json(['code'=>'200','msg'=>'导航更新成功']);
        }else{
            return json(['code'=>'404','msg'=>'导航更新失败']);
        }
    }
}