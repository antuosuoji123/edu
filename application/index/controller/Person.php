<?php
namespace app\index\Controller;
use think\Controller;
use think\Session;
use think\Db;
use app\index\model\Address;
use app\index\model\User;
class Person extends Controller{

    public function index(){

        return $this->fetch();
    }


    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        if (!$file) {
           echo '此图片本网站暂不支持，请换一个'; die;
        }
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

       if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
//            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $data = new User;
            $uid = session('uid');
            $pic = $info->getSaveName();
            $data->tx($uid,$pic);
            $this->redirect('/index/person/info');

            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }





    public function sui()
    {
        return $this->fetch();
    }

















    //我的订单
    public function mydingd()
    {
        return $this->fetch();
    }

    //代付款
    public function daifk()
    {
        return $this->fetch();

    }

    //处理中
    public function chuliing()
    {
        return $this->fetch();

    }



    //我的评价
    public function mycomment()
    {
        return $this->fetch();
    }

    //待评论订单
    public function daicomment()
    {
        return $this->fetch();
    }


    //以评论
    public function yicomment()
    {
        return $this->fetch();
    }


    //我的足迹
    public function visitlog()
    {
        return $this->fetch();
    }

    //个人信息
    public function info()
    {

        $uid = Session('uid');
        $data = new User;
        $hu = $data->getUser($uid);
        $this->assign('hu',$hu);
       return $this->fetch();

    }


    public function baocun()
    {
        $uid = session('uid');
        $bc = new User;
        $bc->baoCun($uid);
        $this->redirect('/index/person/info');

    }

    //报名信息管理
    public function address()
    {
        $uid = session('uid');
        $data = new Address;
        $data = $data->getADdress($uid);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //增加地址
    public function dizhi()
    {

        return $this->fetch();
    }
    //修改地址
    public function xdizhi()
    {
        $id = $_GET['id'];
        $data = new Address;
        $data = $data->getId($id);
        $this->assign('data',$data);
        return $this->fetch();

    }

    public function dz()
    {
        $uid = session('uid');
        $data =new Address;
        $data->ins($uid);
        echo '<script>alert("添加成功");window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
       parent.layer.close(index);</script>';

    }

    public function xdz()
    {
        if (!empty($_GET)) {
            $id = $_GET['id'];
            $data =new Address;
            $data->up($id);
            echo '<script>alert("更新成功");window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
       parent.layer.close(index);</script>';
        }




    }
    public function testStatic() {
        $a = ['fei'=>1];
        $hu = Db::name('fei')->insert($a);
        $hu = Db::name('fei')->getLastInsID();
        if ($hu%2 == 0) {
            echo 1;
        } else {
            echo 2;
        }
    }
    //删除
    public function del()
    {
        $id = $_GET['id'];
        $data = new Address;
        $data->del($id);
        $this->redirect('/index/person/address');
    }
    //默认
    public function def()
    {
         $id = $_GET['id'];
        $uid = session('uid');
        $data = new Address;
        $data->def($id,$uid);
        $this->redirect('/index/person/address');

    }



    //安全设置
    public function safetyset()
    {
        session::set('iid','1111');
        return $this->fetch();

    }

    //绑定手机
    public function infophone()
    {
        if (!empty($_POST)) {
            $data = new User;
            $data->ph();
            $this->redirect('/index/person/infophone');

        }
        $uid = session('uid');
        $data = new User;
        $data = $data->getUser($uid);
        $phone = $data['0']['phone'];
        $this->assign('phone',$phone);
        $yzm = session('randCount');

        return $this->fetch();
    }

    //验证码
    public function yzm()
    {
        $yzm = session('yzm');
        $data = $_POST['name'];
        if ($yzm == $data) {
          echo 1;
        }else{
            echo 2;
        }
    }


    //绑定邮箱
    public function infoemail()
    {
        return $this->fetch();
    }

    //infopwd
    public function infopwd()
    {

        return $this->fetch();
    }
    public function lpwd()
    {
        $data = new User;
       dump($_POST);
    }



}
