<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Indent;
use app\admin\model\Dingdan;

class Orders extends Controller
{
    public function order_list()
    {
        $in = new Indent();
        $ding = new Dingdan();
        $res = $in->indent_list();
        $this->assign('res',$res);
        $num = $ding->list_num();
        $this->assign('num',$num);
        return  $this->fetch();
    }

    public function order_edit()
    {
        $id = input('id');
        $ding = new Dingdan();
        $res = $ding->table('shop_indent i,shop_dingdan d')->where('i.uid = d.uid')->where('isdel = 0')->where(['d.did'=>$id])->group("d.dnum")->select();
        $this->assign('res',$res);
        return $this->fetch();
    }

    public function order_change()
    {
        $in = new Indent();
        $ding = new Dingdan();
        $res = $in->change_list();
        $this->assign('res',$res);
        $num = $ding->change_num();
        $this->assign('num',$num);
        return $this->fetch();
    }

     public function up_order()
    {
        $in = new Indent();
        $ding = new Dingdan();
       
        $id                = input('id');
        $uid = $ding->field('uid')->where(['did'=>$id])->find()->toArray();
        $uid = $uid['uid'];
        $data1['phone']     = input('post.phone');
        $data1['username']  = input('post.username');
        $result             = $in->where(['uid' => $uid])->update($data1);
        $data['dnum']       = input('post.dnum');
        $data['ispay']      = input('post.ispay');
        $data['paid']       = input('post.paid');
        $data['address']    = input('post.address');
        $data['isback']     = input('post.isback');
        $data['ostatus']    = input('post.ostatus');
        $res                = $ding->where(['did' => $id])->update($data);
        if ($res) {
            echo 1;
        } elseif ($result) {
            echo 1;
        } elseif ($res && $result) {
             echo 1;
        }else{
            echo '滚';
        }


    }


    public function back_thing()
    {
        if (input('id')) {

            $ding = new Dingdan();
            $id  = input('id');
            $res = $ding->where(['did' => $id])->update(['isback' => 4]);
            if ($res) {
                echo 1;
            }
        }
    }


}
