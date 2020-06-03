<?php


namespace app\Common\model;


use think\Db;
use think\Model;

class User
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
            $res=db('user')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('user')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

    public function getById($id){
        if (empty($id)){
            return false;
        }else{
            return db('user')->where('id',$id)->find();
        }
    }

    public function add($data){
        return db('user')->insertGetId($data);
    }

    public function update($id,$data){
        return db('user')->where('id',$id)->update($data);
    }

    public function del($data){
        db('user')->where($data)->delete();
    }

}