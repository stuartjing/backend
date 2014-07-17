<?php
/**
 * 父类model
 * Enter description here ...
 * @author enky
 *
 */
class Fuqin
{
	
	public $db;
	public function __construct()
	{
		$this -> db = Yii::app() -> db;
	}
	
	
	public function getList($page, $rows, $sql)
	{   $sql_r='';
		$connection = $this -> db;
		if(isset($page)&&!empty($page)&&isset($rows)&&!empty($rows)){
			$offset = ($page-1) * $rows;
			$sql_r = $sql . " LIMIT $offset , $rows";
		}else{
			$sql_r=$sql;
		}
		 
		$result_arr = $connection -> queryAll( $sql_r );
		$result_arr = array('rows' => $result_arr);
		return $result_arr;
	}
	
	/**
	 * 获取版本号
	 * @return null
	 */
	public function get_bbh($dvs){
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'name'=>array('==' => $dvs),	//条件
			),
			'select'=>array('updatetime', 'name'),
		));
		$data = Entity::model('entity_'.Yii::app()->params['dbGame'].'_bbh')->find($criteria);
		return $data;
	}
    
}

























