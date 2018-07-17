<?php
/**
 * Date: 2018/7/11
 * Time: 20:13:32
 */

namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected  $autoWriteTimestamp = true;
    public function add($data = []){
        $data['status'] = 1;
        $this->save($data);
        //返回插入后的id
        return $this->id;

    }
    public function updateById($data, $id) {
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }


}