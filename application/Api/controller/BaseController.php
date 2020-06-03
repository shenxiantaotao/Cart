<?php


namespace app\Api\controller;


use think\Session;

class BaseController
{
    protected $_myCart=[];
    public function __construct()
    {
        $shop_id=input('shop_id')?:session('shop_id');//门店id

        if(empty(session('cart'.$shop_id))){
            $cart=new \app\Common\model\Cart();
            session('cart'.$shop_id,$cart);
            $this->_myCart=$cart;
        }else{
            $this->_myCart=Session::get('cart'.$shop_id);
        }
    }

}