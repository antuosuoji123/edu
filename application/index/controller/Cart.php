<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Address;
use app\index\model\Cart as Car;

class Cart extends Common {

    public function cart() {

        $uid  = session('uid');
        //dump(session('name'));
        //dump(session('uid'));

        if(!empty($_GET['cid'])){
        $data   = Db::name('Cart')->where('del=0')->where('uid',$uid)->select();
        $this   ->assign('data',$data);
        //dump($data);
        $data = new Address;
        $res = $data->getADdress($uid);
        // dump($res);
        $this->assign('res',$res);
        return  $this->fetch();
        }
        return $this->fetch();
        }

    public function carts() {       
       
        $uid        = session('uid');
        if(!empty($_GET['cid'])){
        $cid        = $_GET['cid'];
        $data       = Db::name('Product')->where('cid',$cid)->select();
        $time       = time();
        $info       = [
        'uid'       => $uid,
        'cid'       => $data[0]['cid'],
        'title'     => $data[0]['title'],
        'price'     => $data[0]['price'],
        'aprice'    => $data[0]['aprice'],
        'getPic'    => $data[0]['getPic'],
        'getVideo'  => $data[0]['getVideo'],
        'addtime'   => $time,
                        ];
        $res       = Db::name('Cart')->insert($info);
        
        header('Refresh:0,Url=cart.html?cid='.$cid);   

        }
    }


    public function CartAjax(){

        $id = input('post.id');
        /*删除购物车*/
        $res = Db::name('Cart')->where(['id'=>$id])->update(['del'=>'1']);

        if($res){
            echo 1;
        }

    }


    public function commit_indent()
    {
        //地址id
        $id = input('id');
        $uid = session('uid');
       // $time = Db::name('user')->field()->find($uid);
        //$car = new Car;
        $data = Db::name('Cart')
        ->alias('c')
        ->join('user u','u.uid=c.uid and c.addtime > u.lasttime')
        ->join('address a',"a.id = $id and a.uid = c.uid")
        ->where("del=0 and c.uid = $uid")
        ->field('c.cid,u.uid,u.username,c.title,c.getPic,c.getVideo,a.phone,a.consignee,u.picture')
        ->select();
        $res = Db::name('indent')->insertAll($data);

        if($res){
        $dizhi = Db::name('address')->where(['id'=>$id])->find();
        $data  = [
        'paid'          =>  input('paid'),
        'address'       =>  $dizhi['province'] . $dizhi['city'] . $dizhi['county'],
        'create_time'   =>  time(),
        'dnum'          =>  time().'qf'.substr(str_shuffle('123456789saxvn'),0,5),
        'uid'           =>  $uid,
        ];

        $result = Db::name('dingdan')->insert($data);
        }
          
    }

    

}


