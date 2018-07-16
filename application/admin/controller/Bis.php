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
    public function index()
    {
        $bis = $this->obj->getBisByStatus(1);
        return $this->fetch('',[
            'bis' => $bis,
        ]);
    }
    //商家入驻列表
    public function apply()
    {
        $bis = $this->obj->getBisByStatus();
        return $this->fetch('',[
            'bis' => $bis,
        ]);
    }

    //商家入驻详情
    public function detail(){
        $id = input('get.id');
        if (empty($id)){
            return $this->error('id错误');
        }
        //获取城市
        $cities = model('City')->getNormalCitiesByParentId();
        //获取分类
        $categories = model('Category')->getNormalCategoriesByParentId();
        //获取商户数据
        $bisData = model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
        return $this->fetch('',[
            'cities'=>$cities,
            'categories'=>$categories,
            'bisData' =>$bisData,
            'locationData'=>$locationData,
            'accountData'=>$accountData
        ]);
    }

    public function status(){
        $data = input('get.');
        $validate = validate('Bis');
        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $result = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        $location = model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
        $account = model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);

        //todo
        //根据状态来发送邮件提醒 -1是不存在 1是待审核  2是通过
        if ($result && $location && $account){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

}
