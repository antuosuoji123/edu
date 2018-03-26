<?php

namespace app\index\model;
use think\Model;
use think\Db;
class Address extends Model
{
    public function getAddress($uid){
        $data = Db::name('address')->where(['isdel'=>'0','uid'=>"$uid"])->select();
        return $data;
    }
    public function getId($id)
    {
        $data = Db::name('address')->where(['isdel'=>'0','id'=>"$id"])->select();
        return $data;
    }

    public function ins($uid)
    {
        $data = ['uid'=>$uid,'province'=>$_POST['sheng'],'city'=>$_POST['s'],'county'=>$_POST['x'],'address'=>$_POST['address'],'phone'=>$_POST['mobile'],'consignee'=>$_POST['consignee']];
        $in = Db::name('address')->insert($data);
    }

    public function up($id)
    {
        if (!empty($_POST)) {
            $data = Db::name('address')->where('id',$id)->update(['consignee'=>$_POST['consignee'],'province'=>$_POST['sheng'],'city'=>$_POST['s'],'county'=>$_POST['x'],'address'=>$_POST['address'],'phone'=>$_POST['mobile']]);
            return $data;
        }


    }

    public function del($id)
    {
        $data = Db::name('address')->where('id',$id)->update(['isdel'=>'1']);
        dump($data);
    }

    public function def($id,$uid)
    {
        $data = Db::name('address')->where('uid',$uid)->update(['is_default'=>'0']);
        $dataa = Db::name('address')->where('id',$id)->update(['is_default'=>'1']);

        dump($data);
        dump($dataa);
    }
}