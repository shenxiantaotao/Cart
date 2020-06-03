<?php


namespace app\Api\controller;


class Cart extends BaseController
{
    //添加商品到购物车
    public function addCart(){
        if(empty(input('shop_id'))){
            showJson(-1,'添加失败，没找到门店');
        };
        $good_id=input('good_id');//商品id
        $shop_price=floatval(input('shop_price'));//商品价格
        $number=intval(input('number'));//增减数量 正数为增加  负数为减少
        $mycart=$this->_myCart;
        $mycart->add(array('good_id'=>$good_id,'shop_price'=>$shop_price),$number);
        showJson();
    }

    //获取购物车
    public function getCart(){
        if(empty(input('shop_id'))){
            showJson(-1,'添加失败，没找到门店');
        };
        $mycart=$this->_myCart;
        $cart_info=$mycart->getCart();
        $good=new \app\Common\model\Goods();
        $good_list=$good->getList(['status'=>1],'all');
        $goodlist_new=array_combine(array_column($good_list,'id'),array_column($good_list,'good_name'));
        foreach ($cart_info['good_list'] as &$v){
            $v['good_name']=$goodlist_new[$v['good_id']];
        }
        showJson(0,'success',$cart_info);
    }
    //清除购物车
    public function clearCart(){
        if(empty(input('shop_id'))){
            showJson(-1,'添加失败，没找到门店');
        };
        $mycart=$this->_myCart;
        $mycart->delCart();
        showJson();
    }

    public function deleteGood(){
        if(empty(input('shop_id'))){
            showJson(-1,'添加失败，没找到门店');
        };
        if(empty(input('good_id'))){
            showJson(-1,'添加失败，没找到门店');
        };
        $mycart=$this->_myCart;
        $mycart->deleteGood(input('good_id'));
        showJson();
    }
}