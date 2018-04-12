<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function login(){
    	if (IS_POST) {
	        $v = I('post.vcode');
	        $verify = new Verify();
	        if(!$verify->check($v)){
	            $this->error('验证码错误', U('login'), 3);
	        }
	        $name = I('post.name');
	        $passwd = I('post.password');
	        if(D('User')->checkLogin($name, $passwd)){
	            $this->redirect('/Admin/Index/index');
	        } else {
	            $this->error('您的用户名或密码错误', U('login'), 3);
	        }
    	}else{
    		$this->display();
    	}

    }

        function verify(){
        //自定义配置项
        $config = array(
            //'codeSet' => '0123456789',
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            // 宽高为0时，根据字体大小来生成图片大小的
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  105,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontSize'  =>  15,
            'fontttf'   =>  '2.ttf',              // 验证码字体，不设置随机获取
            'bg'        =>  array(93, 202, 27),  // 背景颜色，就不能使用背景图片
        );
        //1. 实例化验证码类
        $v = new \Think\Verify($config);
        //2. 调用entry()方法绘制验证码
        $v->entry();
    }  


}
