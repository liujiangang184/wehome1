<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/25
 * Time: 1:23
 */

namespace app\index\controller;


use think\Controller;
use think\Db;

class Online extends Base
{
    function joinKeys($arr){
        $str='';
        foreach ($arr as $key=>$value){
            $str.=$key.',';
        }
        $str=substr($str,0,-1);
        return $str;
    }
    function joinValues($arr){
        $str='';
        foreach ($arr as $key=>$value){
            $str.="'$value',";
        }
        $str=substr($str,0,-1);
        return $str;
    }
    public function online(){
        $res=$_POST;
        $result=Db::table('online')->data($res)->insert();
        if ($result>0){
            return json([
                'code' => 0,
                'msg' => '数据插入成功'
            ]);
        }
    }
}