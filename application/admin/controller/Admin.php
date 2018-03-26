<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Admin extends Common {

    public function admin_role() {
       
        $info = Db::name('auth_group')->select();
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function admin_gl() {
        
        $info = Db::name('auth_rule')->field('id,name,title')->select();
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function admin_gl_add(){
        
        $data    = input('post.');
        $result  =  Db::name('auth_rule')->insert($data);

        if(!empty($_POST)){
        
        if($result) {
        return $this->success('添加分类成功','admin/admin/admin_gl_add');
        }else{
        return $this->error('抱歉添加失败');
        }
        }

       return $this->fetch();
    }


    public function admin_list() {

        $info = Db::name('admin_user')->select();
        $this->assign('info',$info);
        return $this->fetch();
    }
    public function admin_add() {

        $data    = input('post.');
        $result  =  Db::name('admin_user')->insert($data);
        if(!empty($_POST)){
        
        if($result) {
        return $this->success('添加分类成功','admin/admin/admin_gl_add');
        }else{
        return $this->error('抱歉添加失败');
        }
        }
        return $this->fetch();
    }
   
    public function admin_role_add() {
        return $this->fetch();
    }
}