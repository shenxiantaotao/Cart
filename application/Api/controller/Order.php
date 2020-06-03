<?php


namespace app\Api\controller;


use app\Common\model\OrderGoods;
use think\Exception;

class Order extends BaseController
{
    //提交订单
    public function postOrder(){
        $data['shop_id']=input('shop_id')?:session('shop_id');
        if(empty($data['shop_id'])){
            showJson(-1,'门店id不能为空');
        }
        $data['user_id']=session('user_id')?:showJson(-2,'用户登录超时，请重新登录');//登录用户id
        $data['order_number']='MT-'.$_SERVER['REQUEST_TIME'].$data['shop_id'].rand(10,99);//订单号
        $data['create_time']=$_SERVER['REQUEST_TIME'];//创建时间
        $data['status']=1;//状态  1、已下单  2、已处理  3、已完成 -1、已退款 4、已评价',
        $data['price']=input('price');//订单价格
        $data['preferential_price']=input('preferential_price');//优惠金额
        $data['user_name']=input('user_name');//收货人名称
        $data['phone']=input('phone');//收货人手机号
        $data['addr']=input('addr');//收货人地址
        $data['delivery_fee']=input('delivery_fee');//配送费  分
        $data['remark']=input('remark');//备注
        $data['pay_method']=input('pay_method')?:1;//支付方式
        $data['tableware_number']=input('tableware_number')?:1;//餐具数量
        $data['pack_fee']=input('pack_fee');//包装费
        if(empty($data['price'])||empty($data['user_name'])||empty($data['phone'])||empty($data['addr'])){
            showJson(-1,'参数不全,下单失败');
        }
        $data['pay_money']=$data['price'];
        $cart=$this->_myCart;
        $myCart=$cart->getCart();
        $order=new \app\Common\model\Order();
        $ordergood=new OrderGoods();
        $good=new \app\Common\model\Goods();
        $good_list=$good->getList(['shop_id'=>$data['shop_id']],'all');
        $good_list_id=array_column($good_list,'id');
        $good_list_name=array_column($good_list,'good_name');
        $good_list_new=array_combine($good_list_id,$good_list_name);

        $m=db();
        $m->startTrans();
        try{
            $orderid=$order->add($data);
            if($orderid){
                foreach ($myCart['good_list'] as $k=>$v){
                    $dataAll[$k]['order_id']=$orderid;
                    $dataAll[$k]['good_id']=$v['good_id'];
                    $dataAll[$k]['good_name']=$good_list_new[$v['good_id']];
                    $dataAll[$k]['good_number']=$v['good_number'];
                    $dataAll[$k]['good_price']=$v['shop_price'];

                }
                $ordergoodid=$ordergood->add($dataAll);
            }
            $m->commit();
        }catch (Exception $e){
            $m->rollback();
            showJson(-1,'faild',$e->getMessage());
        }
        showJson(0,'',$orderid);
    }

    //查看用户订单列表
    public function getOrderList(){
        $user_id=session('user_id');
        if(empty($user_id)){
            showJson(-2,'用户信息已过期，请重新登录！');
        }
        $order=new \app\Common\model\Order();
        $order_list=$order->getList(['user_id'=>$user_id],'all');

        $order_good=new OrderGoods();
        foreach ($order_list as $k=>&$v){
            $v['order_good_list']=$order_good->getList(['order_id'=>$v['id']],'all');
        }
        showJson(0,'',$order_list);
    }
}