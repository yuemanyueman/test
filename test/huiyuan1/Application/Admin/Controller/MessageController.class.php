<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends CommonController {
    public function index(){
	    	if(!empty($_GET['searchType']) && !empty($_GET['search']))
	        {
	            $where[I("get.searchType")] = array('like','%'.trim(I('get.search')).'%');
	        }
	        $message=D('Message');
	    	$count=$message->where($where)->count();
	    	$Page=new \Think\Page($count,2);
	    	$show=$Page->show();
	    	$data=$message->where($where)->order('m_time')-> limit($Page->firstRow.','.$Page->listRows) ->select();
	    	$this->assign('page',$show);
	    	$this->assign('data',$data);
	    	$this->display();

    	
    }
}
