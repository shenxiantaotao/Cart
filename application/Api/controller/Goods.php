<?php


namespace app\Api\controller;


use app\Common\model\GoodsCategory;
use think\Session;

class Goods extends BaseController
{
    /**
     * 获取门店商品信息
     */
    public function getShopGoods(){
        $shop_id=input('shop_id')?:Session::get('shop_id');//门店id
        session('shop_id',$shop_id);

        $goodCate=new GoodsCategory();
        $good=new \app\Common\model\Goods();

        //根据门店id，获取门店商品分类
        $goodCateList=$goodCate->getList(['shop_id'=>$shop_id,'is_use'=>1],'all');
        //根据门店商品分类id，获取每个分类下的商品
        foreach ($goodCateList as $k=>&$v){
            $v['goodList']=$good->getList(['cat_id'=>$v['id'],'status'=>1],'all');
        }
        showJson(0,'success',$goodCateList);
    }


    public function getGoodList(){
        $shop_id=input('shop_id')?:Session::get('shop_id');//门店id
        session('shop_id',$shop_id);
        $good=new \app\Common\model\Goods();
        $goodlist=$good->getList(['shop_id'=>$shop_id,'status'=>1],'all');
        showJson(0,'success',$goodlist);
    }

}