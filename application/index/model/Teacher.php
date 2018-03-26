<?php

namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;
use think\Db;
class Teacher extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;

    public function getTeacher()
    {

        if (!empty($_GET)) {
            $id = $_GET['id'];
            $data = $this->where(['delete_time'=>null,'id'=>$id])->field('id,username,timeing,pic,goodclass, honor, introduce,background,motto')->select();
            return $data;
        }else{
            $data = $this->where('delete_time',null)->field('id,username, goodclass, honor, pic, introduce')->paginate(5);
            return $data;
        }
    }

    //other
    public function othert()
    {
        $id = $_GET['id'];
        $other = $this->where('id','NEQ',$id)->where('delete_time',null)->field('id,username,timeing')->select();
        return $other;
    }
}