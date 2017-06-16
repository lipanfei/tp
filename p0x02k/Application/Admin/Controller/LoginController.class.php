<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){
            if(session('adminUser')){
                $this->redirect("/index.php?m=admin&c=index");
            }
    	return $this->display();
    }

    public function check(){
    	$username = $_POST['username'];
    	$password = $_POST['password'];

    	if(!trim($username)){
    		return show(0,'用户名不可以为空');
    	}
    	if(!trim($password)){
    		return show(0,'密码不可以为空');
    	}

    	$ret = D('Admin')->getAdminByUsername($username);
          

	if(!$ret || $ret['status'] !=1){
		return show(0,'该用户不存在');
	}

	if($ret['password'] != getMd5password($password)){
		return show(0,'密码错误');
	}
            //获取用户的登录时间
            D("Admin")->updateByAdminId($ret['admin_id'],array('lastlogintime'=>time()));
	//把用户信息存放到session里面
	session('adminUser',$ret);
	return show(1,'登录成功');


    }

    public function loginout(){
       session('adminUser', null);
       $this->redirect("/index.php?m=admin&c=login");
    }


}