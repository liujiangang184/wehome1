<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/8
 * Time: 17:56
 */

namespace app\index\controller;


use think\Db;

class Category extends Base
{
    public function index(){
        $cid = $this->request->get('cid');
        $cnav=Db::table('nav')->where('id',$cid)->find();
        $tpl=$cnav['ntpl'];
        $this->assign('title',$cnav['nname']);
        switch($tpl){
            case 'aboutus':
                Db::table('nav')->where('ntpl',$tpl)->find();
                $about=Db::table('aboutus')->select();
                $xianshi=Db::table('aboutgoods')->select();
                $this->assign('xianshi',$xianshi);
                $this->assign('aboutus',$about);
                break;
            case 'product':
                $cate2 = [['cid'=>0,'cname'=>'全部']];
                $cate1=Db::table('category')->order('cid','asc')->select();
                $cate =array_merge($cate2,$cate1);
                $all=Db::table('goods')->select();
                $len = count($cate);
                for($i=0;$i<$len;$i++){
                    $items = $cate[$i];
                    $id = $items['cid'];
                    if($i == 0){
                        $cate[$i]['goods'] = $all;
                        continue;
                    }
//               $goods=array_filter('','','');
                    $goods = array_filter($all,function($v) use($id){

                        return  $v['cid'] == $id;

                    });
                    $shangpin=$all;
                    $this->assign('shangpin',$shangpin);
                    $cate[$i]['goods'] = $goods;
                }
                $this->assign('cate',$cate);
                Db::table('nav')->where('ntpl',$tpl)->find();
                break;
            case 'online':
                Db::table('nav')->where('ntpl',$tpl)->find();
                $cid=$this->request->get('cid');
                $on=Db::table('online')->select();
                $ca=Db::table('category')->select();
                $this->assign('on',$on);
                $this->assign('ca',$ca);
                break;
            case 'news':
                Db::table('nav')->where('ntpl',$tpl)->find();
                $new=Db::table('news')->select();
                $this->assign('new',$new);
                break;
            case 'Service-items':
                Db::table('nav')->where('ntpl',$tpl)->find();
                $fuwu=Db::table('serviceitems')->select();
                $this->assign('fuwu',$fuwu);
                break;
        }
        $this->assign('cid',$cid);
        $this->assign('cnav',$cnav);
        return $this->fetch($tpl);
    }
    public function item(){
        $cid=$this->request->get('gid');
        $cnav=Db::table('goods')->where('gid',$cid)->find();
        $all=explode(',',$cnav['gbanner']);
        $this->assign('title',$cnav['gname']);
        $this->assign('cid',$cid);
        $this->assign('cnav',$cnav);
        $this->assign('all',$all);
        return $this->fetch();
    }
    public function news(){
        return $this->fetch();
    }
    public function newss(){
        $cid=$this->request->get('neid');
        $cnav=Db::table('nav')->where('id',$cid)->find();
        $newss=Db::table('news')->where('neid',$cid)->find();
        $newss1=Db::table('news')->where('neid','<',$cid)->order('neid','desc')->limit(0,1)->find();
        $newss2=Db::table('news')->where('neid','>',$cid)->order('neid','desc')->limit(0,1)->find();
        $this->assign('title',$newss['nename']);
        $this->assign('cnav',$cnav);
        $this->assign('cid',$cid);
        $this->assign('newss',$newss);
        $this->assign('newss1',$newss1);
        $this->assign('newss2',$newss2);

        return $this->fetch();
    }
    public function online(){
        return $this->fetch();
    }
}