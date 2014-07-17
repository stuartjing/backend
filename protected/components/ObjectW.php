<?php
/**
 * 自定义挂件
 * 功能：显示一个英雄属性
 */
class ObjectW extends Widget{
	public $object_id; 		//实体
	public $id; 			//id
	
	public function init(){
		$game_id = Yii::app()->params['dbGame'];
		
		//数据查询
		$id = $this->id;
		if(preg_match('/^[a-z0-9]{24}$/', $id)){
			$id = new MongoId($id);
		}
		$info = Entity::model('entity_'.$game_id.'_'.$this->object_id)->findByPk($id);
		if($info){
			$info = $info->toArray();	//转数组
		}
		
		$_GET['widget_info'] = $info;
		ob_start();
	}
	
	public function run(){
		//获取内容
		$content = ob_get_contents();	//获取
		ob_end_clean();					//清空输出

		//解析内容
		$content = $this->initTwig($content, $_GET['widget_info']);		
		echo $content;		//直接输出处理后内容
		
//		$this->render('lyj', array(		//调用挂件视图并传入变量
//			'content'=>'<i>'.$content.'</i>',	//内容处理
//			'game_id'=>$this->game_id			//类属性
//		));
	}
} 