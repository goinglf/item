<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 16:52
 */

namespace app\bis\controller;


use think\Controller;
use think\Validate;

class Register extends Controller
{
    //商户注册
    public function index(){
        //获取城市
        $cities = model('City')->getNormalCitiesByParentId();
        //获取分类
        $categories = model('Category')->getNormalCategoriesByParentId();
       return $this->fetch('',[
           'cities'=>$cities,
           'categories'=>$categories
       ]);
    }

    public function add(){
        if (!request()->isPost()){
            $this->error('请求失败');
        }

        $data = input('post.');
        //校验数据
        $validate = validate('Bis');
        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }

        //获取经纬度
        $lngLat = \Map::getLngLat($data['address']);
        if (empty($lngLat)
            //状态为0是正常
            || $lngLat['status'] !=0
            //状态为0是模糊定位
            || $lngLat['result']['precise'] !=1){
            $this->error('无法获取精确地址或不存在');
        }

        $bisData = [
          'name'   => $data['name'],
          'city_id'=> $data['city_id'],
          'email'=> $data['email'],
          'city_path'=> empty($data['se_city_id']) ?$data['city_id']:$data['city_id'].'.'.$data['se_city_id'],
            'logo' =>$data['logo'],
            'description' => empty($data['description']) ? '':$data['description'],
            'bank_info' => $data['bank_info'],
            'bank_user' => $data['bank_user'],
            'bank_name' => $data['bank_name'],
            'faren'      => $data['faren'],
            'faren_tel'  => $data['faren_tel']
        ];

        $bisId = model('Bis')->add($bisData);


        $validate = validate('BisLocation');
        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $data['cat'] = '';
        if (!empty($data['se_city_id'])){
            $data['cat'] = explode('|',$data['se_city_id']);
        }
        $locationData = [
            'name' =>$data['name'],
            'logo' =>$data['logo'],
            'address' =>$data['address'],
            'tel' =>$data['tel'],
            'contact' =>$data['contact'],
            'xpoint' =>empty($lngLat['result']['location']['lng'])?'':$lngLat['result']['location']['lng'],
            'ypoint' =>empty($lngLat['result']['location']['lat'])?'':$lngLat['result']['location']['lat'],
            'bis_id' =>$bisId,
            'open_time' =>$data['open_time'],
            'content' =>empty($data['content']) ? '':$data['content'],
            'is_main' =>1,
            'city_id' =>$data['city_id'],
            'city_path' =>empty($data['se_city_id']) ?$data['city_id']:$data['city_id'].'.'.$data['se_city_id'],
            'category_id' =>$data['category_id'],
//            'category_path' =>$data['category_path'].'.'.$data['cat'],
            'bank_info' =>$data['bank_info'],

        ];
        $locationId = model('BisLocation')->add($locationData);
        $validate = validate('BisAccount');
        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $data['code'] = mt_rand(100,10000);
        $accountData = [
            'username' => $data['username'],
            'password'=>md5($data['password'].$data['code']),
            'code'=>$data['code'],
            'bis_id'=>$bisId,
            'is_main'=>1,
        ];
        $accountId = model('BisAccount')->add($accountData);
        //todo
        if (!$accountId){
            $this->error('申请失败');
        }
        //发送邮件
        $url = request()->domain().url('bis/register/waiting',['id'=>$bisId]);
        $title = 'o2o入驻申请通知';
        $content = '您提交的入驻申请需等待平台方审核，您可以通过点击链接<a href='.$url.'target=\'_blank\'>查看链接</a>查看审核状态';
        \phpmailer\Email::send($data['email'],$title,$content);
        //同模块不需要写模块名称bis
        $this -> success('申请成功',$url('register/waiting',['id'=>$bisId]));
    }

    public function waiting($id){
        if (empty($id)){
            $this->error('error');
        }

        $detail = model('Bis')->get($id);

        return $this->fetch('',[
           'detail' =>$detail,
        ]);




    }

}