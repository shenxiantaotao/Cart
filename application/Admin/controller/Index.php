<?php
namespace app\Admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('/test1');
    }
}
