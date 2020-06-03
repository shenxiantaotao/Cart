<?php


namespace app\Api\controller;

class Address
{
    //添加收货地址
    public function postUserAddr(){
        $data['user_id']=session('user_id')?:showJson(-2,'用户信息已过期，请重新登录');
        $data['u_name']=input('u_name');
        $data['u_phone']=input('u_phone');
        $data['u_addr']=input('u_addr');
        $data['longitude']=input('longitude');
        $data['latitude']=input('latitude');
        if(empty($data['u_name'])||empty($data['u_phone'])||empty($data['u_addr'])||empty($data['longitude'])||empty($data['latitude'])){
            showJson(-1,'参数不全');
        }
        $useraddr=new \app\Common\model\UserAddr();
        $res=$useraddr->add($data);
        showJson(0,'success',$res);
    }

    //查看用户收货地址列表
    public function getAddList(){
        $user_id=session('user_id')?:showJson(-2,'用户信息已过期，请重新登录');
        $addr=new \app\Common\model\UserAddr();
        $addr_list=$addr->getList(['user_id'=>$user_id],'all');
        showJson(0,'success',$addr_list);
    }

}