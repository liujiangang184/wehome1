<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 11:08
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Goods extends Base
{
    public function openinsert(){
        $cate =Db::table('category')->order('cid','asc')->select();
        $this->assign('cates',$cate);
        return $this->fetch();
    }
    public function insert(){
        $method=$this->request->method();
        if($method != 'POST'){
            return json(['code'=>'404','msg'=>'请求方式错误']);
        }
        $data=input('post.');
        //        验证规则
        $validate=validate('Goods');
        if (!$validate->scene('insert')->check($data)){
            return json(['code'=>404,'msg'=>$validate->getError()]);
        }
        $data=input('post.');
        date_default_timezone_set('PRC');
        $data['gcreate_time']=date('Y-m-d h:i:s');
        $data['gbanner']=substr($data['gbanner'],0,strlen($data['gbanner'])-1);
        $result = Db::table('goods')->insert($data);
        if($result>0){
            return json(['code'=>'200','msg'=>'导航插入成功']);
        }else{
            return json(['code'=>'404','msg'=>'导航插入失败']);
        }
    }
    public function index(){
        $cate=Db::table('category')->select();
        $this->assign('cates',$cate);
        return $this->fetch();
    }
    public function query()
    {
        //1.数据总数
        //2.当前页数据  select * from goods where [] order by gid asc limit offset.length

        //搜索条件: 点击搜索条件

        $qs = $this->request->get();
        $page = $qs['page'];
        $limit = $qs['limit'];
        $offset = ($page - 1) * $limit;
        $where = [];
        if (count($qs) > 2) {
            $cid = $qs['cid'];
            $gname = $qs['gname'];
            $min = $qs['price_min'];
            $max = $qs['price_max'];
            if ($cid) {
                $where['cid'] = $cid;
            }
            if ($gname) {
                $where['gname'] = ['like', "%$gname%"];
            }
            if ($min && $max && $min < $max) {
                $where['gsale'] = ['between', "$min,$max"];
            }

        }
        $data = Db::table('goods')->where($where)->limit($offset, $limit)->select();
        $count = Db::table('goods')->where($where)->count();
        return json([
            'code' => 0,
            'msg' => '数据获取成功',
            'count' => $count,
            'data' => $data,
            'qs'=>$qs
        ]);
    }
    public function delete()
    {
        // 权限 请求方式 参数
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => "请求方式错误"]);
        }

        $data = input('post.');
        $id = $data['id'];
        $validate = validate('goods');

        if (!$validate->scene('del')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
            exit();
        }
        $result = Db::table('goods')->where("id='$id'")->delete();
        if ($result > 0) {
            return json(['code' => 200, 'msg' => "删除成功"]);
        } else {
            return json(['code' => 404, 'msg' => "删除失败"]);
        }
    }
}
