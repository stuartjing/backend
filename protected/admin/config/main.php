<?php


// 这里使用了一个扩展，故定义了一个别名
Yii::setPathOfAlias('ext', dirname(__FILE__).'/../extensions');
// 下面是分离前后台需要增加的
$backend=dirname(dirname(__FILE__));
$frontend=dirname($backend);
Yii::setPathOfAlias('backend', $backend);




return array(
	'basePath' => $frontend,
	'controllerPath' => $backend.'/controllers',
	'viewPath' => $backend.'/views',
	'runtimePath' => $backend.'/runtime',
	'name'=>'后台管理程序',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'backend.models.*',
		'backend.components.*',
		'ext.*'
//		'ext.YiiMongoDbSuite.*',		//载入mongo扩展类
		
	),

	'modules'=>array(
		'gii'=>array(
			'generatorPaths'=>array(
				'admin.gii',
			),
		),
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*'urlManager'=>array(
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
				'heros/<id:\w+>' => 'site/hero',
				'items/<id:\w+>'=>'site/item',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'admin/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		//连接服务器数据库
		'db2'=>array(
 				'class'=>'UDbconnection',
		
				//链接数据库
				
				'masterConfig' => array(
					'connectionString' => 'mysql:host=127.0.0.1;dbname=jing;port=3306',
         			"username"         => 'root',
        			"password"         => '',
				),
				'slaveConfig' => array(
					'connectionString' => 'mysql:host=127.0.0.1;dbname=jing;port=3306',
         			"username"         => 'root',
        			"password"         => '',
				),
		
// 				'masterConfig'=> array(
//         			'connectionString' => 'mysql:host=mysql3307-m.dota2-ana.db.internal.17173.com;dbname=dota2;port=3307',
//         			"username"         => 'prog_admin',
//        			"password"         => 'Ml.asdlfl23rqfa790jJKJfxP.f2G',
//    			),
//    			'slaveConfig' => array(
//					"connectionString" => "mysql:host=mysql3307-m.dota2-ana.db.internal.17173.com;dbname=dota2;port=3307",
//					"username" 		   => "prog_admin",
//	                "password" 		   => "Ml.asdlfl23rqfa790jJKJfxP.f2G",
//				),
 			   'charset'=>'utf8',
 	    ),
		
		//启用缓存
		'cache'=>array(					//缓存组件
			'enabled' => 'false',
			'class'=>'CFileCache',		//开发使用文件缓存
		),
//		'cache'=>array(					//缓存组件
//			'enabled' => 'true',
//			'class'=>'CMemCache',		//线上使用memcache缓存
//			'keyPrefix'=>'gamedb',		//统一缓存前缀
//			'servers'=>array(			//memcache服务器配置
//           		array(
//           			'host'=>'127.0.0.1',
//             		'port'=>11211,
////               	'host'=>'10.59.95.192',
////             		'port'=>16004,
//              		'weight'=>100,
//           		),
//        	),
//		),
		
		//session共享
		'session' => array (
		    'class' => 'system.web.CCacheHttpSession',
		    'cacheID' => 'cache',		//缓存实现
			//'cookieMode' => 'only',
            'timeout' => 1200
		),
		
//		//启用yiimongodb
//		'mongodb' => array(
//	        'class'             => 'EMongoDB',					//主文件
//	        'connectionString'  => 'mongodb://localhost:27017/gamedb',//服务器地址
//	        'dbName'            => 'gamedb',					//数据库名称
//	        'fsyncFlag'         => false,						//mongodb的确保所有写入到数据库的安全存储到磁盘
//	        'safeFlag'          => false,						//mongodb的等待检索的所有写操作的状态，并检查
//	        'useCursor'         => false,						//设置为true，将启用游标
//	    ),
	    
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
		'adminEmail'=>'liujingxiu@cyou-inc.com',		//管理员邮箱
		'dbGame'=>'dota2',								//引用数据的游戏代码
		'pageCache'=>false,								//开启页面缓存
		'imgUrl'=>'http://i1.17173cdn.com/xz7c5b/YWxqaGBf',	//图片迁移路径
	),
);
