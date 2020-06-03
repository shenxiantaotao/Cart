<?php


namespace app\Common\model;

use think\Db;
use think\Model;

class ShopType extends Model
{
    public function getList($search=[],$page=1,$page_size=10,$orderby='sort ASC'){
        $where=[];
        if(!empty($search['type_name'])){
            $where['type_name']=array('like','%'.$search['type_name'].'%');
        }
        if($page=='all'){
            //查询所有
            $res=db('shop_type')->where($where)->order($orderby)->select();
        }else{
            //分页查询
            $res=db('shop_type')->where($where)->order($orderby)->paginate($page_size,true,[
                'type' => 'bootstrap',
                'var_page' => 'page',
            ])->toArray();
            $count=db('shop_type')->where($where)->count();
            $res['total']=$count;

        }
        return $res;
    }

}