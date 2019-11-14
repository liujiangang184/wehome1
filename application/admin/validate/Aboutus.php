<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 16:41
 */

namespace app\admin\validate;


use think\Validate;

class Aboutus extends Validate
{
    protected $rule =[
        'aid'=>'number',
        'adetails'=>'require',
        'abanner'=>'require',
    ];
    protected $scene=[
        'delete'=>['aid'],
        'update'=>['aid','field','value'],
    ];
}