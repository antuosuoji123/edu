<?php

namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;
use think\Db;
class Picture extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;

    public function getP()
    {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $data = $this->where('id',$id)->select();
            return $data;
        }
//        $data = new Picture;
        $data = $this->where('delete_time',null)->select();
        return $data;
    }

    //count
    public function count()
    {
        $count = $this->where('delete_time',null)->count();
        return $count;
    }

    //add
    public function add($pic)
    {
        if (!empty($_GET['id'])) {
            $id =$_GET['id'];
            $data = Picture::get($id);
            $data->path_url ='/uploads/'.$pic;
            $data->save($_POST);
        }else{
            $data = new Picture;
            $data->path_url = '/uploads/'.$pic;
            $data->save($_POST);
        }



    }

    //不改图片上传
    public function up()
    {
        $id = $_GET['id'];
        $data =Picture::get($id);
        $data->save($_POST);

    }

    //del
    public function del()
    {
        if (!empty($_POST)) {
            $id = $_POST['checkb'];
            $id = implode(',',$id);
            Picture::destroy($id);
        }
        if (!empty($_GET)){
             $id = $_GET['id'];
//                $data = new Picture;
//            $data->where('id',$id)->delete();
             Picture::destroy($id);
//             $data = Picture::get($id);
//             $data->is_del()
        }
    }
}