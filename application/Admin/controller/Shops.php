<?php


namespace app\Admin\controller;


use app\Common\model\ShopType;
use think\Controller;

class Shops extends Controller
{
    public function getShopList(){
        $page=input('page');
        $shoptype=new ShopType();
        $shoptype_list=$shoptype->getList([],$page,2);
        $this->assign('shop_t_list',$shoptype_list);
        $this->assign('page', $page);
        return $this->fetch('/shop_type_list');
    }

}