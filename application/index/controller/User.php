<?php
namespace app\index\controller;
use think\Controller;
use think\Paginator;
use think\Session;
use think\Db;
use app\index\model\User as UserModel;
class User extends Controller
{

    public function login()
    {
        return $this->fetch();
    }
    //登录
    public function dologin()
    {

        $dl = new UserModel;
        $dl->dlogin();
        $this->redirect('/');
    }
    //loginout
    public function loginout()
    {
        Session::delete(['name','uid']);
        return $this->redirect('/');
    }

     // 0代表为空     1 成功    2 失败
    //ajax验证用户名
    public function lname()
    {
        $name = $_POST['name'];
        if (empty($_POST['name'])) {
            //0代表用户为空
            echo 0;
            die;
        }
        $result =Db::name('user')->where('username',$name)->find();
       if ($result) {
            echo 1;
       } else {
           echo 2;
       }
    }

    //ajax验证密码
    public function lpwd()
    {
        $name =$_POST['name'];
        $pwd = md5($_POST['pwd']);
        if (empty($_POST['pwd'])) {
            echo 0;
            die;
        }
        $password = Db::name('user')->field('password')->where('username',$name)->find();
        if ($pwd == $password['password']) {
            echo 1;
        } else {
            echo 2;
        }
    }

    //ajax yzm
    public function lyzm()
    {
        $yzm = $_POST['yzm'];
        if (empty($_POST['yzm'])) {
            echo 0;
            die;
        }
        if(captcha_check($yzm)){
            echo 1;
        }else{
            echo 2;
        }
    }

    //////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////


    public function register()
    {
        //渲染模板
        return $this->fetch();
    }
    //register
    public function reg()
    {
        $zc = new UserModel();
        $zc->register();
        $this->redirect('/');
    }

    //email
    public function email()
    {

        $email = $_POST['name'];
        if (empty($email)) {
            echo 0;
            die;
        }
        $preg = "/^\w+@\w+\.\w+/";
        if (preg_match($preg, $email)) {
            echo 1;
        }else{
            echo 2;

        }
    }

    //phone
    public function phone()
    {
        $phone = $_POST['name'];
        if (empty($phone)) {
            echo 0;
            die;
        }
        $preg = "/^1[34578]\d{9}$/";
        if (preg_match($preg, $phone)) {
            echo 1;
        }else{
            echo 2;

        }
    }


    //dx
    public function dx()
    {
        //传入数据库
        if(!empty($_POST['phone'])){

            $a = rand(1000,9999);
            $_SESSION['randCount'] = null;
            session::set('yzm',$a);


//初始化必填
//填写在开发者控制台首页上的Account Sid
            $options['accountsid']='5e837f99b7e6a512654cbf66d4aacc49';
//填写在开发者控制台首页上的Auth Token
            $options['token']='0428e47c9d323c4e26662990c287d3f2';

//初始化 $options必填
            $ucpass = new Ucpaas($options);
            $appid = "2607f263abfa41e2a0471a764b2c28c8";    //应用的ID，可在开发者控制台内的短信产品下查看
            $templateid = "272874";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
            $param = $a; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
            $mobile = $_POST['phone'];
            $uid = "";
//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
            $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
        }

    }

}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
class Ucpaas
{
    //API请求地址
    const BaseUrl = "https://open.ucpaas.com/ol/sms/";

    //开发者账号ID。由32个英文字母和阿拉伯数字组成的开发者账号唯一标识符。
    private $accountSid;

    //开发者账号TOKEN
    private $token;

    public function  __construct($options)
    {
        if (is_array($options) && !empty($options)) {
            $this->accountSid = isset($options['accountsid']) ? $options['accountsid'] : '';
            $this->token = isset($options['token']) ? $options['token'] : '';
        } else {
            throw new Exception("非法参数");
        }
    }

    private function getResult($url, $body = null, $method)
    {
        $data = $this->connection($url,$body,$method);
        if (isset($data) && !empty($data)) {
            $result = $data;
        } else {
            $result = '没有返回数据';
        }
        return $result;
    }

    /**
     * @param $url    请求链接
     * @param $body   post数据
     * @param $method post或get
     * @return mixed|string
     */

    private function connection($url, $body,$method)
    {
        if (function_exists("curl_init")) {
            $header = array(
                'Accept:application/json',
                'Content-Type:application/json;charset=utf-8',
            );
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            if($method == 'post'){
                curl_setopt($ch,CURLOPT_POST,1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $opts = array();
            $opts['http'] = array();
            $headers = array(
                "method" => strtoupper($method),
            );
            $headers[]= 'Accept:application/json';
            $headers['header'] = array();
            $headers['header'][]= 'Content-Type:application/json;charset=utf-8';

            if(!empty($body)) {
                $headers['header'][]= 'Content-Length:'.strlen($body);
                $headers['content']= $body;
            }

            $opts['http'] = $headers;
            $result = file_get_contents($url, false, stream_context_create($opts));
        }
        return $result;
    }

    /**
    单条发送短信的function，适用于注册/找回密码/认证/操作提醒等单个用户单条短信的发送场景
     * @param $appid        应用ID
     * @param $mobile       接收短信的手机号码
     * @param $templateid   短信模板，可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
     * @param null $param   变量参数，多个参数使用英文逗号隔开（如：param=“a,b,c”）
     * @param $uid			用于贵司标识短信的参数，按需选填。
     * @return mixed|string
     * @throws Exception
     */
    public function SendSms($appid,$templateid,$param=null,$mobile,$uid){
        $url = self::BaseUrl . 'sendsms';
        $body_json = array(
            'sid'=>$this->accountSid,
            'token'=>$this->token,
            'appid'=>$appid,
            'templateid'=>$templateid,
            'param'=>$param,
            'mobile'=>$mobile,
            'uid'=>$uid,
        );
        $body = json_encode($body_json);
        $data = $this->getResult($url, $body,'post');
        return $data;
    }

    /**
    群发送短信的function，适用于运营/告警/批量通知等多用户的发送场景
     * @param $appid        应用ID
     * @param $mobileList   接收短信的手机号码，多个号码将用英文逗号隔开，如“18088888888,15055555555,13100000000”
     * @param $templateid   短信模板，可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
     * @param null $param   变量参数，多个参数使用英文逗号隔开（如：param=“a,b,c”）
     * @param $uid			用于贵司标识短信的参数，按需选填。
     * @return mixed|string
     * @throws Exception
     */
    public function SendSms_Batch($appid,$templateid,$param=null,$mobileList,$uid){
        $url = self::BaseUrl . 'sendsms_batch';
        $body_json = array(
            'sid'=>$this->accountSid,
            'token'=>$this->token,
            'appid'=>$appid,
            'templateid'=>$templateid,
            'param'=>$param,
            'mobile'=>$mobileList,
            'uid'=>$uid,
        );
        $body = json_encode($body_json);
        $data = $this->getResult($url, $body,'post');
        return $data;
    }
}