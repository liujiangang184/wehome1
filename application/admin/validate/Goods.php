<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 16:41
 */

namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule =[
        'cid'=>'number',
        'gname'=>'require',
        'gmprice'=>'number',
        'gsale'=>'number',
        'gstock'=>'number',
        'gthumb'=>'require',
        'gbanner'=>'require',
        'gdetail'=>'require',
    ];
    protected $scene=[
        'insert'=>['cid','gname','gmprice','gsale','gstock','gthumb','gbanner','gdetail'],
//        'delete'=>['id'],
//        'update'=>['id','field','value'],
    ];
}