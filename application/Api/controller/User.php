<?php


namespace app\Api\controller;


use app\Common\model\UserAddr;

class User
{
    public function getUserList(){
        $user=new \app\Common\model\User();
//        $res=$user->getById(1);
        $data['user_name']='shen';
        $data['phone']='1511234558';
        $data['pwd']='shen2';
        $data['flag']='shen';
        $data['create_time']='123456465';
        $res=$user->add($data);
        var_dump($res);
    }
    //判断是否登录
    public function isLogin(){
        if (empty(session('phone'))&&empty(session('user_id'))){
            showJson(-1,'用户未登录，请先登录');
        }else{
            $user=new \app\Common\model\User();
            $userinfo=$user->getById(session('user_id'));
            showJson(0,'success',$userinfo);
        };
    }

    //注册用户
    public function postUser(){
        $data['user_name']=input('user_name');
        $data['phone']=input('phone');
        $data['flag']=rand(1000,9999);
        $data['pwd']=md5(input('pwd').$data['flag']);
        $data['create_time']=$_SERVER['REQUEST_TIME'];
        $data['status']=1;
        IF(empty(input('user_name'))||empty(input('phone'))||input('pwd')){
            showJson(-1,'参数不全');
        }
        $user=new \app\Common\model\User();
        $res=$user->add($data);
        session('user_name',$data['user_name']);
        session('phone',$data['phone']);
        session('status',1);
        session('user_id',$res);
        showJson(0,'',$res);
    }

    //登录用户
    public function userLogin(){
        $data['phone']=input('phone');
        IF(empty(input('phone'))||input('pwd')){
            showJson(-1,'登录失败');
        }
        $user=new \app\Common\model\User();
        $userone=$user->getList(['phone'=>$data['phone']],'all');
        if(empty($userone)){
            showJson(-1,'登录手机号不存在');
        }
        $pwd=md5(input('pwd').$userone[0]['flag']);
        if($pwd!=$userone[0]['pwd']){
            showJson(-1,'登录密码错误');
        }
        session('user_name',$userone[0]['user_name']);
        session('phone',$data['phone']);
        session('status',1);
        session('user_id',$userone[0]['id']);
        showJson(0,'登录成功');
    }
    //退出登录
    public function userLoginOut(){
        $phone=input('phone');//手机号
        if(empty($phone)){
            showJson(-1,'退出登录失败');
        }
        session('user_name','');
        session('phone','');
        session('status',0);
        session('user_id','');
        showJson(0,'退出登录成功');
    }
}