<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class CategoryController extends CommonController {
    public function index(){
    	$category=D('Category');
    	$data=$category->select();
    	$this->assign('data',$data);
    	$this->display();   	
    }
    public function add(){
    	if (IS_POST){
    	$category=D('Category');
        $data['c_name']=I('c_name');
        $data=$category->add($data);
        	if ($data) {
        		$this->success('添加类别成功',U('index'),3);
        		# code...
        	}else{
        		$this->error('添加类别失败',U('add'),3);
        	}
    	}else{
    		$this->display();
    	}


    }
    public function edit(){
        $id = I('get.id');
        $category = D('Category');
    	if (IS_POST) {                 
            $data=$category->create();
            if (!$data) {
                $this->error($category->getError(),U('category/edit'),3);
            }else{
            $a=$category->where('c_id='.$id)->save($data);
                if ($a!==false) {
                    $this->success('修改类别成功',U('index'),3);
                    # code...
                }else{
                    $this->error('修改类别失败',U('edit'),3);
                }
            }
    	}else{
    		
	        $data = $category->where('c_id='.$id)->find();
	        $this->assign('data',$data);
	        $this->display();
    	}
    	

    }
    function del(){
        $id = I('get.id');
        $category = D('Category');
        $where['c_id']=$id;
        if($category->where('c_id='.$id)->delete()){
            $this->success('删除类别成功', U('index'), 3);
        } else {
            $this->error('删除类别失败', U('index'), 3);
        }
    }
}
