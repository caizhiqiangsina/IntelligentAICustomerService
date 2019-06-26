<?php
namespace app\user\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->login();
//        return $this->fetch();
    }
    public function login()
    {
        return $this->fetch();
    }
    public function pc()
    {
        return $this->fetch();
    }
}
