<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Details;
class Article extends Common {


    //like
    public function like()
    {
        $lk = $_POST['like'];
        $classid = $_GET['classid'];
        $data = new Details;
        $class = $data->getClass($classid);
        $data =model('Details')->like($classid);
//        $data = $data->getDetails($classid);
        $count = Db::name('details')->where(['classid'=>$classid,'isdel'=>0])->where('title','like','%$lik%')->count();
        $this->assign('count',$count);

        $this->assign('data',$data);
        $this->assign('class',$class);

        return $this->fetch();
    }
    //公司新闻
    public function company_article()
    {

        $data = new Details;
        $classid = 1;
        $class = $data->getClass($classid);
        $data = $data->getDetails($classid);
        $count = model('Details')->count($classid);
        $this->assign('count',$count);
        $this->assign('classid',$classid);
        $this->assign('data',$data);
        $this->assign('class',$class);
        return $this->fetch();
    }

    //行业新闻
    public function hyarticle()
    {
        $data = new Details;
        $classid = 2;
        $class = $data->getClass($classid);
        $data = $data->getDetails($classid);
        $count = model('Details')->count($classid);
        $this->assign('count',$count);
        $this->assign('data',$data);
        $this->assign('classid',$classid);
        $this->assign('class',$class);
        return $this->fetch();
    }

    //家庭教育
    public function familly_article()
    {
        $data = new Details;
        $classid = 3;
        $class = $data->getClass($classid);
        $data = $data->getDetails($classid);
        $count = model('Details')->count($classid);
        $this->assign('classid',$classid);
        $this->assign('count',$count);
        $this->assign('data',$data);
        $this->assign('class',$class);
        return $this->fetch();
    }

    //删除
    public function del()
    {
        $id = $_GET['id'];
        $data = new Details;
        $data->del($id);

    }
    //批量删除
    public function mdel()
    {
        $classid = $_GET['classid'];
        if (!empty($_POST['checkb'])) {
            $data = new Details;
        $data->model();
            if ($classid == 1) {
                $this->redirect('company_article');
            } else if ($classid ==2 ) {
                $this->redirect('hyarticle');
            } else if ($classid ==3 ) {
                $this->redirect('familly_article');
            }
        }
        if ($classid == 1) {
            echo "<script>alert('修改成功');</script>";
            $this->redirect('company_article');
        } else if ($classid ==2 ) {
            $this->redirect('hyarticle');
        } else if ($classid ==3 ) {
            $this->redirect('familly_article');
        }


//        if ($classid == 1) {
//            $this->redirect('/admi');
//        }
    }

    //add
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

            $pic = $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
        $uid = session('uid');
        $data = new Details;
        $data->add($uid,$pic);
        echo '<script>alert("更新成功");window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
       parent.layer.close(index);</script>';

    }
//        $uid = session('uid');
//        $id = $_GET['id'];
//        $data = new Details;
//        $data->up($id);
//
//        echo '<script>alert("更新成功");window.parent.location.reload();
//        var index = parent.layer.getFrameIndex(window.name);
//       parent.layer.close(index);</script>';
    public function up()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');

        if (!$file) {
            $data = model('Details')->up();
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
            $uid = session('uid');
            $data = model('Details')->add($uid,$pic);
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

    //add
    public function article_add()
    {
        $cid = $_GET['classid'];
        $this->assign('cid',$cid);
        return $this->fetch();
    }

    //update
    public function article_up()
    {
        $id = $_GET['id'];
        $data = new Details;
        $data = $data->getAlone($id);
        $this->assign('data',$data);
//        dump($data);die;
        return $this->fetch();
    }

}
