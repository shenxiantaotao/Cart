<?php


namespace app\Common\model;


class Shop
{
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['shop_name'])){
            $where['shop_name']=array('like','%'.$search['shop_name'].'%');
        }
        if(!empty($search['addr'])){
            $where['addr']=array('like','%'.$search['addr'].'%');
        }
        if(!empty($search['longitude'])){
            $where['longitude']=array('like','%'.$search['longitude'].'%');
        }
        if(!empty($search['city'])){
            $where['city']=array('like','%'.$search['city'].'%');
        }
        if(!empty($search['latitude'])){
            $where['latitude']=array('like','%'.$search['latitude'].'%');
        }
        if($page=='all'){
            //查询所有
            $res=db('shop')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('shop')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

}