<?php
namespace app\admin\controller;
use think\Controller;
class System extends Common
{
    public function systembase()
    {
        return $this->fetch();
    }

    public function systemcategory()
    {
        return $this->fetch();
    }

    public function systemdata()
    {
        return $this->fetch();
    }

    public function systemshielding()
    {
        return $this->fetch();
    }

    public function systemlog()
    {
        return $this->fetch();
    }
}
