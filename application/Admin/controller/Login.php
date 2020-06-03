<?php


namespace app\Admin\controller;



use app\Common\model\Admin;

class Login extends Base
{
    public function index(){
//        $data['flag']=rand(1000,9999);
//        $data['phone']=17352884383;
//        $data['user_name']='神仙';
//        $data['pwd']=md5('123456'.$data['flag']);
//        $data['status']=1;
//        $data['attribute']=1;
//        $data['create_time']=$_SERVER['REQUEST_TIME'];
//        $admin=new Admin();
//        echo $admin->add($data);

        return $this->fetch('/login');
    }

    //登录
    public function uLogin(){
        $user_phone=input('u_phone');
        $pwd=input('u_pwd');
        if(empty($user_phone)||empty($pwd)){
            showMessage('账号密码不能为空');
        }
        $admin=new Admin();
        $admin_one=$admin->getList(['phone'=>$user_phone],'all');
        if(empty($admin_one)){
            showMessage('账号不存在！');
        }
        $pwd=md5($pwd.$admin_one[0]['flag']);
        if($admin_one[0]['status']!=1){
            showMessage('账号已经停用');
        }elseif ($pwd!=$admin_one[0]['pwd']){
            showMessage('密码错误！');
        }else{
            session('user_phone',$user_phone);
            return $this->fetch('/index');
        }
    }

    //退出登录
    public function outLogin(){
        session('user_phone','');
        return $this->fetch('/login');
    }

}