<?php
/**
 * 游戏数据模型
 * @author lyj
 */
class Game extends DBModel{
	//主要字段
	public $_id;
	public $code;
	public $name;
	public $addtime;
	
	/**
	 * 获取模型对象
	 * @param string 模型名称
	 * @return 模型对象
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string 文档名称
	 */
	public function getCollectionName(){
		return 'game';
	}
	
	/**
	 * @return array 属性验证规则
	 */
	public function rules(){
		return array(
			array('code, name', 'required'),	//验证字段
		);
	}
	
	/**
	 * 保存前处理
	 * @return true
	 */
	public function beforeSave(){
		if($this->getIsNewRecord()){		//方法判定
			$this->addtime = date('Y-m-d H:i:s');
		}
		return true;
	}
	
	/**
	 * 获取游戏配置
	 * @param $code
	 * @return unknown_type
	 */
	public function get($code=''){
		return $this->findByAttributes(array('code'=>$code));
	}
	
	
}