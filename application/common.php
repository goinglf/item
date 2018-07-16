<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function status($status){
    if ($status == 1){
        $str = "<span class='label label-success radius'>正常</span>";
    }elseif ($status == 0){
        $str = "<span class='label label-danger radius'>待审</span>";
    }else{
        $str = "<span class='label label-danger radius'>删除</span>";
    }
    return $str;
}

//百度地图
//type 0的时候是get,1为post
function doCurl($url,$type = 0,$data=[]){
    $ch = curl_init();//初始化
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//若成功只返回结果，没有数据
    curl_setopt($ch,CURLOPT_HEADER,0);//不需要输出header头部信息
    if ($type == 1){
        curl_setopt($ch,CURLOPT_PORT,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }
    //执行并获取内容
    $output = curl_exec($ch);
    //释放句柄
    curl_close($ch);
    return $output;

}

//商户入驻申请的文案
function bisRegister($status){
    if ($status == 1){
        $str = '入驻申请成功';
    }elseif($status == 0){
        $str = '待审核，审核后平台方会发邮件通知，请关注邮件';
    }elseif($status == 2){
        $str = '非常抱歉，您提交的资料不符合条件，请重新提交';
    }else{
        $str = '该申请已被撤除';
    }

    return $str;
}

//分页封装 分页样式
function pagination($obj){
    if(!$obj){
        return '';
    }
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->render().'</div>';
}


//获取城市
function getSeCityName($path){
    if (empty($path)){
        return '';
    }
    //判断是否有逗号
    if (preg_match('/,/',$path)){
        $cityPath = explode(',',$path);
        $cityId = $cityPath[1];
    }else{
        $cityPath = $path;
    }

    $city = model('City')->get($cityId);
    return $city->name;

}