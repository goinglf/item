<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/10
 * Time: 13:55
 */

namespace app\common\model;


use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
        return $this->save($data);
    }

    //获取顶级分类
    public function getNormalFirstCategory(){
        $data = [
           'status' => 1,
            'parent_id' => 0,
        ];
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

    public function getFirstCategories($parentId = 0){
        $data = [
            'status' => ['neq',-1],
            'parent_id' => $parentId,
        ];
        $order = [
            'id' => 'desc'
        ];
        $result = $this->where($data)->order($order)->paginate();
        return $result;
    }

    public function getNormalCategoriesByParentId($parentId = 0){
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



}