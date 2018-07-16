<?php
/**
 * Date: 2018/7/11
 * Time: 20:13:32
 */

namespace app\common\model;


class Bis extends BaseModel
{
    public function getBisByStatus($status = 0){

        $order = ['id'=>'desc'];
        $data =[
          'status' => $status,
        ];

        $result = $this->where($data)->order($order)->paginate();
        return $result;
    }


}