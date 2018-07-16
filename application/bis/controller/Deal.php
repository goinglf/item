<?php
namespace app\bis\controller;

use think\Controller;

class Deal extends Base
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Deal');
    }

    public function index()
    {
        $categorys = model('Category')->getNormalCategoryByParentId();
        $citys = model('city')->getNormalCitys();
        return $this->fetch('',[
            'categorys'=>$categorys
        ]);
    }
}
