<?php
namespace app\index\Controller;
use think\Controller;
class Room extends Controller{

    public function show(){
        
        return $this->fetch();
    }
}
