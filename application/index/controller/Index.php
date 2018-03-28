<?php
namespace app\index\Controller;
use app\index\Model\Goods_type;
use think\Controller;
class Index extends Controller{

    public function index() {

      $fenlei =   new Goods_type();
      $info = $fenlei -> goods_sel();
      $this -> assign('info',$info);
        return $this->fetch();
    }


}
