<?php
namespace app\api\controller;

use think\console\command\make\Model;
use think\Controller;
use think\Request;

class City extends Controller
{
    private $obj;
    protected function _initialize()
    {
        $this->obj = model('City');
    }
    public function getCitiesByParentId(){
        $id = input('post.id');
        if (!$id){
            $this->error('id不合法');
        }
        $cites = $this->obj->getNormalCitiesByParentId($id);
        if ($cites){
            return show(1,'success',$cites);
        }else{
            return show(0,'error',$cites);
        }

    }


}
