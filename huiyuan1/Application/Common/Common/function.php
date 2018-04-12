<?php

//无限分类函数
function getTree($list, $pid=0, $level=0){
    // 定义新数组，用来保存排序的结果
    static $result = array();
    foreach($list as $value){
        if($value['dept_pid'] == $pid){
            $value['dept_level'] = $level;
            $result[] = $value;
            //因为输出当前栏目的id值，就是子栏目的pid，所以将$value['id']作为参数
            getTree($list, $value['dept_id'], $level+1);
        }
    }
    return $result;
}

function setNowDate(){
    return date('Y-m-d H:i:s');
}

function product1($c_id){
    $where['p_category']=$c_id;
    $where['p_status']=1;
    $where['p_differ']=1;
    $data1=D('Product')->where($where)->select();
    return $data1;
}


//分页
function getList($table = '', $where = array(), $page = false, $field = array() ,$order = 'id desc') {
    $model = M($table);
    if (!$model)
        return false;
    if(!$field){
        $field = "*";
    }else{
        $field = implode(',', $field);
    }
    //不分页
    if (!$page) {
            if (!$where)
                return $model -> field($field) ->order('id desc')->select();
            else
                return $model -> field($field) ->where($where)->select();
        //$where 空 则返回所有节点
    }else {
            if (intval($page) < 1)
            $page = 5;
            $count = $model->where($where)->count();
            $Page = new \Think\Page($count, $page);
            $data['page'] = $Page->show();
            $data['list'] = $model -> field($field) ->where($where)->order($order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            $data['sql'] = $model -> getlastsql();     
            
            return $data;
        }
        
    
}



























