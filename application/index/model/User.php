<?php

namespace app\index\model;
use think\Model;
use think\Db;
use think\Requery;
use think\Session;
class User extends Model
{

    protected $autoWriteTimestamp = true;

    public function getUser($uid)
    {
        $dataa = Db::name('user')->where('uid',$uid)->select();
        $data = [];
        foreach ($dataa as $k=>$v) {
            $v['birthday'] = date('Y-m-d',$v['birthday']);
        }
        $data[$k] = $v;

        return $data;

    }

    //登录
    public function dlogin()
    {
            if (!empty($_POST)) {
            $name = $_POST['username'];
            $pwd = md5($_POST['password']);
            $result = Db::name('user')->where('username',$name)->find();
            if ($result['username'] == $name && $result['password'] == $pwd) {
                Session::set('name',$name);
                Session::set('uid',$result['uid']);
            } else {
                return false;
            }
        }
    }

    //注册
    public function register()
    {
        $data['username'] = $_POST['username'];
        $data['email'] = $_POST['email'];
        $data['phone'] = $_POST['phone'];
        $data['password'] = md5($_POST['password2']);
        date_default_timezone_set('Asia/Shanghai');
        $data['regtime'] = time();
        $result = Db::name('user')->insert($data);
        $userId = Db::name('user')->getLastInsId();
        if ($result) {
            Session::set('name',$data['username']);
            Session::set('uid',$userId);
        } else {
            echo "<script>alert('未知错误...请重新输入');history.go(-1)</script>";die;
        }
    }

    //phone
    public function ph()
    {
        $uid = session('uid');
        $phone = $_POST['mobile'];
        $data = Db::name('user')->where('uid',$uid)->update(['phone'=>$phone]);
    }




    //插入头像
    public function tx($uid,$pic)
    {
        $data = Db::name('user')->where('uid',$uid)->update(['picture'=>'/uploads/'.$pic]);
    }

    public function baoCun($uid)
    {
        $_POST['birthday'] = strtotime($_POST['birthday']);
        $data = Db::name('user')->where('uid',$uid)->update(['username'=>$_POST['username'],'sex'=>$_POST['sex'],'birthday'=>$_POST['birthday']]);
        dump($data);

    }



}