<?php

namespace app\index\controller;
use think\Controller;
use think\org\Auth;

class Users extends Common{

    public function index(){

    return $this->fetch();

    }

}