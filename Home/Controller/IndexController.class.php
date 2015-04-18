<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function release(){
        $this->display();
    }
    public function news(){
        $news=M('news')->where(array('is_show'=>1))->select();
        $this->assign('news',$news);
        $this->display();
    }
    public function lists(){
        if($_GET['list_id']){
            $data['category_id']=$_GET['list_id'];
        }
        $lists=M('works')->where($data)->select();
        foreach($lists as $key =>$val){
            $lists[$key]['category']=category($val['category_id']);
        }
        $this->assign('lists',$lists);
        $this->display();
    }
    public function datails(){
        $db=M('works');
        $data['id']=$_GET['list_id'];
        $db->where(array($data))->setInc('browse',1);
        $solo=$db->where($data)->find();
        $solo['tags']=explode('@',$solo['tags']);
        $this->assign('solo',$solo);
        $this->display();
    }
    /*点赞*/
    public function thumbs_up(){
        $db=M('works');
        $data['id']=$_POST['id'];
        $results=$db->where(array($data))->setInc('thumbs_up',1);
        if($results){
            $this->success();
        }else{
            $this->error();
        }
    }
}
