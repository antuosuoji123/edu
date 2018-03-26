<?php
namespace app\index\Controller;
use think\Controller;
use think\Db;
use app\index\model\Teacher as tea;
class Teacher extends Controller{

    public function show()
    {
//        $hu = tea::all();
//        foreach ($hu as $k=>$v) {
//            dump($v['username']);
//        }
//        dump($hu);die;
//        $hu = Db::name('teacher')->field('username, goodclass, honor, introduce')->paginate(5);
        $page = model('Teacher')->getTeacher();
        $this->assign('page',$page);
        return $this->fetch();
    }




    public function teacherxq()
    {
        $other = model('Teacher')->othert();
        $t = model('Teacher')->getTeacher();
        $this->assign('v',$t);
        $this->assign('other',$other);
        return $this->fetch();
    }


}
