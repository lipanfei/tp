<?php if (!defined('THINK_PATH')) exit(); $config = D("Basic")->select(); $navs = D("Menu")->getBarMenus(); ?>

<!doctype html>
<html lang="cn">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" content="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/p0x02k/Public/home/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/p0x02k/Public/home/css/home/main.css" type="text/css" />
</head>
<body>
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="<?php echo U('/index');?>">
          <img src="/p0x02k/Public/home/images/logo.png" alt="">
        </a>
      </div>
       <ul class="nav navbar-nav navbar-left">
            <li><a href="<?php echo U('/index');?>" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
            <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=cat&id=<?php echo ($vo["menu_id"]); ?>" <?php if($vo['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-9">
        <div class="banner">
          <div class="banner-left">
            <div class="banner-info"><span>阅读数</span><i class="news_count node-<?php echo ($result['topPicNews'][0]['news_id']); ?>" news-id="<?php echo ($result['topPicNews'][0]['news_id']); ?>" id="node-<?php echo ($result['topPicNews'][0]['news_id']); ?>"></i></div>
             <a target="_blank" href="/index.php?c=detail&id=<?php echo ($result['topPicNews'][0]['news_id']); ?>"><img width="670" height="360" src="<?php echo ($result['topPicNews'][0]['thumb']); ?>" alt=""></a>
          </div>
          <div class="banner-right">
            <ul>
                <?php if(is_array($result['topSmailNews'])): $i = 0; $__LIST__ = $result['topSmailNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><img width="150" height="113" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"></a>
                      </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>
        <div class="news-list">
          <dl>
            <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
            <dd class="news-img">
              <img src="/p0x02k/Public/home/images/img4.jpg" alt="">
            </dd>
            <dd class="news-intro">
              手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
            </dd>
            <dd class="news-info">
              秋远俊二 <span>15:22</span> 阅读(1万)
            </dd>
          </dl>
          <dl>
            <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
            <dd class="news-img">
              <img src="/p0x02k/Public/home/images/img4.jpg" alt="">
            </dd>
            <dd class="news-intro">
              手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
            </dd>
            <dd class="news-info">
              秋远俊二 <span>15:22</span> 阅读(1万)
            </dd>
          </dl>
          <dl>
            <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
            <dd class="news-img">
              <img src="/p0x02k/Public/home/images/img4.jpg" alt="">
            </dd>
            <dd class="news-intro">
              手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
            </dd>
            <dd class="news-info">
              秋远俊二 <span>15:22</span> 阅读(1万)
            </dd>
          </dl>
          <dl>
            <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
            <dd class="news-img">
              <img src="/p0x02k/Public/home/images/img4.jpg" alt="">
            </dd>
            <dd class="news-intro">
              手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
            </dd>
            <dd class="news-info">
              秋远俊二 <span>15:22</span> 阅读(1万)
            </dd>
          </dl>
        </div>
      </div>
      <!--网站右侧信息-->
      <div class="col-sm-3 col-md-3">
        <div class="right-title">
          <h3>文章排行</h3>
          <span>TOP ARTICLES</span>
        </div>
        <div class="right-content">
          <ul>
           <?php if(is_array($result['rankNews'])): $k = 0; $__LIST__ = $result['rankNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
                            <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["small_title"]); ?></a>
                            <?php if($k == 1): ?><div class="intro">
                                    <?php echo ($vo["description"]); ?>
                                  </div><?php endif; ?>
                      </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
       <?php if(is_array($result['advNews'])): $k = 0; $__LIST__ = $result['advNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="right-hot">
              <a target="_blank" href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
  </div>
</section>
</body>
<script src="/p0x02k/Public/home/js/jquery.js"></script>
<script src="/p0x02k/Public/home/js/count.js"></script>
</html>