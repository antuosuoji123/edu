<?php
namespace app\admin\Controller;
use think\Controller;
use think\Db;
use think\Validate;
use think\Session;
class Login extends Controller{

    public function login(){

      return  $this->fetch();
    }


//     public function doLogin(){
//     //根据session用户id查找角色id信息
//     $name = input('post.admin_name');
//     // $pwd = input('post.admin_password');
//     $info  = Db::name('admin_user')->where('admin_name',$name)->find();

//     if($info != null){

//         session::set('uid',$info['admin_id']);

//         $this->success("登录成功","/admin/index/index");
//     }else{

//         $this->error('登录失败');

//     }
  
//     return $this->fetch();

// }

    /*public function doLogin(){
        
        $arr = input('');
        $rule = [       
        'name'       => 'require|max:12',    
        'password'   => 'number|max:10',    
        'password'   => 'require|max:10',    
        ];
        $msg = [        
        'name.require'      => '管理员名称必须填写',    
        'name.max'          => '名称最多不能超过12个字符',    
        'password.number'   => '密码必须是数字',    
        'password.require'  => '密码不能为空',    
        'password.max'      => '密码最多不能超过10个数字',
        ];

        $data = [
        'name'       => $arr['admin_name'],
        'password'   => $arr['admin_password'],
    ];

        $validate = new Validate($rule,$msg);
        $result   = $validate->check($data);

         if(!$result){

         echo json_encode($validate->getError());

         }else{
            $name     = $arr['admin_name'];
            $password = $arr['admin_password'];
            $res      = Db::name('admin_user')->where('admin_name',$name)->find();
        if(!$res){
            echo json_encode('管理员不存在或者输入错误');
        }elseif($password != $res['admin_password']){
             echo json_encode('密码输入错误');
        }else{

            session::set('uid',$res['admin_id']);
             //$this->success("登录成功","/admin/index/index");
        }

     }

    }*/



    public function doLogin()
    {
        if (request()->isPost()) {
            
                $rule = [       
                    'name'  => 'require|max:12',    
                    'password'   => 'number|max:10',    
                    'password'   => 'require|max:10',    
                    
                ];
                $msg = [ 
                    'name.require' => '管理员名称必须填写',    
                    'name.max'     => '名称最多不能超过12个字符',    
                    'password.number'   => '密码必须是数字',    
                    'password.require'   => '密码不能为空',    
                    'password.max'  => '密码最多不能超过10个数字',
                    
                ];
                $data = [
                    'name'       => input('post.name'),
                    'password'   => input('post.password'),     
                ];
                $validate = new Validate($rule,$msg);
                $result   = $validate->check($data);
                if(!$result){
                    echo json_encode($validate->getError());
                }else{
                    $name = input('post.name');
                    $password = input('post.password');
                    //$pwd = md5($password);
                    $res = Db::name('admin_user')->where(['admin_name'=>$name])->find();
                    if (!$res) {
                        echo json_encode('管理员不存在或者输入错误');
                    }elseif($password != $res['admin_password']){
                        echo json_encode('密码输入错误'); 
                    }else{
                        Session::set('uname',$res['admin_name']);
                        Session::set('uid',$res['admin_id']);
                        echo 1;
                    }
                }
            }
        }


}
