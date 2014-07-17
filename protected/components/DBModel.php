<?php
/**
 * 数据库模型基类
 * @author user
 */
class DBModel extends EMongoSoftDocument{
	
	/**
	 * 获取模型对象
	 * @param $className 自己
	 * @return CMole 模型对象
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	/**
	 * mongodb模型必备方法
	 * @author lyj
	 */
	public function getCollectionName(){
		return 'test';
	}
	
	/**
	 * 根据传入的数据生成表索引
	 * 	array(
	 * 		array("i" => -1),		//字段i倒序
	 * 		array("name"=> 1),		//字段name正序
	 * 	)
	 * @param $indexs	索引配置
	 * @return array	执行结果
	 */
	public function createIndexs($indexs=array()){
		if(empty($indexs)){
			return false;
		}
		$rs = array();
		foreach($indexs as $ik=>$iv){
			$rs[$ik] = $this->getCollection()->ensureIndex($iv);
		}
		return $rs;
	}
	
	
	/**
	 * 实现mongo唯一验证
	 * @param string 	被验证的属性名字		password
	 * @param array		制定的校验规则		array()
	 */
	public function unique($attribute,$params){
		$val = $this->$attribute;
		
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'_id'		=> array('<>' => empty($this->_id)?0:$this->_id),
				$attribute	=> array('==' => $val)
			)
	 	));
		
		$cou = $this->count($criteria);
		if($cou){
			$this->addError($attribute, '该记录已经存在！');
		}
	}
	
	/**
	 * 根据传入条件数组查询
	 * 注意此方法跳过了criteria的环节，直接执行查询，虽提高了适应能力，但大大增加使用者要求
	 * @param $query array 查询数组
	 * @author lyj
	 * @return array 查询结果集
	 */
	public function findAllByQuery($query, $fields=false, $sort=false, $offset=false, $limit=false){
		if($this->beforeFind()){
			if(empty($fields)){
				$cursor = $this->getCollection()->find($query);			//所有字段
			}else{
				$cursor = $this->getCollection()->find($query, $fields);//指定字段
			}
			if($this->getUseCursor()){
				return new EMongoCursor($cursor, $this->model());	//游标错误
			}else{
				if($sort){
					$cursor->sort($sort);
				}
				if($offset){
					$cursor->skip($offset);
				}
				if($limit){
					$cursor->limit($limit);
				}
				$qq = $this->_populateRecords($cursor);	//游标结果集转对象数组
				return $qq;	
			}
		}
		return array();	//结束返回空
		
		/* 
		//查询数组示例
		$query = array( 
			'game_code' => 'dota2',							// {'game_code':'dota2'}
			'$or' => array( 								// {$or: [{name: {$gte: 龙龙}}, {真名: '龙龙'}]
				array('name' => array('$gte'=>'龙龙')), 
				array('真名' => array('龙龙'))
			),
			'age' => array( 								// {age: {$gt: 5, $lt: 20}}
				'$gt' => 5, 
				'$lt' => 20 
			),
			'age' => array(									//{age:{$in:[1,2,3], $all:[2,3]}}
				'$in'=>array(1,2,3),
				'$all'=>array(2,3)
			),
		)
		//调用示例
		$rs = Entity::model('entity_'.Yii::app()->params['dbGame'].'_hero')->findAllByArray(
			$query, array('_id','name')
		);
		*/
	}
	
	/**
	 * 简化的数据获得方法
	 * @param $cursor	mogon查询后游标
	 * @return array 数据
	 */
	private function _populateRecords($cursor){
		$rs = array();
		foreach($cursor as $vo){		//循环1
			$rs[] = $vo;
		}
		return $rs;
	}
	
	
	/**
	 * 将结果集转为一维列表,兼容attr属性
	 * @param $rs	array	数据集
	 * @param $val	str		做为值的数据键值
	 * @param $key	str		做为键的数据键值
	 * @return array 一维列表
	 */
	public function list_from_rs($rs,$val='id',$key=''){
		$list = array();
		if(empty($rs)){
			return $list;
		}
		
		foreach($rs as $k => $v){
			if(is_object($v)){
				$v = $v->toArray();
			}
			
			if($k==='attr'){continue;}
			
			if(isset($v[$val])){
				if(empty($key)){
					$list[] = $v[$val];
				}else{
					$list[''.$v[$key]] = $v[$val];
				}
			}else{
				if(empty($key)){
					$list[] = $v['attr'][$val];
				}else{
					$list[$v['attr'][$key]] = $v['attr'][$val];
				}
			}
		}
		
		return $list;
	}
	
	/**
	 * 获取登录用户信息
	 * @param $key 属性值
	 * @param $key1 二级属性值
	 * @return unknown_type
	 */
	public static function get_login_user($key='',$key1=false){
		$rs = 0;
		if(!Yii::app()->user->isGuest){
			$rs = Yii::app()->user->getState('info');
			if(!empty($key)){
				$rs = isset($rs[$key])?$rs[$key]:'';
				if($key1!==false){
					$rs = isset($rs[$key1])?$rs[$key1]:'';
				}
			}
		}
		return $rs;
	}
	
	//判断是否是管理员
    protected function isAdmin($user=array()){	//其中$user代表Yii::app()->user即登录用户。
        return intval($this->get_login_user('role'))===10;
    }
    
	/**
	 * 分离查询操作符，以实现动态条件查询（admin页面中）
	 * @param $data
	 * @return unknown_type
	 */
	public function _split_operator($data){
		$ops = array(
			'<','<=','<>','>','>=','='
		);
		$op = '=';
		$val = $data;
		if(in_array(substr($data,0,2), $ops)){
			$op = substr($data,0,2);
			$val = substr($data,2);
		}else if(in_array(substr($data,0,1), $ops)){
			$op = substr($data,0,1);
			$val = substr($data,1);
		}
		return array('op'=>($op=='='?'==':$op), 'val'=>$val);
	}
}