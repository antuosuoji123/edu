<?php

namespace app\index\Controller;
use think\Controller;

class School extends Controller{
    public function show(){
        return $this->fetch();
    }

    public function schoolxq()
    {
        return $this->fetch();
    }
}