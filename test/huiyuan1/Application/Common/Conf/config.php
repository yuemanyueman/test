<?php
return array(
    // 设置分页中每页显示数量
    'PAGESIZE' => 3,
    // 设置文件上传的根目录
    'UPLOAD_PATH' => './Uploads/',
    
    // 自定义函数文件名
    'LOAD_EXT_FILE' => 'myfile',
    // 开启页面trace，但是在调试ajax时，需要将该项关闭
    'SHOW_PAGE_TRACE' => false,
    
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING' => array(
	   // 使用绝对路径。 
       '__HOMEJS__' => '/huiyuan1/Public/Home/js'// 
/*	   '__HOMECSS__' => '/lengyun/Public/Home/css',
	   '__HOMEJS__' => '/lengyun/Public/Home/js',
	   '__HOMEIMG__' => '/lengyun/Public/Home/img',
	   '__COMMON__' => '/lengyun/Public/Common/',
       '__ADMINCSS__' => '/lengyun/Public/Admin/css',
       '__ADMINJS__' => '/lengyun/Public/Admin/js',
       '__ADMINIMG__' => '/lengyun/Public/Admin/images'*/
	),
    
    // 设置URL模式为rewrite模式
    'URL_MODEL' => 2,
    // 设置允许访问的模块列表
    'MODULE_ALLOW_LIST'      =>  array('Admin','Home'),
    // 设置默认访问的模块
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'URL_CASE_INSENSITIVE'  =>   true,
    //用户权限配置
    'USER_AUTH_KEY'         =>  'dengluming',// 用户标识
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'huiyuan',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'hy_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存

);