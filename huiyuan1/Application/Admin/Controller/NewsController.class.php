<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class NewsController extends CommonController {
    public function index(){
    	$news=D('News');        
        $count=$news->count();
        $Page=new \Think\Page($count,10);
        $show=$Page->show();
    	$data=$news->select();
    	$this->assign('data',$data);
        $this->assign('page',$show);
    	$this->display();   	
    }
    public function add(){
    	if (IS_POST){
    	$news=D('News');
        $config = array(
            'maxSize' => 5242880, 
            'exts' => array('doc', 'docx', 'jpg', 'png', 'gif', 'rar'),
            'rootPath' => C('UPLOAD_PATH'),
        );    
        $upload = new Upload($config);
        $info = $upload->upload();

        //dump($info);die;
        if(!$info){
            $this->error($upload->getError(),U('news/add'),3);
        }else {	            
	            $data=$news->create();
	            if (!$data) {
	            	$this->error($news->getError(),U('news/add'),3);
	            }else{
	            $data['n_file'] = C('UPLOAD_PATH').$info['n_file']['savepath'].$info['n_file']['savename'];
	            	if ($news->add($data)) {
	            		$this->success('添加资讯成功',U('index'),3);
	            		# code...
	            	}else{
	            		$this->error('添加资讯失败',U('add'),3);
	            	}


	            }
	        }
    	}else{
    		$this->display();
    	}


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
	
    public function edit(){
        $id = I('get.id');
        $news = D('News');
         $n_file = $news->where('n_id='.$id)->field('n_file')->find();
        // dump($n_file);die;
    	if (IS_POST) {
            $config = array(
                'maxSize' => 5242880, 
                'exts' => array('doc', 'docx', 'jpg', 'png', 'gif', 'rar'),
                'rootPath' => C('UPLOAD_PATH'),
            );    
            $upload = new Upload($config);
            $info = $upload->upload();                     
            $data=$news->create();
            if (!$data) {
                $this->error($news->getError(),U('news/edit'),3);
            }else{
                if(!$info){
                    $data['n_file']=$n_file;
                }else{
                    $data['n_file'] = C('UPLOAD_PATH').$info['n_file']['savepath'].$info['n_file']['savename'];
                } 
            $a=$news->where('n_id='.$id)->save($data);
                if ($a!==false) {
                    $this->success('修改产品成功',U('index'),3);
                    # code...
                }else{
                    $this->error('修改产品失败',U('edit'),3);
                }
            }
    	}else{
    		
	        $data = $news->where('n_id='.$id)->find();
	        $this->assign('data',$data);
	        $this->display();
    	}
    	

    }
    function del(){
        $id = I('get.id');
        $news = D('News');
        $where['n_id']=$id;
        $data = $news->where('n_id='.$id)->find();
        $path = $data['n_file'];
        if($path != './Uploads/'){
            unlink($path);
        }

        if($News->where('n_id='.$id)->delete()){
            $this->success('删除资讯成功', U('index'), 3);
        } else {
            $this->error('删除资讯失败', U('index'), 3);
        }
    
    }
}
