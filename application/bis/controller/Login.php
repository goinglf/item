<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 16:52
 */

namespace app\bis\controller;


use think\Controller;

class Login extends Controller
{
    public function index(){
        if ($this->request->isPost()){
            $data = input('post.');
            //todo
            //validate校验
            $result = model('BisAccount')->get(['username'=>$data['username']]);

            if (!$result || $result->status !=1){
                $this->error('该用户不存在或审核未通过');
            }
            if ($result->password != md5($data['password'].$result['code'])){
                $this->error('密码错误');
            }
            model('BisAccount')->updateById(['last_login_time'=>time()],$result->id);
            session('bisAccount',$result,'bis');//bis是作用域 bis模块下的
            return $this->success('登陆成功',url('index/index'));
        }else{
            $account = session('bisAccount','','bis');
            if ($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }

    }

    public function logout(){
        session(null,'bis');
        return $this->redirect(url('login/index'));
    }

}