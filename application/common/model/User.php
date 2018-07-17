<?php
/**
 * Date: 2018/7/11
 * Time: 20:13:32
 */

namespace app\common\model;


use think\Model;

class User extends Model
{
    public function add($data=[]){
        if (!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status'] = 1;
       return $this->data($data)->allowField(true)->save();

    }

    /*
     * 根据用户名来获取用户信息
     */
    public function getUserByUsername($username){
        if (!$username){
            exception('用户名不合法');
        }
        $data = ['username'=>$username];
        return $this->where($data)->find();
    }

}