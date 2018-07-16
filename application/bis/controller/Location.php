<?php
namespace app\bis\controller;

use think\Controller;

class Location extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    //todo 还没完成添加和列表显示
    public function add(){
        //获取城市
        $cities = model('City')->getNormalCitiesByParentId();
        //获取分类
        $categories = model('Category')->getNormalCategoriesByParentId();
        return $this->fetch('',[
            'cities'=>$cities,
            'categories'=>$categories
        ]);
    }
}
