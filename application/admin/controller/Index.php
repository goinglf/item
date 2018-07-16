<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

    public function map(){
        return \Map::staticImage('杭州西湖');
    }
    public function welcome()
    {
//        \phpmailer\Email::send('954735429@qq.com','test','31312312');
//        \phpmailer\Email::send_email('954735429@qq.com','test','内容');
        return '发送成功';
    }
}
