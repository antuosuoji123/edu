<?php
namespace app\admin\model;
use think\Model;

class Dingdan extends Model
{
    public function list_num()
    {
        return $this->where(['isdel'=>0])->count();
    }

    public function change_num()
    {
        return $this->where(['isdel'=>1])->count();
    }

}
