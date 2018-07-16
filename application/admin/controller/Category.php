<?php
namespace app\admin\controller;

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

    public function index()
    {
        $parentId = input('get.parent_id',0,'intval');
        $categories = $this->obj->getFirstCategories($parentId);
       
        return $this->fetch('',[
            'categories'=>$categories,
        ]);
    }

    public function add()
    {
        $category = $this->obj->getNormalFirstCategory();
        return $this->fetch('',[
            'category'=>$category,
        ]);
    }

    public function save()
    {
//        $data = Request::instance()->param();

        if (!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        if (!empty($data['id'])){
           return $this->update($data);
        }
        $result = $this->obj->add($data);
        if ($result){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    public function edit($id = 0){
       if (intval($id) <1 ){
           $this->error('参数不合法');
       }

        $category = $this->obj->get($id);
        $categories = $this->obj->getFirstCategories();
        return $this->fetch('',[
            'category'=>$category,
            'categories'=>$categories,

        ]);
    }
    public function update($data){
        $result = $this->obj->save($data,['id'=>intval($data['id'])]);
        if ($result){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    //排序
    public function listorder($id,$listorder){
        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
        }

    }

    public function status(){
        $data = input('get.');
        $validate = validate('Category');
        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $result = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($result){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }


}
