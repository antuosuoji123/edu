<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Details extends Model
{
    protected $autoWriteTimestamp = true;

    public function getDetails($classid){

        $dataa = Db::name('details')->alias('d')->where(['classid'=>$classid,'isdel'=>0])->join('shop_user u','d.authorid = u.uid')->field(['id','title','username','update_time','hits'])->select();
        $data = [];
        foreach ($dataa as $k=>$v) {
            $v['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
            $data[$k] = $v;
        }

        return $data;
    }

    //like
    public function like($classid)
    {
        $lk = $_POST['like'];
        $data = $this->alias('d')->where(['classid'=>$classid,'isdel'=>0])->where('title','like',"%$lk%")->join('shop_user u','d.authorid = u.uid')->field(['id','title','username','update_time','hits'])->select();
        return $data;
    }

    //count
    public function count($classid)
    {
        $count = $this->where(['classid'=>$classid,'isdel'=>0])->count();
        return $count;

    }

    //alone
    public function getAlone($id)
    {
        $data = Db::name('details')->where('id',$id)->select();
        return $data;
    }

    //获取类
    public function getClass($classid)
    {
        $data = Db::name('details')->where(['id'=>$classid,'isdel'=>0])->field('title')->select();

        return $data;
    }

    //del
    public function del($id)
    {
        $data = Db::name('details')->where('id',$id)->update(['isdel'=>1]);
    }
    public function model()
    {
            $id = $_POST['checkb'];
            $id = implode(',',$id);
            $data = Db::name('details')->where('id','in',$id)->update(['isdel'=>1]);
    }

    //add
    public function add($uid,$pic)
    {

        if (!empty($_GET['id'])) {
            $id =$_GET['id'];
            $data = Details::get($id);
            $data->pic ='/uploads/'.$pic;
            $data->save($_POST);
        } else{
            $classid = $_GET['classid'];
            $data = new Details;
            $data->authorid = $uid;
            $data->pic ='/uploads/'.$pic;
            $data->classid = $classid;
            $data->save($_POST);
        }

        //        $data->title = $_POST['title'];
//        $data->content = $_POST['editorValue'];
//        $data->is_reply = $_POST['jjj'];
//        $data->introduce = $_POST['introduce'];

    }

    //up
    public function up()
    {
        $id = $_GET['id'];
        $hu = Details::get($id);
        $hu->save($_POST);
//        $data = Db::name('details')->where('id',$id)->update(['introduce'=>$_POST['introduce'],'content'=>$_POST['editorValue'],'is_reply'=>$_POST['jjj']]);

    }


}


