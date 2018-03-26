<?php

namespace app\index\Controller;
use think\Controller;
class About extends Controller{

    public function show(){
          return $this->fetch();
    }

    //关于齐锋
    public function aboutqf()
    {
        return $this->fetch();

    }

    //齐峰优势
    public function qfys()
    {
        return $this->fetch();

    }

    //荣誉资质
    public function honor()
    {
        return $this->fetch();

    }

    //招贤纳士
    public function zxns()
    {
        return $this->fetch();

    }

    public function zxnss()
    {
        return $this->fetch();
    }

}