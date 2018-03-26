<?php

namespace app\index\model;
use think\Model;

class Details extends Model{
    protected $autoWriteTimestamp = true;

    //查找产品信息
    public function getD()
    {
        if (!empty($_GET)) {
            if (!empty($_GET['page'])) {
                $data = $this->where('isdel',0)->field('id, title, content, update_time, hits, pic, classid')->order(['elite desc','istop desc'])->paginate(10);
                return $data;
            } else{
                $id = $_GET['id'];
                $data = $this->where(['isdel'=>0,'id'=>$id])->field('id, title, content, update_time, hits, pic')->select();
                return $data;
            }



        }else{
            $data = $this->where('isdel',0)->field('id, title, content, update_time, hits, pic, classid')->order(['elite desc','istop desc','id desc'])->paginate(10);
            return $data;
        }
    }

    //精华 最新
    public function elite()
    {
        $data = $this->where(['isdel'=>0,])->where('elite','NEQ',0)->field('id, classid, pic, title')->select();
        return $data;
    }


}