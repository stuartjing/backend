<?php

/**
 * 实体数据模型
 *
 * 字段列表
 * @property int 	$_id
 * @property string $name
 * @property string $attr
 * @property datatime $edittime;
 * @property datatime $addtime
 */
class Entity extends DBModel{
	//主要字段
	public $_id;
	public $name;
	public $edittime;			//更新时间
	public $addtime;			//添加时间
	public $trueCollection;		//标记属性，保存时将被剔除
	
	public function __construct($trueC='entity', $scenario='insert'){
		parent::__construct($scenario);		//传入父类
		$this->trueCollection = $trueC;		//动态设置对象名称
	}
	
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
		return 'entity';
	}

	/**
	 * @return array 字段别称
	 */
	public function attributeLabels(){
		return array(
			'_id' => 'ID',
			'name' => '名称',
			'addtime' => '添加时间',
		);
	}
	/**
	 * 获取技能信息
	 */
	public function getAbility($data){
		$numid_all = array_map(array($this,'prefixPath'), explode(",",$data));
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'numId'=>array('in' => $numid_all),	//条件
			),
			'select'=>array('_id', 'name', 'icon', 'numId'),
		));
		$info = self::model('entity_dota2_skill')->findAll($criteria);
		return $info;
	}

	/**
	 * 获取-统计 出装数据
	 */
	public function getItem($data){
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'numId'=>array('==' => intval($data)),	//条件
			),
			'select'=>array('_id', 'name', 'icon', 'numId', 'itemId'),
		));
		$info = self::model('entity_dota2_item')->findAll($criteria);
		return $info;
	}
	
	public function prefixPath($n){
		return intval($n);
	}
}