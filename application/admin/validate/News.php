<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 16:41
 */

namespace app\admin\validate;


use think\Validate;

class News extends Validate
{
    protected $rule =[
        'neid'=>'number',
        'nename'=>'require',
        'nedetails'=>'require',
    ];
    protected $scene=[
        'insert'=>['neid','nename','nedetails'],
        'delete'=>['neid'],
        'update'=>['neid','field','value'],
    ];
}