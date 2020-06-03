<?php


namespace app\Common\model;


class OrderGoods
{
    protected $pk='id';
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['order_id'])){
            $where['order_id']=$search['order_id'];
        }
        if(!empty($search['good_id'])){
            $where['good_id']=$search['good_id'];
        }
        if($page=='all'){
            //查询所有
            $res=db('order_goods')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('order_goods')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

    public function getById($id){
        if (empty($id)){
            return false;
        }else{
            return db('order_goods')->where('id',$id)->find();
        }
    }

    public function add($data,$insert_all=false){
        if($insert_all==false){
            return db('order_goods')->insertGetId($data);
        }else{
            return db('order_goods')->insertAll($data);
        }
    }

    public function update($id,$data){
        return db('order_goods')->where('id',$id)->update($data);
    }

    public function del($data){
        db('order_goods')->where($data)->delete();
    }

}