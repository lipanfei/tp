<?php

namespace Admin\Controller;

use Think\Controller;



class ContentController extends CommonController{
		//文章的显示页面
		public function index(){
			$conds = array();
			$title = $_GET['title'];
			$catid = $_GET['catid'];
			if($title){
				$conds['title'] = $title;
			}
			if($catid) {
				$conds['catid'] = intval($catid);
			}
			$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
			$pageSize = 1;
			$conds['status'] = array('neq',-1);
			$news = D("News")->getNews($conds,$page,$pageSize);
			$count = D("News")->getNewsCount($conds);
			$res = new\Think\Page($count,$pageSize);
			$pageres = $res->show();
			//获取推荐位内容
			$positions = D("Position")->getNormalPositions();

			
			$this->assign('pageres',$pageres);
			$this->assign('news',$news);
			$this->assign('positions',$positions);

			$this->assign('webSiteMenu',D("Menu")->getBarMenus());

			$this->display();
		}
		//文章的添加页面
		public function add(){
			if($_POST){
				if(!isset($_POST['title']) || !$_POST['title']){
					return show(0,'标题不存在');
				}
				if(!isset($_POST['small_title']) || !$_POST['small_title']){
					return show(0,'短标题不存在');
				}
				if(!isset($_POST['catid']) || !$_POST['catid']){
					return show(0,'文章栏目不存在');
				}
				if(!isset($_POST['keywords']) || !$_POST['keywords']){
					return show(0,'关键字不存在');
				}
				if(!isset($_POST['content']) || !$_POST['content']){
					return show(0,'文章内容不存在');
				}
				if(!isset($_POST['description']) || !$_POST['description']){
					return show(0,'文章描述不存在');
				}
				//编辑
				if($_POST['news_id']){
					return $this->save($_POST);
				}

				$newsId = D("News")->insert($_POST);
				if($newsId){
					$newsContentData['content']= $_POST['content'];
					$newsContentData['news_id']= $newsId;
					$cId = D("NewsContent")->insert($newsContentData);
					if($cId){
							return show(1,'新增成功');
					}else{
							return show(1,'主表插入成功,副表插入失败');
					}
				}else{
					return show(0,'新增失败');	
				}
			}else{


			$webSiteMenu = D("Menu")->getBarMenus();
			$titleFontColor = C("TITLE_FONT_COLOR");
			$copyFrom = C("COPY_FROM");
			// dump($webSiteMenu);
			// exit;
			$this->assign('webSiteMenu',$webSiteMenu);
			$this->assign('titleFontColor',$titleFontColor);
			$this->assign('copyFrom',$copyFrom);
			$this->display();
		}

		}
		//执行编辑
		public function save($data) {
	        $newsId = $data['news_id'];
	        unset($data['news_id']);

	        try {
	            $id = D("News")->updateById($newsId, $data);
	            $newsContentData['content'] = $data['content'];
	            $condId = D("NewsContent")->updateNewsById($newsId, $newsContentData);
	            if($id === false || $condId === false) {
	                return show(0, '更新失败');
	            }
	            return show(1, '更新成功');
	        }catch(Exception $e) {
	            return show(0, $e->getMessage());
	        }

	    }

		public function edit(){
			  $newsId = $_GET['id'];
			  if(!$newsId ){
			  	//执行跳转
			  	$this->redirect('/admin.php?c=content');
			  }
			  $news = D("News")->find($newsId);
			  // dump($news);
			  // exit;
			 if(!$news){
			 	//执行跳转
			  	$this->redirect('/admin.php?c=content');
			 }
			 $newsContent = D("NewsContent")->find($newsId);
			 	if($newsContent){
			 		$news['content'] = $newsContent['content'];
			 	}
			  $webSiteMenu = D("Menu")->getBarMenus();
		        $this->assign('webSiteMenu', $webSiteMenu);
		        $this->assign('titleFontColor', C("TITLE_FONT_COLOR"));
		        $this->assign('copyfrom', C("COPY_FROM"));
			$this->assign('news',$news);
			$this->display();
		}

		//文章删除和修改状态的方法
		public function setStatus() {
	        try {
	            if ($_POST) {
	                $id = $_POST['id'];
	                $status = $_POST['status'];
	                if (!$id) {
	                    return show(0, 'ID不存在');
	                }
	                $res = D("News")->updateStatusById($id, $status);
	                if ($res) {
	                    return show(1, '操作成功');
	                } else {
	                    return show(0, '操作失败');
	                }
	            }
	            return show(0, '没有提交的内容');
	        }catch(Exception $e) {
	            return show(0, $e->getMessage());
	        }
	    }

	    //文章执行排序
	      public function listorder() {
	        $listorder = $_POST['listorder'];
	        $jumpUrl = $_SERVER['HTTP_REFERER'];
	        $errors = array();
	        try {
	            if ($listorder) {
	                foreach ($listorder as $newsId => $v) {
	                    // 执行更新
	                    $id = D("News")->updateNewsListorderById($newsId, $v);
	                    if ($id === false) {
	                        $errors[] = $newsId;
	                    }
	                }
	                if ($errors) {
	                    return show(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
	                }
	                return show(1, '排序成功', array('jump_url' => $jumpUrl));
	            }
	        }catch (Exception $e) {
	            return show(0, $e->getMessage());
	        }
	        return show(0,'排序数据失败',array('jump_url' => $jumpUrl));
	    }

	    	//推送推荐位
	        public function push() {
	        $jumpUrl = $_SERVER['HTTP_REFERER'];
	        $positonId = intval($_POST['position_id']);
	        $newsId = $_POST['push'];

	        if(!$newsId || !is_array($newsId)) {
	            return show(0, '请选择推荐的文章ID进行推荐11');

	        }
	        if(!$positonId) {
	            return show(0, '没有选择推荐位');
	        }
	        // print_r($newsId);exit;
	        try {
	        	//获取文章内容
	            $news = D("News")->getNewsByNewsIdIn($newsId);
	            print_r($news);exit;
	            if (!$news) {
	                return show(0, '没有相关内容');
	            }
	            //把获取到的文章内容推送到相应的推荐位里去
	            foreach ($news as $new) {
	                $data = array(
	                    'position_id' => $positonId,
	                    'title' => $new['title'],
	                    'thumb' => $new['thumb'],
	                    'news_id' => $new['news_id'],
	                    'status' => 1,
	                    'create_time' => $new['create_time'],
	                );
	                $position = D("PositionContent")->insert($data);
	            }
	        }catch(Exception $e) {
	            return show(0,$e->getMessage());
	        }

	        return show(1, '推荐成功',array('jump_url'=>$jumpUrl));


	    }






}






?>