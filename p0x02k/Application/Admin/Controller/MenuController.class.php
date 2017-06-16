<?php 
namespace Admin\Controller;

use Think\Controller;

class MenuController extends CommonController{

	//添加菜单的页面
	public  function add(){
		if($_POST){
			// print_r($_POST);
			if(!isset($_POST['name']) || !$_POST['name']){
				return show(0,'菜单名不可以为空');
			}

			if(!isset($_POST['m']) || !$_POST['m']){
				return show(0,'模块名不可以为空');
			}
			if(!isset($_POST['c']) || !$_POST['c']){
				return show(0,'控制器名不可以为空');
			}
			if(!isset($_POST['f']) || !$_POST['f']){
				return show(0,'方法名不可以为空');
			}

			if($_POST['menu_id']){
				return $this->save($_POST);
			}

			$menuId = D("Menu")->insert($_POST);
			if($menuId){
				return show(1,'添加成功',$menuId);
			}
				return show(0,'添加失败',$menuId);
		}else{
			$this->display();
		}
		}


		//添加菜单的展示页面
		public function index(){
				$data = array();
				if(isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1))){
					$data['type']= intval($_REQUEST['type']);
					$this->assign('type',$data['type']);
				}else{
					$this->assign('type',-1);
				}
				
		/**
		   *分页操作编辑
		 **/
		$page = $_REQUEST['P'] ? $_REQUEST['P'] : 1;
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3;
		$menus = D("Menu")->getMenus($data,$page,$pageSize);
		$menusCount = D("Menu")->getMenusCount($data);

		$res = new\Think\Page($menusCount, $pageSize);
		$pageRes = $res->show();
		$this->assign('pageRes',$pageRes);
		$this->assign('menus',$menus);
		$this->display();
	}

	//编辑页面
	public function edit(){
		$menuId = $_GET['id'];
		$menu = D("menu")->find($menuId);
		$this->assign('menu',$menu);
		$this->display();
	}
	//执行更新操作
	public function save($data){
		$menuId = $data['menu_id'];
		unset($data['menu_id']);

		try{
			$id = D("Menu")->updateMenuById($menuId,$data);

				if($id == false){
					return show(0,'更新失败');
				}
				return show(1,'更新成功');
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
	}

	public function setStatus(){
		try{
			if($_POST){
			$id = $POST['id'];
			$status = $_POST['status'];
			//执行数据的更新操作
			$res = D("Menu")->updateStatusById($id, $status);
			if($res){
				return show(1,'操作成功');
			}else{
				return show(0,'操作失败');
			}
		   }


		}catch(Exception$e){
			return show(0,$e->getMessage());
		}

		return show(0,'没有提交的数据');

	}


	public function listorder(){
		// print_r($_POST);
		// exit;
		$listorder = $_POST['listorder'];
		$jumpUrl = $_SERVER['HTTP_REFERER'];
		$errors = array();
		if($listorder){
			try{
			foreach ($listorder as $menuId=>$v){
				//执行更新
				 $id =D("Menu")->updateMenuListorderById($menuId,$v);
				 if($id===false){
				 	$errors[] = $menuId;
				 }
			}
		}catch(Exception $e){
			return show(0,$e->getMessage(),array('jump_url'=>$jumpUrl));

		}

		
			if($errors){
				return show(0,'排序失败-'.implode(',',$errors),array('jump_url'=>$jumpUrl));
			}
				return show(1,'排序成功',array('jump_url'=>$jumpUrl));
		}
		return show(0,'排序数据失败',array('jump_url'=>$jumpUrl));
	}

	
}



