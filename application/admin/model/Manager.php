<?php

namespace app\admin\Model;

use think\Model;

class Manager extends Model {

    public function log(){

       $user = model('Manager')->count('mg_id');
       $user = $user+1;

       for($i = 1; $i<7; $i++){
       $user = $this->get($i)->toArray();
        dump($user);
      
       }

    }

}