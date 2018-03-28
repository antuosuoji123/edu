<?php
namespace app\index\controller;
use app\index\Model\Goods_type;

use think\Controller;
use think\Db;
use think\org\Auth;
use think\Session;

class Common extends Controller {
    // 当任何函数加载的时候会调用此函数
    public function _initialize() {
        /*无线级分类*/
        $fenlei = new Goods_type();
        $info   = $fenlei -> goods_sel();
        $this   -> assign('info',$info);
    }
}
