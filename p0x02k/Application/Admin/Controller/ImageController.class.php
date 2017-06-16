<?php 
/*
*图片相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;

/*
*
* 文章内容管理
 */

class ImageController extends CommonController{
	private $_uploadobj;
	public function __construct(){

	}

	
	//异步上传方法
	public function ajaxuploadimage(){
		$upload = D("UploadImage");
		$res = $upload->imageUpload();
		
		if($res===false){
			return show(0,'上传失败', ' ');

		}else{
			return show(1,'上传成功',$res);
		}
	}
	//文本编辑器的接受
	public function kindupload(){
		$upload = D("UploadImage");
		$res = $upload->upload();
		
		if($res===false){
			return showkind(1,'上传失败');
		}
			return showkind(0,$res);
		
	}

}





?>