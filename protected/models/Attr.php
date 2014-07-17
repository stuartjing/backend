<?php
/**
 * 游戏属性模型
 * @author lyj
 */
class Attr extends DBModel{
	//主要字段
	public $_id;
	public $game_code;
	public $object_id;
	public $object_code;
	public $code;
	public $name;
	public $type;
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
		return 'attr';
	}
	
	/**
	 * @return array 属性验证规则
	 */
	public function rules(){
		return array(
			array('game_code, object_id, object_code, code, name, type', 'required'),	//验证字段
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
	 * 获取一个属性配置
	 * @param string 		$game 	游戏代码
	 * @param string 		$object 实体代码 
	 * @param string		$code 	实体id
	 * @return 属性信息
	 */
	public function get($object, $code){
		if(empty($object)||empty($code)){
			return array();
		}
		$rs = $this->findByAttributes(array('game_code'=>Yii::app()->params['dbGame'], 'object_code'=>$object, 'code'=>$code));
		return empty($rs)?array():$rs->toArray();
	}
	
	/**
	 * 获取实体的所有属性配置
	 * @param array 	$game 游戏配置 
	 * @param string	$code 实体id
	 * @param array		$where 查询条件，如：array('main'=>'yes');
	 * @return unknown_type
	 */
	public function getAll($object, $where=array()){
		if(empty($object)){
			return array();
		}
		
		//加入固定条件
		$where['game_code'] = Yii::app()->params['dbGame'];
		$where['object_code'] = $object;
		
		$rs = $this->findAllByAttributes($where);
		if($rs){
			$nrs = array();
			foreach($rs as $vo){
				$nrs[$vo->code] = $vo->toArray();	
			}
			$rs = $nrs;
		}
		return $rs;
	}

}