<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 根据经纬度计算两点之间的距离
 * @param $lat1
 * @param $lng1
 * @param $lat2
 * @param $lng2
 * @return int
 */
function getDistance($lat1, $lng1, $lat2, $lng2){

    //将角度转为狐度

    $radLat1=deg2rad($lat1);//deg2rad()函数将角度转换为弧度

    $radLat2=deg2rad($lat2);

    $radLng1=deg2rad($lng1);

    $radLng2=deg2rad($lng2);

    $a=$radLat1-$radLat2;

    $b=$radLng1-$radLng2;

    $s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137;

    return $s;
}

/**
 * 输出json格式数据
 * @param int $code
 * @param string $message
 * @param string $response
 */
function showJson($code=0,$message='success',$response=''){
    echo json_encode(array('code'=>$code,'message'=>$message,'response'=>$response),256);exit();
}

/**
 * 界面输出错误提示
 * @param string $message
 */
function showMessage($message='操作失败！'){
    echo '<script> alert(\''.$message.'\');history.go(-1);</script>';
    exit();
}

