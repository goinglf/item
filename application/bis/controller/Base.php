<?php
namespace app\bis\controller;

use think\Controller;

class Base extends Controller
{
    public $account;
    public function _initialize()
    {
        $isLogin = $this->isLogin();
        if (!$isLogin){
            return $this->redirect(url('login/index'));
        }
    }
    //判断是否登陆
    public function isLogin(){
        $user = $this->getLoginUser();
        if ($user && $user->id){
            return true;
        }
        return false;
    }

    public function getLoginUser(){
        if (!$this->account){
            $account=session('bisAccount','','bis');
        }
        return $account;
    }
}
