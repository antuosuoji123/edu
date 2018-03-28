<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\Model\Goods_type;
use think\Db;
use think\Request;

class Product extends Common
{
    protected $resultSetType='collection';



    public function product_category() {

        return $this->fetch();
    }


    public function product_category_ajax(){

    $m = Db::name('Goods_type');
    $data = $m->field('id,pid,name')->select();
    echo json_encode($data,true);
    }

    //查询
    public function product_category_add() {

    //通过paths查询排序,得出结果.
    $data=Db::name('Goods_type')->field("*,concat(path,'-',id)as paths")->order('paths')->select();

    //遍历出$data数组想等价的值.
    foreach ($data as $key => $val) {
        $data[$key]['name'] = str_repeat("||----",$val['level']).$val['name'];
    }

    $this->assign('data',$data);
        return $this->fetch();
    }

    //增加
    public function product_add_fenlei(){

    $Goods_type = new Goods_type();
    $result     = $Goods_type->goods_add();
    if($result) {
      return $this->success('添加分类成功','product_category_add');
     }else{
    return $this->error('抱歉添加失败');
    }
    return $this->fetch();
    }

    public function product_del_fenlei(){

        $id     = $_GET['id'];
        $m      = Db::name('Goods_type');
        $data   = $m ->where("pid",$id)->select();
        if($data){
            $str = "分类下面还有子分类,不可删除";
            echo json_encode($str);
        }else{
            $rel = $m->delete($id);
            if($rel){
                echo 1;
            }
        }

    }

public function guodu() {

    //获得goods表的id,与name字段
     $arr    = input('post.');
     //查到id当前的信息获取pid的值;$info[0]['pid'];
     $info   =  Db::name('Goods_type')->where('id',$arr['id'])->select();
     //如果pid为0
     if($info[0]['pid']==0){
     $info   =  Db::name('product')->where('gid',$arr['id'])->select();
     $this->assign('info',$info);
     return $this->fetch('public/guodu');  
     }
     //通过pid的值,查询product表相关联的东西;
     $info   =  Db::name('Product')->where('gid',$info[0]['pid'])->select();
    //如果info为空
     if($info == null){
     //查到id当前的信息获取pid的值;$info[0]['pid'];
     $info   =  Db::name('Goods_type')->where('id',$arr['id'])->select();
     $info   =  Db::name('Goods_type')->where('id',$info[0]['pid'])->select();
     $info   =  Db::name('Goods_type')->where('id',$info[0]['pid'])->select();  
     $info   =  Db::name('Product')  ->where('gid',$info[0]['id'])->select(); 
     $info   =  Db::query("select * from shop_product where gid = ".$info[0]['gid']." and title like '%".$arr['name']."%'");
     $this->assign('info',$info);
     return $this->fetch('public/guodu');  
     }
     //获取pid所有版块的信息,在筛选;
     $info   = Db::query("select * from shop_product where gid = ".$info[0]['gid']." and title like '%".$arr['name']."%'");

     $this->assign('info',$info);
     return $this->fetch('public/guodu');  

}
    

    public function product_list() {
    
    $info = Db::name('Product')->where('cid=1')->select();  
    // $this->assign('info',$info);
    return $this->fetch();
    }


    public function product_add(){

    //通过paths查询排序,得出结果.
    $data=Db::name('Product')->field("gid,title,cid")->where('cid<5')->select();

    $this->assign('data',$data);
  

     // $res = Db::name('Product')->insert($arr);
     return $this->fetch();

    }
    public function add(){

        //获取图片信息;
        /*如果有图片或者视频*/
         $pic        = request()->file('piPic');
        if (!empty($pic)) {
        $info       = $pic->move(ROOT_PATH . 'public' . DS . 'uploads');
        $getPic     = $info->getSaveName();
        $getPic     = '/uploads/'.$getPic;
           //获取视频信息; 
        $video      = request()->file('video');
        $info       = $video->move(ROOT_PATH . 'public' . DS . 'uploads');
        $getVideo   = $info->getSaveName();
        $getVideo   = '/uploads/'.$getVideo;
       
        $data = [
        'title'    => input('post.title'),
        'law'      => input('post.law'),
        'gid'      => input('post.gid'),
        'price'    => input('post.price'),     
        'aprice'   => input('post.aprice'),
        'keci'     => input('post.keci'),
        'banrong'  => input('post.banrong'),
        'getVideo' => $getVideo,
        'getPic'   => $getPic,
   
        ];
         $res = Db::name('Product')->insert($data);
     if($res) {
      return $this->success('添加分类成功','product_add');
     }
    }
   /*如果有没有图片或者视频*/

        $data = [
        'title'    => input('post.title'),
        'law'      => input('post.law'),
        'gid'      => input('post.gid'),
        'price'    => input('post.price'),     
        'aprice'   => input('post.aprice'),
        'keci'     => input('post.keci'),
        'banrong'  => input('post.banrong'),
        ];

        $result = Db::name('Product')->insert($data);

     if($result) {
      return $this->success('添加分类成功','product_add');
     }
       
}



}























    /*
    
        // $arr = input('');
        // // 获取表单上传文件
        // $file = request()->file()['video'];
        // if (empty($file)) {
        // $this->error('请选择上传文件');
        // }
        // // 移动到框架应用根目录/public/uploads/ 目录下
        // $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        // $data['pic'] = $info->getSaveName()

     */