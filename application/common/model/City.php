<?php
/**
 * Date: 2018/7/11
 * Time: 20:13:32
 */

namespace app\common\model;


use think\Model;

class City extends Model
{
    public function getNormalCitiesByParentId($parentId = 0){
        $data = [
            'status' => 1,
            'parent_id' => $parentId,
        ];
        $order = [
            'id' => 'desc'
        ];
        $result = $this->where($data)->order($order)->select();
        return $result;
    }

    public function getNormalCitys(){

    }

}