<?php
namespace app\index\Controller;
use think\Controller;
class Room extends Common{

    public function show(){
        
        return $this->fetch();
    }
}
