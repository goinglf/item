<?php
namespace app\admin\controller;

use think\Controller;

class Bis extends Controller
{
    private $obj;
    public function _initialize()
    {
       $this->obj = model('Bis');
    }

    //商家入驻列表
    public function apply()
    {
        $bis = $this->obj->getBisByStatus();
        return $this->fetch('',[
            'bis' => $bis,
        ]);
    }

}
