<?php

namespace app\Api\controller;

use think\Session;

class Shop extends BaseController
{
    /**
     * 获取首页门店列表
     */
    public function getShopList(){
        $jingdu=input('jingdu')?:Session::get('jingdu');//经度
        $weidu=input('weidu')?:Session::get('weidu');//纬度
        $search['city']=input('city')?:Session::get('city');//城市名
        session('jingdu',$jingdu);
        session('weidu',$weidu);
        session('city',$search['city']);
        if(empty($jingdu)||empty($weidu)||empty($search['city'])){
            showJson(-1,'未上传定位');
        }
        $shop=new \app\Common\model\Shop();
        $orderby=input('orderby');//排序
        switch ($orderby){
            case 1:$orderby='shop_score DESC';break;
            case 2:$orderby='sale_number DESC';break;
            default:$orderby='';
        }
        $shop_list=$shop->getList($search,'all','',$orderby);
        //根据经纬度计算顾客与门店的距离
        foreach ($shop_list as $k=>&$v){
            $v['distance']=getDistance($v['latitude'],$v['longitude'],$weidu,$jingdu);
        }
        //按距离排序
        if($orderby==3){
            $arrcolunm=array_column($shop_list,'distance');
            array_multisort($arrcolunm,'SORT_ASC',$shop_list);//对距离进行顺序排序
        }

        echo json_encode(array('code'=>0,'message'=>'success','response'=>$shop_list),256);
        exit();
    }

    /**
     * 获取首页门店的分类列表,暂时是固定
     */

}