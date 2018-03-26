<?php

return [

    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => true,

    'view_replace_str'       => [
        '__PUBLIC__'         => 'http://www.demo.com',
           //admin后台 视图输出字符串内容替换
        'ADMIN_STATIC'       => 'static/admin/static',
        'ADMIN_LIB'          => 'static/admin/lib',
        'ADMIN_TEMP'         => 'static/admin/temp',
          //index前台 视图输出字符串内容替换
        'HOME_CSS'           => 'static/index/css',
        'HOME_IMG'           => 'static/index/images',
        'HOME_JOIN'          => 'static/index/join',
        'HOME_JS'            => 'static/index/js',
        'HOME_PICS'          => 'static/index/pics',
        'HOME_RILI'          => 'static/index/rili',
        'HOME_TEARCH'        => 'static/index/tearch',
        'HOME_BOOTS'         => 'static/index/bootstrap',
        'LAYUI'              => 'static/layui/layui',
        'LAYER'              => 'static/layer',
    ],

 //验证码配置
    'captcha' => [
    // 验证码字符集合
    'codeSet' => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
    // 验证码字体大小(px)
    'fontSize' => 25,
    // 是否画混淆曲线
    'useCurve' => false,
    // 验证码图片高度
    'imageH' => 48,
    // 验证码图片宽度
    'imageW' => 180,
    // 验证码位数
    'length' => 4,
    // 验证成功后是否重置
    'reset' => true
    ]

];