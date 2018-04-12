<?php
namespace Home\Model;
use Think\Model;
class MessageModel extends Model{
    protected $pk = 'm_id';
    protected $fields = array(
        'm_name', 'm_email', 'm_message','m_time'
    );
    protected $_map = array(
        'name' => 'm_name',
        'email' => 'm_email',
        'message' => 'm_message'
    );
    protected $_validate = array(
        array('m_name', 'require', '姓名不能为空', 1, 'regex', 3),
		array('m_email','email','邮箱格式错误', 1, 'regex', 3),
        array('m_message', 'require', '留言不能为空', 1, 'regex', 3)
    );
    protected $_auto = array(
        array('m_time', 'setNowDate', 3, 'function')
    );
	
	
}