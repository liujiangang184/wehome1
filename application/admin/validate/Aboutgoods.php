<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 16:41
 */

namespace app\admin\validate;


use think\Validate;

class Aboutgoods extends Validate
{
    protected $rule =[
        'agid'=>'number',
        'agbanner'=>'require',
        'agtitle'=>'require',
        'agtype'=>'require',
    ];
    protected $scene=[
        'insert'=>['agid','agbanner','agtitle','agtype'],
        'delete'=>['agid'],
        'update'=>['agid','field','value'],
    ];
}