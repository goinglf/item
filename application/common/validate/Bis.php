<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 15:22
 */

namespace app\common\validate;


use think\Validate;

class Bis extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'email'=>'email',
//        'logo'=>'require',
        'city_id'=>'require',
        'bank_info'=>'require',
        'bank_name'=>'require',
        'bank_user'=>'require',
        'faren'=>'require',
        'faren_tel'=>'require',
    ];

    protected $scene = [
      'add' =>['name','email','logo','city_id','brank_info','brank_name','brank_user','faren',],
    ];

}