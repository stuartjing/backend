<?php
/**
 * 游戏实体模型
 * @author lyj
 */
class Object extends DBModel{
	//主要字段
	public $_id;
	public $game_id;
	public $game_code;
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
		return 'object';
	}
	
	/**
	 * @return array 属性验证规则
	 */
	public function rules(){
		return array(
			array('game_id, game_code, code, name', 'required'),	//验证字段
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
	 * 获取实体配置
	 * @param array/string 	$game 游戏配置或游戏名 
	 * @param string		$code 实体id
	 * @return unknown_type
	 */
	public function get($game, $code){
		if(empty($game)||empty($code)){
			return array();
		}
		return $this->findByAttributes(array('game_code'=>$game, 'code'=>$code));	//获取实体
	}
	
	/**
	 * 获取实体配置
	 * @param array 	$game 游戏配置 
	 * @param string	$code 实体id
	 * @return unknown_type
	 */
	public function getAll($game){
		if(empty($game)){
			return array();
		}
		return $this->findAllByAttributes(array('game_code'=>$game));	//获取所有实体;
	}

}