<?php

/**
 * 评论数据模型
 *
 * 字段列表
 * @property int 	$_id
 * @property string $url
 * @property string $key
 * @property datatime $addtime
 */
class Comment extends DBModel{
	//主要字段
	public $_id;
	public $url;				//页面路径
	public $key;				//评论id
	public $addtime;			//添加时间
	
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
		return 'comment_'.Yii::app()->params['dbGame'];
	}
	
	/**
	 * @return array 属性验证规则
	 */
	public function rules(){
		return array(
			array('url, key', 'required'),	//验证字段
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
	 * @return array 字段别称
	 */
	public function attributeLabels(){
		return array(
			'_id' => 'ID',
			'url' => '页面地址',
			'key' => '评论id',
			'addtime'=> '注册时间',
		);
	}
	
}