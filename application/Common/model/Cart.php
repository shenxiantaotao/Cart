<?php


namespace app\Common\model;


class Cart
{
    //初始化购物车
    private $_cart=array(
        'sum_price'=>0,//总价
        'good_list'=>[],//商品列表
        'sum_number'=>0 //总数
    );

    //获取购物车
    public function getCart(){
        return $this->_cart;
    }

    //添加商品到购物车
    public function add($goodinfo,$number=1){
        $cart=$this->_cart;
        //当购物车为空时
        if(empty($cart['good_list'])){
            $good=array(
                'good_id'=>$goodinfo['good_id'],
                'good_number'=>$number,
                'price'=>$goodinfo['shop_price']
            );
            $this->_cart['good_list'][]=$good;
            $this->_cart['sum_price']=$number*$goodinfo['shop_price']>0?$number*$goodinfo['shop_price']:0;
            $this->_cart['sum_number']=$number>0?$number:0;
            return 1;
        }else{
            //当购物车商品时
            $coulumn_good_id=array_column($this->_cart['good_list'],'good_id');
            foreach ($this->_cart['good_list'] as $k=>&$v){
                //如果该商品不在购物车中
                if(!in_array($goodinfo['good_id'],$coulumn_good_id)){
                    $good=array(
                        'good_id'=>$goodinfo['good_id'],
                        'good_number'=>$number,
                        'price'=>$goodinfo['shop_price']
                    );
                    $this->_cart['good_list'][]=$good;
                    $this->_cart['sum_price']=$cart['sum_price']+$number*$goodinfo['shop_price']>0?$cart['sum_price']+$number*$goodinfo['shop_price']:0;
                    $this->_cart['sum_number']=$cart['sum_number']+$number>0?$cart['sum_number']+$number:0;
                    return 1;
                    //如果该商品已存在购物车中
                }else if($v['good_id']==$goodinfo['good_id']){
                    $good=array(
                        'good_id'=>$goodinfo['good_id'],
                        'good_number'=>$v['good_number']+$number>0?$v['good_number']+$number:0,
                        'price'=>$goodinfo['shop_price']
                    );
                    //如果商品减少为0时,从购物车删除掉
                    if($good['good_number']==0){
                        $this->_cart['sum_price']=$cart['sum_price']+$number*$goodinfo['shop_price']>0?$cart['sum_price']+$number*$goodinfo['shop_price']:0;
                        $this->_cart['sum_number']=$cart['sum_number']+$number>0?$cart['sum_number']+$number:0;
                        unset($this->_cart['good_list'][$k]);
                        return 1;
                    }
                    $v=$good;
                    $this->_cart['sum_price']=$cart['sum_price']+$number*$goodinfo['shop_price']>0?$cart['sum_price']+$number*$goodinfo['shop_price']:0;
                    $this->_cart['sum_number']=$cart['sum_number']+$number>0?$cart['sum_number']+$number:0;
                    return 1;
                }
            }
            //给商品数组列表从新建立索引
            $this->_cart['good_list']=array_values($this->_cart['good_list']);
        }
    }

    //删除购物车
    public function delCart(){
        return $this->_cart=array(
            'sum_price'=>0,//总价
            'good_list'=>[],//商品列表
            'sum_number'=>0 //总数
        );
    }

    //删除购物车某件商品
    public function deleteGood($good_id){
        $cart=$this->_cart;
        foreach ($cart['good_list'] as $k=>$v){
            if($v['good_id']==$good_id){
                $cart['sum_price']=$cart['sum_price']-$v['good_number']*$v['price'];
                $cart['sum_number']=$cart['sum_number']-$v['good_number'];
                unset($cart['good_list'][$k]);
            }
        }
        $cart['good_list']=array_values($cart['good_list']);
        $this->_cart=$cart;
        return 1;
    }
}