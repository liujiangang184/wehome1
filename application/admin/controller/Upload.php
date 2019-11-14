<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 14:49
 */

namespace app\admin\controller;


class Upload
{
    public function index(){
        $file=request()->file('file');
        if($file){
            $info=$file->validate(['size'=>200*1024,'ext'=>'png,jpeg,jpg,gif,webp'])
                ->move(ROOT_PATH . 'public' . DS . 'uploads');
        };
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            $src=UPLOAD_PATH .$info->getSaveName();
            return json([
               'code'=>0,
               'msg'=>'上传成功',
               'data'=>[
                   'src'=>$src
               ]
            ]);
        }else{
            return json([
                'code'=>0,
                'msg'=>'上传成功',
                'data'=>[
                    'src'=>$file->getError()
                ]
            ]);
        };
    }
}