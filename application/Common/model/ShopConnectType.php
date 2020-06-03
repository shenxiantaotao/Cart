<?php


namespace app\Common\model;


class ShopConnectType
{
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['type_id'])){
            $where['type_id']=$search['type_id'];
        }
        if(!empty($search['shop_id'])){
            $where['shop_id']=$search['shop_id'];
        }
        if($page=='all'){
            //查询所有
            $res=db('shop_connect_type')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('shop_connect_type')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

}