<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model{
    protected $pk = 'n_id';
    protected $fields = array(
        'n_name','n_descript', 'n_file','n_status','n_addtime','n_oltime','n_link'
    );
    protected $_map = array(
    );
    protected $_validate = array(
        array('n_name', 'require', '资讯名称不能为空', 1, 'regex', 3),
        array('n_link', 'require', '资讯链接不能为空', 1, 'regex', 3),
        array('n_status', 'require', '资讯状态不能为空', 1, 'regex', 3),
        array('n_descript', 'require', '资讯内容不能为空', 1, 'regex', 3)
    );
    protected $_auto = array(
        array('n_addtime', 'setNowDate', 1, 'function'),
        array('n_oltime', 'setNowDate', 3, 'function')

    );

   
    
}