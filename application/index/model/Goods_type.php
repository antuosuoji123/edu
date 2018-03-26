<?php
namespace app\index\model;
use think\Db;
use think\Model;


/*无限极分类*/
class Goods_type extends Model{

    public function goods_sel(){
      $goods   = Db::name('goods_type');
      $info    = $goods->where("pid=0")->select();                  //获取一级分类
      $binfo   = array();
      $cinfo   = array();
    /*分类这个确实很牛逼.puls*/
      foreach ($info as $key => $value) {
        $info[$key]['child'] = array();
        $binfo = $goods->where("pid=".$value['id'])->select();      //获取二级分类
        foreach ($binfo as $k => $v) {
            array_push($info[$key]['child'],$v);                    //合并一级与二级分
        $info[$key]['child'][$k]['child2'] = array();               //祖装三级分类
        $cinfo = $goods->where("pid=".$v['id'])->select();          //获取三级分类   

            foreach ($cinfo as $v2) {
            array_push($info[$key]['child'][$k]['child2'],$v2);     //合并一,二,三级分类
            }
        }
      }
    // dump($info[0]['child'][0]);
      // dump($info);
  
          
           return $info;

    }
}
