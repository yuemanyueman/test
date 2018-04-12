<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{
    protected $pk = 'u_id';
    protected $fields = array(
        'u_name', 'u_password', 'u_salt','u_time'
    );
    protected $_map = array(
        'name' => 'u_name',
        'password' => 'u_password'
    );
    protected $_validate = array(
        array('u_name', 'require', '用户名不能为空', 1, 'regex', 3),
        array('u_password', 'require', '密码不能为空', 1, 'regex', 3)
    );
    protected $_auto = array(
        array('u_time', 'setNowDate', 3, 'function')
    );

    function checkLogin($name, $passwd){
        $info = $this->where("u_name='$name'")->find();
        if(empty($info)){
            return false;
        } elseif($info['u_password'] == md5($passwd.$info['u_salt'])) {
            $aa=$this->create();  
            $data['u_time']=$aa['u_time'];   
            $this->where("u_name='$name'")->save($data);
            session('id', $info['u_id']);
            session('name', $info['u_name']);
            return true;
        }
    }
    
}