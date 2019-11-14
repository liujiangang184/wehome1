<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/10
 * Time: 16:15
 */

namespace app\admin\validate;


use think\Validate;

class Serviceitems extends Validate
{
    protected $rule =[
        'seid'=>'number',
        'sebanner'=>'require',
        'setitle'=>'require',
        'sedetails'=>'require'
    ];
    protected $scene=[
        'insert'=>['seid','sebanner','setitle','sedetails'],
        'delete'=>['seid'],
        'update'=>['seid','field','value'],
    ];

}