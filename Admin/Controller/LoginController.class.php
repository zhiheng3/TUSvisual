<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/23
 * Time: 9:48
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        if(IS_POST){
            //$user=M('user');
            if(!$_POST['username']){
                $this->error('请输入用户名!');
            }
            if(!$_POST['password']){
                $this->error('请输入密码!');
            }
            //$status=$user->where(array('user_name'=>$_POST['username'],'user_password'=>md5($_POST['password'])))->find();
            $status = array();
            $status['id'] = 'test';
            $status['true_name'] = 'Zhao';
            if($status){
                $_SESSION['superuser_id']=$status['id'];
                $_SESSION['name']=$_POST['username'];
                $_SESSION['true_name']=$status['true_name'];
                $this->success('登录成功!',U('Index/index'));
            }else{
                $this->error('用户名或者密码错误!');
            }
        }else {
            $this->display();
        }
    }
}
