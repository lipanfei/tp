<?php
return array(
	//'配置项'=>'配置值'

     /* URL设置 */
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             =>  0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：

	//加载额外的配置
	'LoAD_EXT_CONFIG' => 'db',
	'MD5_PRE' => 'sing_cms',
	//静态化文件默认后缀
	'HTML_FILE_SUFFIX' => '.html',
);