<?php
namespace app\api\controller;

use think\console\command\make\Model;
use think\Controller;
use think\Request;

class Category extends Controller
{
    private $obj;
    protected function _initialize()
    {
        $this->obj = model('Category');
    }
    public function getCategoryByParentId(){
        $id = input('post.id');
        if (!intval($id)){
            $this->error('id不合法');
        }
        $categories = $this->obj->getNormalCategoryByParentId($id);
        if ($categories){
            return show(1,'success',$categories);
        }else{
            return show(0,'error',$categories);
        }

    }


}
