<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Comment extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;

    public function getC()
    {
        $data = $this->alias('c')->where('delete_time',null)->join('shop_user u','c.uid = u.uid')->join('shop_details d','d.id = c.cid')->field(['c.id','c.create_time','c.content','username','email','phone','title'])->select();
        return $data;
    }

    //count
    public function count()
    {
        $data = $this->alias('c')->where('delete_time',null)->join('shop_user u','c.uid = u.uid')->join('shop_details d','d.id = c.cid')->field(['c.id','c.create_time','c.content','username','email','phone','title'])->count();
        return $data;
    }

    //del
    public function del()
    {
        if (!empty($_POST)) {
            $id = $_POST['checkb'];
            $id = implode(',',$id);
            Comment::destroy($id);
        }
        if (!empty($_GET)){
            $id = $_GET['id'];
            Comment::destroy($id);
        }
    }

}
