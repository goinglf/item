<?php
/**
 * Date: 2018/7/11
 * Time: 20:36:26
 */
function show($status,$message = '',$data = []){
    return[
      'status'  =>$status,
        'message'=>$message,
        'data' =>$data,
    ];
}