<?php


namespace app\Common\model;


class Goods
{
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['good_name'])){
            $where['good_name']=array('like','%'.$search['good_name'].'%');
        }
        if(!empty($search['good_sn'])){
            $where['good_sn']=array('like','%'.$search['good_sn'].'%');
        }
        if(!empty($search['cat_id'])){
            $where['cat_id']=$search['cat_id'];
        }
        if(!empty($search['status'])){
            $where['status']=$search['status'];
        }
        if(!empty($search['shop_id'])){
            $where['shop_id']=$search['shop_id'];
        }
        if($page=='all'){
            //查询所有
            $res=db('goods')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('goods')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

    public function getById($id){
        if (empty($id)){
            return false;
        }else{
            return db('order')->where('id',$id)->find();
        }
    }

    public function add($data){
        return db('goods')->insertGetId($data);
    }
    public function update($good_id){
        return db('goods')->where('id',$good_id)->update();
    }
    public function delete($good_id){
        return db('goods')->where('id',$good_id)->delete();
    }

}