<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;

class IndexController extends CommonController {
    public function index(){
    	//文章最大阅读数
     	$news = D('News')->maxcount();
     	//文章数量
        $newscount = D('News')->getNewsCount(array('status'=>1));
        //获取推荐位数
        $positionCount = D('Position')->getCount(array('status'=>1));
     
        //获取今天登录用户数量
        $adminCount = D("Admin")->getLastLoginUsers();

        $this->assign('news', $news);
        $this->assign('newscount', $newscount);
        $this->assign('positioncount', $positionCount);
        $this->assign('admincount', $adminCount);
        $this->display();
    }

      public function main() {
    	$this->display();
    }
}