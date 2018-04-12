<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class Product2Controller extends CommonController {
    public function index(){
        $product=D('Product');
        $count=$product->where('p_differ=2')->count();
        $Page=new \Think\Page($count,10);
        $show=$Page->show();
        $data=$product->where('p_differ=2')->order('p_addtime')-> limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();       
    }
    public function add(){
        if (IS_POST){
        $product=D('Product');
        $config = array(
            'maxSize' => 5242880, 
            'exts' => array('doc', 'docx', 'jpg', 'png', 'gif', 'rar'),
            'rootPath' => C('UPLOAD_PATH'),
        );    
        $upload = new Upload($config);
        $info = $upload->upload();

        if(!$info){
            $this->error($upload->getError(),U('Product2/add'),3);
        }else {             
                $data=$product->create();
                $data['p_differ']=2;
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
                $this->error($product->getError(),U('Product2/edit'),3);
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
