<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 14:34
 */

namespace app\api\controller;


use think\Controller;
use think\Request;

class Image extends Controller
{
    public function upload(){
        $file = Request::instance()->file('file');
        //目录
        $info = $file->move('upload');
        if($info && $info->getPathname()){
            return show(1,'success','/'.$info->getPathname());

        }
        return show(0,'upload error');
    }

}