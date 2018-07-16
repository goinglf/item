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
       return $this->fetch();
    }

}