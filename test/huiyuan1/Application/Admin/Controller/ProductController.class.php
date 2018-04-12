<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class ProductController extends CommonController {
    public function index(){
    	$product=D('Product');
        $count=$product->where('p_differ=1')->count();
        $Page=new \Think\Page($count,10);
        $show=$Page->show();
    	$data=$product->where('p_differ=1')->order('p_addtime')-> limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('data',$data);
        $this->assign('page',$show);
    	$this->display();   	
    }
	        function upfile(){
        // 使用写文件方式，可以比较容易的调试ajax程序
        $fp = fopen('d:/a.txt', 'w');
        
        // 文件上传处理
        // 1. 设置配置项
        $config = array(
            'maxSize' => 5242880, // 限制上传文件最大5M
            // 设置上传文件后缀
            'exts' => array('doc', 'docx', 'jpg', 'png', 'gif', 'rar'),
            // 上传文件保存的根目录
            'rootPath' => C('UPLOAD_PATH')."images/",
        );
        
        //2. 实例化upload类
        $upload = new Upload($config);
        
        //3. 调用upload()方法进行文件上传
        $info = $upload->upload();
        if(!$info){
            echo $upload->getError();
        } else {
            //sfwrite($fp, serialize($info));
            $result = array();
            $result['url'] = $info['upfile']['savepath'].$info['upfile']['savename'];
            $result['state'] = "SUCCESS";
            echo json_encode($result);
        }
        
    }
    public function add(){
        $category=D('Category')->field('c_id,c_name')->select();
    	if (IS_POST){
    	$product=D('Product');
        $config = array(
            'maxSize' => 5242880, 
            'exts' => array('doc', 'docx', 'jpg', 'png', 'gif', 'rar'),
            'rootPath' => C('UPLOAD_PATH'),
        );    
        $upload = new Upload($config);
        $info = $upload->upload();

        //dump($info);die;
        if(!$info){
            $this->error($upload->getError(),U('Product/add'),3);
        }else {	            
	            $data=$product->create();
	            if (!$data) {
	            	$this->error($product->getError(),U('Product/add'),3);
	            }else{
	            $data['p_file'] = C('UPLOAD_PATH').$info['p_file']['savepath'].$info['p_file']['savename'];
	            	if ($product->add($data)) {
	            		$this->success('添加产品成功',U('index'),3);
	            		# code...
	            	}else{
	            		$this->error('添加产品失败',U('add'),3);
	            	}


	            }
	        }
    	}else{
            $this->assign('category',$category);
    		$this->display();
    	}


    }
    public function edit(){
        $category=D('Category')->field('c_id,c_name')->select();
        $id = I('get.id');
        $product = D('Product');
         $p_file = $product->where('p_id='.$id)->field('p_file')->find();
        // dump($p_file);die;
    	if (IS_POST) {
            $config = array(
                'maxSize' => 5242880, 
                'exts' => array('doc', 'docx', 'jpg', 'png', 'gif', 'rar'),
                'rootPath' => C('UPLOAD_PATH'),
            );    
            $upload = new Upload($config);
            $info = $upload->upload();                     
            $data=$product->create();
            if (!$data) {
                $this->error($product->getError(),U('Product/edit'),3);
            }else{
                if(!$info){
                    $data['p_file']=$p_file;
                }else{
                $data['p_file'] = C('UPLOAD_PATH').$info['p_file']['savepath'].$info['p_file']['savename'];
                    
                } 
            $a=$product->where('p_id='.$id)->save($data);
                if ($a!==false) {
                    $this->success('修改产品成功',U('index'),3);
                    # code...
                }else{
                    $this->error('修改产品失败',U('edit'),3);
                }
            }
    	}else{
    		
	        $data = $product->where('p_id='.$id)->find();
            $data['p_descript']=html_entity_decode($data['p_descript']);
	        $this->assign('data',$data);
            $this->assign('category',$category);
	        $this->display();
    	}
    	

    }
    function del(){
        $id = I('get.id');
        $product = D('Product');
        $where['p_id']=$id;
        $data = $product->where('p_id='.$id)->find();
        $path = $data['p_file'];
        if($path != './Uploads/'){
            unlink($path);
        }

        if($product->where('p_id='.$id)->delete()){
            $this->success('删除产品成功', U('index'), 3);
        } else {
            $this->error('删除产品失败', U('index'), 3);
        }
    }
}
