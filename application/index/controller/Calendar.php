<?php

namespace app\index\Controller;
use think\Controller;

class Calendar extends Controller{

    public function show(){

        return $this->fetch();
    }

}