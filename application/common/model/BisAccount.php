<?php
/**
 * Date: 2018/7/11
 * Time: 20:13:32
 */

namespace app\common\model;


use think\Model;

class BisAccount extends BaseModel
{
    public function updateById($data,$id){

        //过滤data数组中的非数据字段的数据
        return $this->allowField(true)->save($data,['id'=>$id]);

    }

}