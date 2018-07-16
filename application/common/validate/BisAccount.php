<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 15:22
 */

namespace app\common\validate;


use think\Validate;

class BisAccount extends Validate
{
    protected $rule = [
        'username' => 'require|max:25|unique:BisAccount',
        'password'=>'require',
//        'code'=>'require',
//        'bis_id'=>'require',
//        'is_main'=>'require',
    ];

    protected $scene = [
      'add' =>['username','password','code','bis_id','is_main',],
    ];

}