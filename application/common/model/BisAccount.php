<?php
/**
 * Date: 2018/7/11
 * Time: 20:13:32
 */

namespace app\common\model;


use think\Model;

class BisAccount extends Model
{
    public function add($data){
        $data['status'] = 1;
        $this->save($data);
        //返回插入后的id
        return $this->id;

    }

}