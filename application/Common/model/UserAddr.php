<?php


namespace app\Common\model;


class UserAddr
{
    protected $pk='id';
    public function getList($search=[],$page=1,$page_size=10,$orderby=''){
        $where=[];
        if(!empty($search['u_name'])){
            $where['u_name']=array('like','%'.$search['u_name'].'%');
        }
        if(!empty($search['u_phone'])){
            $where['phone']=array('like','%'.$search['u_phone'].'%');
        }
        if(!empty($search['user_id'])){
            $where['user_id']=$search['user_id'];
        }
        if($page=='all'){
            //查询所有
            $res=db('user_addr')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('user_addr')->where($where)->order($orderby)->paginate($page_size);
        }
        return $res;
    }

    public function getById($id){
        if (empty($id)){
            return false;
        }else{
            return db('user_addr')->where('id',$id)->find();
        }
    }

    public function add($data){
        return db('user_addr')->insertGetId($data);
    }

    public function update($id,$data){
        return db('user_addr')->where('id',$id)->update($data);
    }

    public function del($data){
        db('user_addr')->where($data)->delete();
    }
}