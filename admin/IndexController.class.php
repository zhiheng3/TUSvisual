<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function _initialize(){
        if(!session('superuser_id')){
            $this->redirect('Login/login');
        }
    }

    public function index(){
        $this->assign('name',session('true_name'));
        $this->display();
    }
    public function news(){
        $news=M('news');
        $news_list=$news->select();
        $this->assign('news_list',$news_list);
        $this->display();
    }
    public function home(){
        if(IS_POST){
            if(trim($_POST['password_a'])){
                if(strlen($_POST['password_a'])<6){
                    $this->error('密码长度最少6个字符!');
                }
                if($_POST['password_a']!==$_POST['password_b']){
                    $this->error('两次密码不匹配,请从新输入!');
                }
                $data['user_password']=md5($_POST['password_a']);
            }
            $data['true_name']=$_POST['name_a'];
            $status_a=M('user')->where(array('id'=>session('superuser_id')))->save($data);
            if($status_a){
                $this->success('成功修改用户信息!');
            }else{
                $this->error('修改失败,可能内容没有修改!');
            }
        }else{
            $this->assign('name',session('true_name'));
            $this->display();
        }
    }
    public function news_add(){
        if(IS_POST){
            if($_POST['id']){
                import('ORG.Net.UploadFile');
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                $upload->saveName = time().'_'.mt_rand();
                // 上传文件
                $info   =  $upload->uploadOne($_FILES['photo']);
                if($info){
                    $url='/Uploads/'.$info['savepath'].$info['savename'];
                }else{
                    $url=$_POST['img_url'];
                }

                $news=M('news');
                $data['news_title']=$_POST['news_title'];
                $data['news_content']=$_POST['news_content'];
                $data['news_url']=$url;
                $data['update']=time();
                $data['type']=$_POST['type'];
                $data['is_show']=$_POST['is_show'];
                $status=$news->where(array('id'=>$_POST['id']))->save($data);
                if($status){
                    $this->success('修改成功！');
                }else{
                    $this->error('修改失败,可能内容没有修改！',U('Index/news'));
                }
            }else{
                import('ORG.Net.UploadFile');
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                $upload->saveName = time().'_'.mt_rand();
                // 上传文件
                $info   =  $upload->uploadOne($_FILES['photo']);
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
//                $this->success('上传成功！');
                    $news=M('news');
                    $data['news_title']=$_POST['news_title'];
                    $data['news_content']=$_POST['news_content'];
                    $data['news_url']='/Uploads/'.$info['savepath'].$info['savename'];
                    $data['update']=time();
                    $data['type']=$_POST['type'];
                    $data['is_show']=$_POST['is_show'];
                    $status=$news->add($data);
                    if($status){
                        $this->success('添加成功！');
                    }else{
                        $this->error('添加失败！');
                    }

                }
            }
        }else{
            if($_GET['id']){
                $news=M('news')->where(array('id'=>$_GET['id']))->find();
                $this->assign('news',$news);
            }
            $this->display();
        }

    }
    /*新闻删除*/
    public function news_del(){
        $news=M('news')->where(array('id'=>$_GET['id']))->delete();
        if($news){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败,请刷新！');
        }
    }


    /*退出*/
    public function log_out(){
        session(null);

        $this->redirect('Index/index');
    }

    /*作品*/
    public function works(){
        $works=M('works')->select();
        foreach($works as $key=>$val){
            $works[$key]['category']=category($val['category_id']);
        }
        $this->assign('works_list',$works);
        $this->display();
    }

    public function works_add(){
        if(IS_POST){
            if($_POST['id']){
                import('ORG.Net.UploadFile');
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/Works'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                $upload->saveName = time().'_'.mt_rand();
                // 上传文件
                $info   =  $upload->uploadOne($_FILES['photo']);
                if($info){
                    $url='/Uploads/Works'.$info['savepath'].$info['savename'];
                }else{
                    $url=$_POST['img_url'];
                }

                $works=M('works');
                $data['works_name']=$_POST['works_name'];
                $data['works_author']=$_POST['works_author'];
                $data['works_name']=$_POST['works_name'];
                $data['works_photot']=$url;

                $data['label']=trim($_POST['label'],'×') ;

                $data['category_id']=$_POST['category_id'];
                $data['browse']=0;
                $data['thumbs_up']=0;
                $data['explain']=$_POST['explain'];
                $data['update']=time();
                $status=$works->where(array('id'=>$_POST['id']))->save($data);
                if($status){
                    $this->success('修改成功！');
                }else{
                    $this->error('修改失败,可能内容没有修改！',U('Index/works'));
                }
            }else{
                import('ORG.Net.UploadFile');
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/Works'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                $upload->saveName = time().'_'.mt_rand();
                // 上传文件
                $info   =  $upload->uploadOne($_FILES['photo']);
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
//                $this->success('上传成功！');
                    $works=M('works');
                    $data['works_name']=$_POST['works_name'];
                    $data['works_author']=$_POST['works_author'];
                    $data['works_name']=$_POST['works_name'];
                    $data['works_photot']='/Uploads/Works'.$info['savepath'].$info['savename'];

                    $data['label']=trim($_POST['label'],'×') ;

                    $data['browse']=0;
                    $data['thumbs_up']=0;
                    $data['explain']=$_POST['explain'];
                    $data['update']=time();
                    $data['category_id']=$_POST['category_id'];
                    $status=$works->add($data);
                    if($status){
                        $this->success('添加成功！');
                    }else{
                        $this->error('添加失败！');
                    }

                }
            }
        }else{
            if($_GET['id']){
                $works=M('works')->where(array('id'=>$_GET['id']))->find();
                $works['label']=explode('×',$works['label']);
                $this->assign('works',$works);

            }
            $this->display();
        }
    }

    public function works_del(){
        $works=M('works')->where(array('id'=>$_GET['id']))->delete();
        if($works){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败,请刷新！');
        }
    }
}