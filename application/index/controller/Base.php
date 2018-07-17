<?php
namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    public $city = '';
    public $account = '';
    public function _initialize()
    {
       //城市的数据
        $citys = model('city')->getNormalCitys();
        //用户数据.

        $this->getCity($citys);
        $cats = $this->getRecommendCats();
        $this->assign('citys',$citys);
        $this->assign('city',$this->city);
        $this->assign('user',$this->getLoginUser());


    }

    public function getCity($citys){
        foreach($citys as $city) {
            $city = $city->toArray();
            if($city['is_default'] == 1) {
                $defaultuname = $city['uname'];
                break; // 终止foreach
            }
        }

        //todo
        $defaultuname = $defaultuname ?$defaultuname :'nanchang';

    }

    public function getLoginUser(){
        if (!$this->account){
            $this->account = session('o2o_user','','o2o');
        }
        return $this->account;
    }
    public function getRecommendCats(){
        $cats = model('category')->getRecommendCategoryByParentId(0,5);
        foreach ($cats as $cat){
            $parentIds[] = $cat->id;
        }
        //获取耳机分类的数据
        $sedCats = model('category')->getNormalCategoryByParentId($parentIds);
        foreach ($sedCats as $sedCat){
            $sedcatArr[$sedCat->parent_id] = [
                'id'=>$sedCat->id,
                ''
            ];
        }
    }




}
