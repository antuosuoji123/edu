<?php
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Goods_type;
use app\index\Model\Product;
use think\Db;
class Course extends Controller{
    
    public function show() {
        
        /*无线级分类*/
        $fenlei = new Goods_type();
        $info   = $fenlei -> goods_sel();
        $this   -> assign('info',$info);

        /*产品分类*/
        $data   = new Product();
        $data   = $data->select();
        $this   ->assign('data',$data);
        return $this->fetch();
       
    }

    //课程详情
    public function coursexq() {

        $cid = $_GET['cid'];
        $info = Db::name('product')->where('cid',$cid)->select();
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function cour_add()
    {
        $data['productid']      = input('post.cid');
        $data['originalprice']  = input('originalprice');
        $data['userid']         = session('uid');
        $data['price']          = input('post.price');
        $data['title']          = input('post.title');
        $data['createtime']     = time();
        $res = Db::name('cart')->insert($data);
    }

    public function ajax_show(){

        if(input('id')){
        $num = input('id');

        //二级分类
        $binfo =Db::name('Goods_type')->where('pid',$num)->field('name,id,pid')->select();
        //二级产品
        $cinfo =Db::name('product')->where('gid',$num)->select();
        //获取cid.gid=cid.获取大板块所有产品
        $cid   =$cinfo['0']['cid'];
        $cinfo =Db::name('product')->where('gid',$cid)->select(); 

        $data['binfo'] = $binfo;
        $data['cinfo'] = $cinfo;

        echo json_encode($data);
/*----------------二级分类---------------------------------------------*/
        }else if(input('cid')){
        $num = input('cid');
        $num = explode(',', $num);  
        //所在年级
        $cinfo =Db::name('Goods_type')->where('pid',$num[0])->select();

        //所在年级的产品
        //获取goods_type顶级分类.如pid=0.id=1
        $pid =Db::name('Goods_type')->where('id',$num[0])->select();
        $pid =Db::name('Goods_type')->where('id',$pid[0]['pid'])->select(); 
        // return $pid;
        $gid =Db::name('product')->where('gid',$pid[0]['id'])->select();
        $dinfo =Db::query("select * from shop_product where gid = ".$gid[0]['gid']." and title like '%".$num[1]."%'");


        $data['cinfo'] = $cinfo;
        $data['dinfo'] = $dinfo;

       echo json_encode($data);
/*---------------------三级分类--------------------------------------------------*/
        }else if(input('did')){
         $str = input('did');
         $arr = explode(',', $str);   
         // return $arr[1];
         /*获得顶级分类*/
         $pid = Db::name('Goods_type')->where('id',$arr[0])->select(); 
         $pid = Db::name('Goods_type')->where('id',$pid[0]['pid'])->select(); 
         $pid = Db::name('Goods_type')->where('id',$pid[0]['pid'])->select(); 
         /*获得顶级结束分类*/
         $gid =Db::name('product')->where('gid',$pid[0]['id'])->select();

         $gid = $gid[0]['gid'];

         $data = Db::query("select * from shop_product where gid = ".$gid." and title like '%".$arr[1]."%'");

         echo json_encode($data);

        }

    }
}
