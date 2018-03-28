<?php

namespace app\index\Controller;
use think\Controller;
class About extends Common{

    public function show(){
          return $this->fetch();
    }

}