<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    public function status(){
        $data = input('get.');
        // 获取控制器
        $model = request()->controller();
        $validate = validate($model);
        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $result = model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($result){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }
}
