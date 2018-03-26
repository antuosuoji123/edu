<?php

namespace app\admin\controller;
use think\Controller;

class Member extends Common
{
    public function member_list() {
        

        return $this->fetch();
    }

    public function memberdel()
    {
        return $this->fetch();

    }

    public function memberlevel()
    {
        return $this->fetch();

    }

    public function memberscore()
    {
        return $this->fetch();

    }

    public function memberrecordbrowse()
    {
        return $this->fetch();

    }

    public function memberrecorddownload()
    {
        return $this->fetch();

    }

    public function membershare()
    {
        return $this->fetch();

    }


}