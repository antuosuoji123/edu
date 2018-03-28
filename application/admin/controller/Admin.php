<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Admin extends Common {

        //角色列表; 用中间组来进行划分

    public function admin_role() {
       
        $info = Db::name('auth_group_access')
        ->alias('a')
        ->join('admin_user u','u.admin_id=a.uid')
        ->join('auth_group g','g.id =a.uid')
        ->where('del=0')
        ->select();

        $this->assign('info',$info);
        return $this->fetch();
    }

        //角色列表; 用中间组来进行划分

    public function admin_role_del() {

        $uid = input('id');
       
        $info = Db::name('auth_group_access')
        ->alias('a')
        ->join('admin_user u','u.admin_id=a.uid')
        ->join('auth_group g','g.id =a.uid')
        ->where('uid',$uid)
        ->update(['del'=>'1']);

        if($info){
        echo 1;
        }
 

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

        $info = Db::name('admin_user')
        ->alias('a')
        ->join('auth_group b','b.id = a.admin_id')
        ->join('auth_group_access c','c.uid = a.admin_id')
        ->where('del=0')
        ->select();
        $this->assign('info',$info);
        dump($info);
        return $this->fetch();
    }

    public function add_admin_list(){

        $info   = input('post.');
        $uids   = $info['id'];
        $rules  = implode(',', $uids);
        $time   = time();
        //插入admin_user
        $user = [
        'admin_name'        => $info['admin_name'],
        'admin_password'    => $info['admin_password'],
        'phone'             => $info['phone'],
        'email'             => $info['email'],
        'addtime'           => $time
        ];

        //获取$user 返回id.插入auth_gourp_access;
        $res     =  Db::name('admin_user')->insert($user);
        $uid     =  Db::name('admin_user')->getLastInsID();
  
        //插入auth_group表
        $auth = [
        'title'             => $info['title'],
        'rules'             => $rules,
        ];

        //获取$auth_group 返回id.插入auth_gourp_access;
        $resu     =  Db::name('auth_group')->insert($auth);
        $group_id =  Db::name('auth_group')->getLastInsID();

        //auth_group_access数据库
        $access = [
        'uid'       =>  $uid,
        'group_id'  =>  $group_id
        ];

        $result     =  Db::name('auth_group_access')->insert($access);

     if($result) {
      return $this->success('添加分类成功','admin_list');
     }


    }



    public function admin_add() {

    $info = Db::name('auth_rule')->select();
    $this->assign('info',$info);    
    return $this->fetch();

    }
   
    public function admin_role_add() {
        return $this->fetch();
    }

    public function admin_role_addd(){
        
        $id = input('id');
        // return $id;
        $info = Db::name('admin_user')->where('admin_id',1)->select();
        $this->assign('info',$info);
        return $this->fetch();

    }

    // public function Admin_info(){




    // }

}


/*

    public function admin_list() {

        $info = Db::name('admin_user')
        ->alias('a')
        ->join('auth_group b','b.id = a.admin_id')
        ->join('auth_group_access c','c.uid = a.admin_id')
        ->join('auth_rule d','d.id = a.admin_id')
        ->where('del=0')
        ->select();
        $this->assign('info',$info);
        dump($info);
        return $this->fetch();
    }


 */