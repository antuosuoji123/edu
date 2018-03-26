<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate;
use think\Db;
class Index extends Common{
    
    public function index(){

       return  $this ->fetch();    
    }

    public function left(){

       return $this->fetch();

    }

    public function welcome(){

        return 233;
    }
}

