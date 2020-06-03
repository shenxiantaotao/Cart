<?php


namespace app\Admin\controller;


use think\Controller;
use think\Request;

class Base extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        if(empty(session('user_phone'))){
            return $this->fetch('/login');
        }
    }

}