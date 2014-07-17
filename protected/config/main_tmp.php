<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'DOTA2数据库',
	'language'=>'zh_cn',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.YiiMongoDbSuite.*',		//载入mongo扩展类
		'application.modules.attr.*',
		'application.modules.attr.controllers.*',
	),

	'modules'=>array(),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix' => '.html',
			'rules'=>array(
				'items'=>'site/item',
				'heros' => 'site/index',
				'analytics' => 'zb/index',
				'analytics/data' => 'zb/data',
				'analytics/armory' => 'zb/armory',
				'analytics/skill' => 'zb/skill',
				'search'=>'site/search',
				'tips'=>'site/tips',
				'xmlhero'=>'xml/index',
				'xmlitem'=>'xml/item',
				'heros/<id:\w+>' => 'site/hero',
				'items/<id:\w+>'=>'site/item',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		'db2'=>array(
 				'class'=>'UDbconnection',
 				'masterConfig'=> array(
         			'connectionString' => 'mysql:host=localhost;dbname=dota2_zb;port=3306',
         			"username"         => 'root',
        			"password"         =>'',
    			),
    			'slaveConfig' => array(
					"connectionString" => "mysql:host=10.6.210.225;dbname=dota2;port=3306",
					"username" => "root",
	                "password" => "123456",
				),
 			   'charset'=>'utf8',
 	    ),
		//启用缓存
//		'cache'=>array(					//缓存组件
//			'enabled' => 'true',
//			'class'=>'CFileCache',		//开发使用文件缓存
//		),
		'cache'=>array(					//缓存组件
			'enabled' => 'true',
			'class'=>'CMemCache',		//线上使用memcache缓存
			'keyPrefix'=>'gamedb',		//统一缓存前缀
			'servers'=>array(			//memcache服务器配置
           		array(
               		'host'=>'127.0.0.1',
             		'port'=>11211,
              		'weight'=>100,
           		),
        	),
		),
		
		//session共享
		'session' => array (
		    'class' => 'system.web.CCacheHttpSession',
		    'cacheID' => 'cache',		//缓存实现
			//'cookieMode' => 'only',
            'timeout' => 1200
		),
		
		//启用yiimongodb
		'mongodb' => array(
	        'class'             => 'EMongoDB',					//主文件
	        'connectionString'  => 'mongodb://127.0.0.1:27017',//服务器地址
	        'dbName'            => 'gamedb',					//数据库名称
	        'fsyncFlag'         => false,						//mongodb的确保所有写入到数据库的安全存储到磁盘
	        'safeFlag'          => false,						//mongodb的等待检索的所有写操作的状态，并检查
	        'useCursor'         => false,						//设置为true，将启用游标
	    ),
	    
	    //视图渲染器
		'viewRenderer'=>array(
            'class'=>'CPradoViewRenderer',
        ),
	    
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
			
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'yongjiangli@cyou-inc.com',		//管理员邮箱
		'dbGame'=>'dota2',								//引用数据的游戏代码
		'pageCache'=>false,								//开启页面缓存
	),
);