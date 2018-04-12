<?php
namespace Admin\Model;
use Think\Model;
class ProductModel extends Model{
    protected $pk = 'p_id';
    protected $fields = array(
        'p_category', 'p_name', 'p_model','p_descript','p_file','p_status','p_addtime','p_oltime','p_differ','p_tro'
    );
    protected $_map = array(
    );
    protected $_validate = array(
        array('p_name', 'require', '产品名称不能为空', 1, 'regex', 3),/*
        array('p_model', 'require', '产品型号不能为空', 1, 'regex', 3),
        array('p_category', 'require', '所属类别不能为空', 1, 'regex', 3),*/
        array('p_status', 'require', '产品状态不能为空', 1, 'regex', 3),/*
        array('p_descript', 'require', '产品描述不能为空', 1, 'regex', 3)*/
    );
    protected $_auto = array(
        array('p_addtime', 'setNowDate', 1, 'function'),
        array('p_oltime', 'setNowDate', 3, 'function')

    );

   
    
}