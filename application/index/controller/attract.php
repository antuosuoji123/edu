<?php

namespace app\index\Controller;
use think\Controller;
class About extends Controller{

    public function show(){
          return $this->fetch();
    }

}