<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Picture;
class Picturelist extends Common {

    public function picture_list()
    {
        $data = model('Picture')->getP();
        $count = model('Picture')->count();
        $this->assign('v',$count);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function picture_add()
    {
        return $this->fetch();
    }

    public function add()
    {
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
//            $data = new User;
            $pic = $info->getSaveName();
//            $data->tx($uid,$pic);
//            $this->redirect('/index/person/info');
            $data = new Picture;
            $data = $data->add($pic);
            echo '<script>alert("添加成功");window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
       parent.layer.close(index);</script>';
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    //up
    public function picture_up()
    {
       $data = model('Picture')->getP();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function up()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');

        if (!$file) {
            $data = model('Picture')->up();
            echo '<script>window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
       parent.layer.close(index);</script>';die;
//            echo '此图片本网站暂不支持，请换一个'; die;
        }
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
//            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//            $data = new User;
            $pic = $info->getSaveName();
//            $data->tx($uid,$pic);
//            $this->redirect('/index/person/info');
            $data = model('Picture')->add($pic);
            echo '<script>alert("修改成功");window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
       parent.layer.close(index);</script>';die;
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }

    }

    //del
    public function del()
    {
        if (!empty($_POST['checkb'])) {

            model('Picture')->del();
            $this->redirect('/admin/picturelist/picture_list');die;
        }
        if (!empty($_GET)) {
        $data = model('Picture')->del();die;
        }
        $this->redirect('/admin/picturelist/picture_list');die;


    }

}
