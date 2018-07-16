<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 15:22
 */

namespace app\common\validate;


use think\Validate;

class BisLocation extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'email'=>'email',
//        'logo'=>'require',
        'city_id'=>'require',
        'bank_info'=>'require',
        'address'=>'require',
        'tel'=>'require',
        'contact'=>'require',
//        'bis_id'=>'require',
        'open_time'=>'require',
        'content'=>'require',
//        'is_main'=>'require',
        'category_id'=>'require',
//        'category_path'=>'require',

    ];

    protected $scene = [
      'add' =>['name','email','logo','city_id','brank_info','address','tel','contact','bis_id','open_time','is_main','category_id','category_path'],
//        'add' =>['name','email','logo','city_id','brank_info','address','tel','contact','bis_id','open_time','is_main','category_id'],
    ];

}