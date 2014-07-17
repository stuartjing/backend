<?php
/**
 * 父类model
 * Enter description here ...
 * @author enky
 *
 */
class Zb extends Fuqin
{
	//英雄页统计
	function getTjInfo($data){
		$t = time();
		if($data['dvs']=='周'){
			$starttime = date("Ymd",($t-3600*24*7));
			$endtime = date("Ymd");
		}elseif($data['dvs']=='月'){
			$starttime = date("Ymd",($t-3600*24*30));
			$endtime = date("Ymd");
		}else{
			$bbh = $this->get_bbh($data['dvs']);
			$starttime = $bbh['updatetime'];
			$endtime = date("Ymd");
		}
		//最受欢迎加点Top
		$total_sql = "SELECT ability,sum(count) as total FROM stat_ability_upgrade where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id = ".$data['numId']." group by ability order by total desc limit 3";
		$res['skill'] = Yii::app()-> db2 -> queryAll($total_sql);
		//优先加满
		$sql = "select ability,sum(count) as total from stat_ability_priority where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id = ".$data['numId']." group by ability order by total desc limit 3";
		$res['yxjm'] = Yii::app()-> db2 -> queryAll($sql);
		return $res;
	}
	//英雄页出装
	function getCzInfo($data){
		$t = time();
		if($data['dvs']=='周'){
			$starttime = date("Ymd",($t-3600*24*7));
			$endtime = date("Ymd");
		}elseif($data['dvs']=='月'){
			$starttime = date("Ymd",($t-3600*24*30));
			$endtime = date("Ymd");
		}else{
			$bbh = $this->get_bbh($data['dvs']);
			$starttime = $bbh['updatetime'];
			$endtime = date("Ymd");
		}
		$level = array('前期'=>array(8),'过渡'=>array(14),'成型'=>array(20),'后期'=>array(25));
		foreach($level as $key=>$val){
			$sql = "select item_id,sum(count) as sumcount from stat_item where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id=".$data['numId']." and level in (".implode(",",$val).") group by item_id order by sumcount desc  limit 10";
			$res[$key] = Yii::app()-> db2 -> queryAll($sql);
		}
		return $res;
	}
	//数据统计页-比赛场次
	function getNum($data){
		$t = time();
		$bbh = $this->get_bbh($data);
		$start = array('week'=>date("Ymd",($t-3600*24*7)),'month'=>date("Ymd",($t-3600*24*30)),'bbh'=>$bbh['updatetime']);
		$endtime = date("Ymd");
		foreach($start as $key=>$val){
			$sql = "select sum(count) as sumcount from stat_hero where match_date >= ".$val." and match_date <= ".$endtime;
			$re[$key] = Yii::app()-> db2 -> getRow($sql);
			$res[$key]['sumcount'] = ceil($re[$key]['sumcount']/10);
		}
		return $res;
	}
	//数据统计首页-本周胜率最高,本周装备最多,本周最多加满
	function getWeekNum(){
		$t = time();
		$starttime = date("Ymd",($t-3600*24*7));
		$endtime = date("Ymd");
		$sql = "select hero_id,(sum(win)/sum(count)) as num from stat_hero where match_date >= ".$starttime." and match_date < ".$endtime." group by hero_id order by num desc limit 1";
		$res['sl'] = Yii::app()-> db2 -> getRow($sql);
		$sql2 = "select item_id,sum(count) as sumcount from stat_item where match_date >= ".$starttime." and match_date < ".$endtime." group by item_id order by sumcount desc limit 1";
		$res['zb'] = Yii::app()-> db2 -> getRow($sql2);
		$sql3 = "select ability,sum(count) as total from stat_ability_priority where match_date >= ".$starttime." and match_date < ".$endtime." group by ability order by total desc limit 1";
		$res['jm'] = Yii::app()-> db2 -> getRow($sql3);
		return $res;
	}
	//数据统计首页
	function getData($data,$dvs=''){
		$t = time();
		if($dvs=='周'){
			$starttime = date("Ymd",($t-3600*24*7));
			$endtime = date("Ymd");
		}elseif($dvs=='月'){
			$starttime = date("Ymd",($t-3600*24*30));
			$endtime = date("Ymd");
		}else{
			$bbh = $this->get_bbh($dvs);
			$starttime = $bbh['updatetime'];
			$endtime = date("Ymd");
		}
		$sql = "select hero_id,sum(win) as sumwin,sum(count) as sumcount,sum(kills) as sumkills,sum(deaths) as sumdeaths,sum(last_hits) as sumlast_hits,sum(denies) as sumdenies,sum(assists) as sumassists,sum(gold_per_min) as sumgold_per_min,sum(xp_per_min) as sumxp_per_min,sum(level) as sumlevel from stat_hero where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id=".$data;
		$res = Yii::app()-> db2 -> getRow($sql);
		return $res;
	}
	//出装统计首页
	function getArmory($data,$dvs=''){
		$t = time();
		if($dvs=='周'){
			$starttime = date("Ymd",($t-3600*24*7));
			$endtime = date("Ymd");
		}elseif($dvs=='月'){
			$starttime = date("Ymd",($t-3600*24*30));
			$endtime = date("Ymd");
		}else{
			$bbh = $this->get_bbh($dvs);
			$starttime = $bbh['updatetime'];
			$endtime = date("Ymd");
		}
		$datas = "";
		if($data!=''){
			$datas = " and hero_id in(".$data.")";
		}
		$level = array('前期'=>array(8),'过渡'=>array(14),'成型'=>array(20),'后期'=>array(25));
		foreach($level as $key=>$val){
			$sql = "select item_id,sum(count) as sumcount from stat_item where match_date >= ".$starttime." and match_date < ".$endtime." and level in (".implode(",",$val).") ".$datas." group by item_id order by sumcount desc limit 10";
			$res[$key] = Yii::app()-> db2 -> queryAll($sql);
		}
		return $res;
	}
	//加点统计首页
	function getSkill($data,$dvs=''){
		$t = time();
		if($dvs=='周'){
			$starttime = date("Ymd",($t-3600*24*7));
			$endtime = date("Ymd");
		}elseif($dvs=='月'){
			$starttime = date("Ymd",($t-3600*24*30));
			$endtime = date("Ymd");
		}else{
			$bbh = $this->get_bbh($dvs);
			$bbh = $this->get_bbh($dvs);
			$starttime = $bbh['updatetime'];
			$endtime = date("Ymd");
		}
		//最受欢迎加点Top
		$sql = "SELECT ability,sum(count) as total FROM stat_ability_upgrade where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id=".$data." group by ability order by total desc limit 1";
		$res['skill'] = Yii::app()-> db2 -> getRow($sql);
		//优先加满
		$sql1 ="select ability,sum(count) as total from stat_ability_priority where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id = ".$data." group by ability order by total desc limit 1";
		$res['yxjm'] = Yii::app()-> db2 -> getRow($sql1);
		return $res;
	}
	
}