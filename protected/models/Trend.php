<?php

class Trend
{
	// Instance of mysql
	private $db;
	// Instance of mongo
	private $mongodb;
	// 查询的数据类型
	private $type_arr = array('count','win','kills_ave','ass_ave','deaths_ave','goldPM_ave','xpPM_ave');
	// 取后一位的值
	private $type_one = array('kills_ave','ass_ave','deaths_ave','win');
	// 取整的
	private $type_int = array('goldPM_ave','xpPM_ave','count');
	// 设置小数位数
	private $done;
	// 设置数据公式
	private $type_formula;
	// 开始时间
	private $startDate;
	// 结束时间
	private $endDate;
	public function __construct()
	{
		$this->db = Yii::app()->db2;
	}
	/**
	 * 初始化一下参数\
	 * @param unknown_type $type	数据类型
	 * @param unknown_type $date	日期类型 1周，2月
	 */
	public function setInitParam($type, $date)
	{
		if(in_array($type, $this->type_one)){
			$this->done = 1;
		}elseif(in_array($type, $this->type_int)){
			$this->done = 0;
		}
		
		$this->type_formula = $this -> setTypeFormula($type);
		$this->startDate = $this->setStartDate($date);
		$this->endDate = date("Ymd",time());
	}
	/**
	 * 获取趋势信息
	 * @param unknown_type $hero	英雄id
	 * @param unknown_type $date	日期: 1:周， 2：月, 版本
	 * @param unknown_type $type	统计的类型, 
	 */
	public function getInfo($heroId, $date, $type)
	{
		$result = array();
		if(in_array($type, $this->type_arr))
		{
			$this->setInitParam($type, $date);
		
			$sql = "select " .$this->type_formula ." from stat_hero where match_date>='".$this->startDate."' and match_date<'".$this->endDate."' and hero_id='$heroId' order by match_date asc";
			$result = $this->db->queryAll($sql);
			
			if(!empty($result) && is_array($result)){
				foreach($result as $value){
					$res[] = round($value[$this->type_formula],$this->done);
				}
			}
		}
		return $res;
	}
	/**
	 * 获取一段时间内一个数据的最大值
	 * @param unknown_type $date	日期
	 * @param unknown_type $type	数据类型
	 * @return number|string
	 */
	public function getMaxDate($date, $type)
	{
		$this->setInitParam($type, $date);
		
		$sql = "select max(".$this->type_formula.") as date from stat_hero where match_date>='".$this->startDate."' and match_date<'".$this->endDate."'";
		$result = $this->db->getRow($sql);
		
		if(!empty($result)){
			return round($result['date'], $this->done);
		}else{
			return '';
		}
	}
	/**
	 * 获取一段时间内一个数据的最小值
	 * @param unknown_type $date	日期
	 * @param unknown_type $type	数据类型
	 * @return number|string
	 */
	 public function getMinDate($date, $type)
	 {
		$this->setInitParam($type, $date);
		
		$sql = "select min(".$this->type_formula.") as date from stat_hero where match_date>='".$this->startDate."' and match_date<'".$this->endDate."'";
		$result = $this->db->getRow($sql);
		
		if(!empty($result)){
			return round($result['date'], $this->done);
		}else{
			return '';
		}
	 }
	/**
	 * 日期时间
	 * @param unknown_type $date	1:周， 2：月, 版本
	 */
	protected function setStartDate($date)
	{
		switch ($date)
		{
			case 1:
				$startTime = date("Ymd",strtotime('-7 days'));
				break;
			case 2:
				$startTime = date("Ymd",strtotime('-30 days'));
				break;
			default:
				$startTime = $date;
				break;
		}
		return $startTime;
	}
	/**
	 * 根据需要的数据类型，返回响应的计算公式
	 */
	protected function setTypeFormula($type)
	{
		switch ($type)
		{
			case 'count':
				$type = 'count';
				break;
			case 'win':
				$type = 'win/count*100';
				break;
			case 'kills_ave':
				$type = 'kills/level*25';
				break;
			case 'ass_ave':
				$type = 'assists/level*25';
				break;
			case 'deaths_ave':
				$type = 'deaths/level*25';
				break;
			case 'goldPM_ave':
				$type = 'gold_per_min/level*25';
				break;
			case 'xpPM_ave':
				$type = 'xp_per_min/level*25';
				break;
		}
		return $type;
	}
	/**
	 * 获取英雄的_id
	 * @param unknown_type $heroId	英雄的numid
	 * @return str _id
	 */
	public function getHero_id($heroId)
	{
		$numId_arr = Yii::app()->mongodb->getDbInstance()->selectCollection('entity_dota2_hero')->findOne(array('numId'=>intval($heroId)), array('_id','name'));
		if(!empty($numId_arr)){
			return $numId_arr;
		}else{
			return '';
		}
	}
	/**
	 * 获取趋势页的头像信息
	 */
	public function getHeroImg()
	{
		$HeroImg = Yii::app()->mongodb->getDbInstance()->selectCollection('entity_dota2_hero')->find(array(), array('_id', 'numId', 'name','Team','AttributePrimary'))->sort(array('numId'=>1));
		if(!empty($HeroImg)){
			foreach ($HeroImg as $doc) {
				$hero_arr[$doc['Team']][$doc['AttributePrimary']][] = $doc;
			}
		}
		return $hero_arr;
	}
}
