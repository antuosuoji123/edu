<?php
namespace app\admin\model;

use think\Model;

class Goods_type extends Model{

    public function goods_add(){
        
        //获取前台数据
        $data['name'] = input('name');
        $data['pid']  = input('pid');
        //通过前台数据找到$path路径
        $path         = $this->field("path")->find($data['pid']);
        $data['path'] = $path['path'];
        $level        = substr_count($data['path'],',');
        //获取插入id值;
        $result       = $this->insert($data);
        $resultId     = $this->getLastInsID();
        $lei          = $this->find($resultId);
        //获取心得path路径
        $path         = $lei['path'].','.$lei['pid'];
        //获取level的值
        $level        = substr_count($path,',');
        //判断如果是顶级权限重新划分$path值
        if($lei['pid']=='0'){
        $path = $lei['pid'].','.$resultId;
        }
        //更新字段;
        $result       = $this
                        ->where('id',"$resultId")
                        ->update(['path'=>"$path",'level'=>"$level"]);

       return $result;

    }
}
