<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\org\Auth;
use think\Session;

class Common extends Controller
{
    // 当任何函数加载的时候会调用此函数
    public function _initialize()
    {
        // 获取用户名
        $uid = session::get('uid');

        // 判断用户名是否存在
        if (empty($uid)) {
           echo '你还没有登录';
        }

        // 获取控制器名
        $controller = request()->controller();

        // 获取方法名
        $action = request()->action();

        // 获取模块名
        $model = request()->module();

        // 声明Auth认证类    
        $auth = new Auth();

       if(!$auth->check($model . '/' . $controller . '/' . $action, session::get('uid'))){

//            $this->error('您没有权限访问！', url('admin/index/index'));
        }

    }
}
