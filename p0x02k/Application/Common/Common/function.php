<?php 

/*
**
*公用的方法
 */

function show($status, $message,$data=array()){
	$result = array(
		'status' =>$status,
		'message' =>$message,
		'data' => $data,
		);

		exit(json_encode($result));
}

function getMd5Password($password){
	return md5($password.C('MD5_PRE'));
}

function getMenuType($type){
	return $type ==1 ? '后台菜单' : '前端栏目';
	
}
//获取状态的
function status($status) {
    if($status == 0) {
        $str = '关闭';
    }elseif($status == 1) {
        $str = '正常';
    }elseif($status == -1) {
        $str = '删除';
    }
    return $str;
}


function getAdminMenuUrl($nav){
	$url = './admin.php?c='.$nav['c'].'&a='.$nav['f'];
	if($nav['f']=='index'){
		$url = './admin.php?c='.$nav['c'].'&a='.$nav['f'];
	}
	return $url;
}

function getActive($navc){
	$c =strtolower(CONTROLLER_NAME);
	if(strtolower($navc)==$c){
		return "class='active'";
	}
	return '';
}

function showkind($status,$data){
	header('Content-type:application/json;charset=UTF-8');
	if($status==0){
		exit(json_encode(array('error'=>0,'url'=>$data)));
	}
		exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}

//获取session里的登录用户的登录名
 function getLoginUsername(){
 	return $_SESSION['adminUser']['username'] ?  $_SESSION['adminUser']['username'] : '';
 } 

//获取文章列表里的栏目
  function getCatName($navs,$id){
 	foreach($navs as $nav){
 		$navList[$nav['menu_id']] = $nav['name'];
 	}
 	return isset($navList[$id]) ? $navList[$id] : '';
 }
//获取文章表里的文章来源
 function getCopyFromById($id){
 	$copyFrom = C("COPY_FROM");
 	return $copyFrom[$id] ? $copyFrom[$id] : '';
 }



 //获取封面图
 function isThumb($thumb){
 	if($thumb){
 		return '<span style ="color:red">有</span>';
 	}
 		return '无';
 }

?>