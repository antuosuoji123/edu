<?php

namespace app\index\Controller;
use think\Controller;

class Calendar extends Common{

    public function show(){

        return $this->fetch();
    }

}