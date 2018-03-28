<?php
namespace app\index\Controller;
use think\Controller;
class Details extends Common{

    public function show()
    {
        $page = model('Details')->getD();
        $elite = model('Details')->elite();
        $this->assign('elite',$elite);
        $this->assign('page',$page);
        return $this->fetch();
    }

    //公司
    public function company()
    {
        return $this->fetch();
    }

    //公司
    public function hy()
    {
        return $this->fetch();
    }

    //家庭
    public function familly()
    {
        return $this->fetch();
    }

    //详情
    public function detailsxq()
    {
        $data = model('Details')->getD();
        $this->assign('v',$data);
        return $this->fetch();
    }
}
