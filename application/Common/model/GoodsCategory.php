<?php


namespace app\Common\model;


class GoodsCategory
{
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['cat_name'])){
            $where['cat_name']=array('like','%'.$search['cat_name'].'%');
        }
        if(!empty($search['is_use'])){
            $where['is_use']=$search['is_use'];
        }
        if(!empty($search['shop_id'])){
            $where['shop_id']=$search['shop_id'];
        }
        if($page=='all'){
            //查询所有
            $res=db('goods_category')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('goods_category')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

}