<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
//use app\admin\model\Comment as AComment;
class Comment extends Common {

    public function commentlist()
    {
        $data = model('Comment')->getC();
        $count = model('Comment')->count();
        $this->assign('count',$count);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function feedbacklist()
    {
        return $this->fetch();
    }

    //del
    public function del()
    {
        if (!empty($_POST['checkb'])) {

            model('Comment')->del();
            $this->redirect('/admin/comment/commentlist');die;
        }
        if (!empty($_GET)) {
            $data = model('Comment')->del();die;
        }
        $this->redirect('/admin/comment/commentlist');die;

    }


}
