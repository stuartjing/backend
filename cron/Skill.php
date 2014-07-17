<?php
include_once('IAttr.php');
include_once('TextAttr.php');
ini_set('max_execution_time',0);
date_default_timezone_set('PRC');
//连接mysql
$mysql = mysql_connect("mysql3307-m.dota2-ana.db.internal.17173.com:3307/dota2","prog_admin","Ml.asdlfl23rqfa790jJKJfxP.f2G");
if(!$mysql){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('dota2');
mysql_query("set names 'utf8'"); //UTF8不能有
//连接mongo
$mongo = new Mongo("mongodb://prog_admin:aduwefMadsflw3eocdweoM@10.59.95.192:27022/gamedb");       //connect to mongs
/**
 * 加点统计页
 */
$bbh =  $mongo->selectDB('gamedb')->selectCollection('entity_dota2_bbh')->findOne();//获取当前版本号
$hero = $mongo->selectDB('gamedb')->selectCollection('entity_dota2_hero')->find(array(),array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'));
$start = array($bbh['name'],'周','月');
$skinfo1 = array();
foreach($start as $sval){
	$key = 0;
	foreach($hero as $val){
		$skinfo1[$sval][$key]['_id'] = $val['_id'];
		$skinfo1[$sval][$key]['name'] = $val['name'];
		$skinfo1[$sval][$key]['头像'] = $val['头像'];
		$skinfo1[$sval][$key]['AttributePrimary'] = $val['AttributePrimary'];
		$skinfo1[$sval][$key]['AttackCapabilities'] = $val['AttackCapabilities'];
		$skinfo1[$sval][$key]['Roles'] = $val['Roles'];
		$data = getSkill($val['numId'],$sval,$bbh);
		//获取十个技能的名称，id，图标
		$numid = explode(",",$data['skill']['ability']);
		$numid_all = array();
		for($i=0;$i<count($numid);$i++){
			$numid_all[] = intval($numid[$i]);
		}
		$ability = $mongo->selectDB('gamedb')->selectCollection('entity_dota2_skill')->find(array('numId'=>array('$in' => $numid_all)),array('_id', 'name', 'icon', 'numId'));
		$ab = array();
		foreach($ability as $v){
			$ab[$v['numId']] = $v;
		}
		$abilitytop = array();
		$ability_top = array();
		$yxjm = array();
		$yxjm_info = array();
		foreach($numid_all as $ke=>$va){
			if(array_key_exists($va,$ab)){
				$ability_top['_id'] = $ab[$va]['_id'];
				$ability_top['name'] = $ab[$va]['name'];
				$abilitytop[] = $ability_top;
				unset($ability_top);
			}
			if(array_key_exists($data['yxjm']['ability'],$ab)){
				$yxjm_info['_id'] = $v['_id'];
				$yxjm_info['name'] = $v['name'];
				$yxjm = $yxjm_info;
				unset($yxjm_info);
				continue;
			}
		}
		$skinfo1[$sval][$key]['ability'] = $abilitytop;
		$skinfo1[$sval][$key]['yxjm'] = $yxjm;
		$skinfo1[$sval][$key]['total'] = $data['yxjm']['total'];
		$key++;
		unset($abilitytop,$yxjm);
	}
}
$skill_week = $skinfo1['周'];
$skill_month = $skinfo1['月'];
$skill_bbh = $skinfo1[$bbh['name']];

//加点统计首页
function getSkill($data,$dvs='',$bbh){
	$t = time();
	if($dvs=='周'){
		$starttime = date("Ymd",($t-3600*24*6));
		$endtime = date("Ymd");
	}elseif($dvs=='月'){
		$starttime = date("Ymd",($t-3600*24*29));
		$endtime = date("Ymd");
	}else{
		$starttime = $bbh['updatetime'];
		$endtime = date("Ymd");
	}
	//最受欢迎加点Top
	$sql = "SELECT ability,sum(count) as total FROM stat_ability_upgrade where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id=".$data." group by ability order by total desc limit 1";
	$result = mysql_query($sql);
	$res['skill'] = mysql_fetch_row($result,MYSQL_ASSOC);
	//优先加满
	$sql1 ="select ability,sum(count) as total from stat_ability_priority where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id = ".$data." group by ability order by total desc limit 1";
	$result1 = mysql_query($sql1);
	$res['yxjm'] = mysql_fetch_row($result1,MYSQL_ASSOC);
	return $res;
}

$memcache = new Memcache();
$memcache->connect('10.59.95.192', 16004) or die ("Could not connect");	
$m1 = $memcache->set(md5('gamedbweek_data1'), serialize(array($skill_week,null)), false) or die ("Failed to save data at the server");
$m2 = $memcache->set(md5('gamedbmonth_data1'), serialize(array($skill_month,null)), false) or die ("Failed to save data at the server");
$m3 = $memcache->set(md5('gamedbbbh_data1'), serialize(array($skill_bbh,null)), false) or die ("Failed to save data at the server");
if($m1 && $m2 && $m3){
	echo "成功";exit;
}