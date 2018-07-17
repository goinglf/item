<?php
namespace app\index\controller;

use think\Controller;
use think\Exception;

class User extends Controller
{
    public function login()
    {
        $user = session('o2o_user','','o2o');
        if ($user && $user->id){
            $this->redirect(url('index/index'));
        }
        return $this->fetch();
    }

    public function register()
    {
        if (request()->isPost()){
            $data = input('post.');
            if (!captcha_check($data['verifyCode'])){
                $this->error('验证码不正确');
            }else {
                //todo 校验
                $data['code'] = mt_rand(100, 10000);
                $data['password'] = md5($data['password'] . $data['code']);
                try {
                    $data = model('user')->add($data);
                } catch(\Exception $e){
                    $this->error($e->getMessage());
                }
                if ($data){
                    $this->success('添加成功');
                }else{
                    $this->error('注册失败');
                }

            }
        }
        return $this->fetch();
    }

    public function loginCheck(){
        if (!request()->isPost()){
            $this->error('提交不合法');
        }
        $data = input('post.');
        try{
            $user = model('User')->getUserByUsername($data['username']);
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
        if (!$user || $user->status !=1){
            $this->error('该用户不存在');
        }

        if (md5($data['password'].$user->code) != $user->password){
            $this->error('密码不正确');
        }
        model('user')->updateById(['last_login_time'=>time()],$user->id);
        session('o2o_user',$user,'o2o');
        $this->success('登陆成功',url('index/index'));
    }

    public function logout(){
        session(null,'o2o');
        return $this->redirect(url('user/login'));
    }
}
