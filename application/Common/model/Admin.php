<?php


namespace app\Common\model;


class Admin
{
    protected $pk='id';
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['user_name'])){
            $where['user_name']=array('like','%'.$search['user_name'].'%');
        }
        if(!empty($search['phone'])){
            $where['phone']=array('like','%'.$search['phone'].'%');
        }
        if($page=='all'){
            //查询所有
            $res=db('admin')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('admin')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

    public function getById($id){
        if (empty($id)){
            return false;
        }else{
            return db('admin')->where('id',$id)->find();
        }
    }

    public function add($data){
        return db('admin')->insertGetId($data);
    }

    public function update($id,$data){
        return db('admin')->where('id',$id)->update($data);
    }

    public function del($data){
        db('admin')->where($data)->delete();
    }


}