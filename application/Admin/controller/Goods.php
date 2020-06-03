<?php


namespace app\Admin\controller;



class Goods
{
    public function postGood(){
        $good=new \app\Common\model\Goods();
        for($i=0;$i<=20;$i++){
            $data['good_sn']=rand(10000,99999);
            $name=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
            $data['good_name']=$name[rand(0,35)].$name[rand(0,35)];
            $data['sort_order']=rand(1,100);
            $data['cat_id']=rand(11,12);
            $data['shop_id']=1;
            $data['market_price']=rand(100,200);
            $data['shop_price']=rand(1,100);
            $data['status']=1;
            $data['original_img']=1;
            $data['thumb_img']=1;
            $data['last_update_time']=time();
            $data['create_time']=time();
            $data['good_describe']='卖得很好，真不错'.rand(1,500);
            //$res=$good->add($data);
        }


        print_r($res);
    }

}