<?php
/**
 * 自定义挂件基类
 */
class Widget extends CWidget{	//挂件基类CWidget
	
	/**
	 * beginWidget()调用
	 */
	public function init(){}
	
	/**
	 * Widget()或endWidget()调用
	 */
	public function run(){}
	
	/**
	 * 初始化挂件模板并返回twig对象
	 * @param string 	$content	需解析内容
	 * @param array 	$data		替换数据，默认为空
	 * @return string 	解析后内容
	 */
	public function initTwig($content, $data=array()){
		//twig声明
		require_once Yii::getPathOfAlias('application.vendors.Twig').'/Autoloader.php';		//Yii::import('application.vendors.Twig.Autoloader.php'); //不可使用此代码代替
        Yii::registerAutoloader(array('Twig_Autoloader', 'autoload'), true);

		//模板加载
		$loader = new Twig_Loader_String();
		$twig = new Twig_Environment($loader, array(
		    //'cache' => '/cache',
		));
		$twig->addExtension(new Twig_Extension_My());	//注册扩展
		
		//解析内容
		$content = $twig->render($content, $data);
		return $content;
	}
} 