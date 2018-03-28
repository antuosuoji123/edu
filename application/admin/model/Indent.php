<?php
namespace app\admin\model;
use think\Model;

class Indent extends Model
{
    public function indent_list()
    {
    return $this->table('shop_indent i,shop_dingdan d')->where('i.uid = d.uid')->where('isdel = 0')->group("d.dnum")->select();
    }

    public function change_list()
    {
    return $this->table('shop_indent i,shop_dingdan d')->where('i.uid = d.uid')->where('isdel = 1')->group("d.dnum")->select();
    }



}