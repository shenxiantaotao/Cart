<?php


namespace app\Common\model;


class order
{
    protected $pk='id';
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['order_number'])){
            $where['order_number']=array('like','%'.$search['order_number'].'%');
        }
        if(!empty($search['phone'])){
            $where['phone']=$search['phone'];
        }
        if(!empty($search['shop_id'])){
            $where['shop_id']=$search['shop_id'];
        }
        if(!empty($search['status'])){
            $where['status']=$search['status'];
        }
        if(!empty($search['user_id'])){
            $where['user_id']=$search['user_id'];
        }
        if($page=='all'){
            //查询所有
            $res=db('order')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('order')->where($where)->order($orderby)->paginate($page_size);
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
        return db('order')->insertGetId($data);
    }

    public function update($id,$data){
        return db('order')->where('id',$id)->update($data);
    }

    public function del($data){
        db('order')->where($data)->delete();
    }

}