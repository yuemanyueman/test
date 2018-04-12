<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$get = I('get.');
    	if(trim($get['name']) != ''){
            $where['name'] = array('LIKE', '%'.trim($get['name']).'%');
        }
        if(trim($get['phone']) != ''){
            $where['phone'] = array('LIKE', '%'.$get['phone'].'%');
        }
    	$info = getList("Member", $where, 10);
        foreach($info['list'] as $key => $val){
            $info['list'][$key]['xuhao'] = $key + 1;
        }
        $this -> assign('page', $info['page']);
        $this -> assign('list', $info['list']);
    	$this->display();
    }

    public function add(){
    	if (IS_POST) {
    		$member=D('Member');
    		$post=I('post.');
    		$integrals=array_slice($post,2);
    		$t_integral=array_sum($integrals);
    		$integral_nums=count($integrals);
    		if ($integral_nums>=1) {
    			$data['integral']=implode(',',$integrals);
    		}
    		$data['t_integral']=$t_integral;
    		$data['name']=$post['name'];
    		$data['phone']=$post['phone'];
    		$data['create_time']=time();
    		$data['update_time']=time();
    		$res = $member -> add($data);
        	if($res){
 				$this->success('添加成功',U('index'));  
        	}else{
        		$this->error('添加失败',U('index'));
        	}    		
    	}else{
    		$this->display();    		
    	}
    }

    public function edit(){
    	if (IS_POST) {
    		$member=D('Member');
    		$post=I('post.');
    		$integrals=array_slice($post,4);
    		$t_integral=array_sum($integrals);
    		$integral_nums=count($integrals);
    		if ($integral_nums>=1) {
    			$data['integral']=implode(',',$integrals);
    		}
    		$data['t_integral']=$t_integral;
    		$data['name']=$post['name'];
    		$data['phone']=$post['phone'];
    		$data['update_time']=time();
    		$res = $member ->where(array('id'=>$post['id']))-> save($data);
        	if($res){
 				$this->success('修改成功',U('index'));  
        	}else{
        		$this->error('修改失败',U('index'));
        	}    	
    	}else{
    		$id = I('get.id');
    		$where['id'] = array('eq',$id);
    		$data=D('Member')->where($where)->find();
    		$integral=explode(',',$data['integral']);
    		$integral_nums=count($integral);
    		foreach ($integral as $key => $value) {
    			$key=$key+1;
    			$data['integral'.$key]=$value;
    		}
    		$this->assign('integral',$integral);
    		$this->assign('data',$data);
    		$this->assign('nums',$integral_nums);
    		$this->display();
    		
    	}
    }
	

	public function returnMsg(){
		$p_id=($_POST['p_id']);
		$data=D('Product')->where('p_id='.$p_id)->find();
		$data['p_descript']=html_entity_decode($data['p_descript']);
		$data=json_encode($data);
		echo $data;
	}

}
