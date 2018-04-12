<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
    
    // 在实例化控制器时，自动调用该方法
    function _initialize(){
        if(!session('?id')){
            $this->error('请您先登录，再访问', U('Login/login'), 3);
        }
    }
    
}