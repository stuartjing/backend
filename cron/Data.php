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
 * 数据统计页
 */
$search_fields = array('AttributePrimary', 'AttackCapabilities', 'Roles');	//查询字段
//过滤条件配置获取并抽取数据并转换
$finds = array();
$attrobj = new TextAttr();
foreach($search_fields as $sf){
	$sf_info = $mongo->selectDB('gamedb')->selectCollection('attr')->findOne(array('object_code' => 'hero','code' => $sf));
	$finds[$sf] = $attrobj->makeOption($sf_info['option']);
}

$bbh =  $mongo->selectDB('gamedb')->selectCollection('entity_dota2_bbh')->findOne();
$hero = $mongo->selectDB('gamedb')->selectCollection('entity_dota2_hero')->find(array(),array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'));
$datainfo = array();
$start = array('周','月',$bbh['name']);
foreach($start as $sval){
	$key = 0;
	foreach($hero as $val){
		$datainfo[$sval][$key]['_id'] = $val['_id'];
		$datainfo[$sval][$key]['name'] = $val['name'];
		$datainfo[$sval][$key]['头像'] = $val['头像'];
		$datainfo[$sval][$key]['AttributePrimary'] = $val['AttributePrimary'];
		$datainfo[$sval][$key]['AttackCapabilities'] = $val['AttackCapabilities'];
		$datainfo[$sval][$key]['Roles'] = $val['Roles'];
		$data = getData($val['numId'],$sval,$bbh);
		$datainfo[$sval][$key]['win'] = $data['sumwin'];
		$datainfo[$sval][$key]['count'] = $data['sumcount'];
		$datainfo[$sval][$key]['winning'] = number_format($data['sumwin']/$data['sumcount']*100,1,'.','');
		$datainfo[$sval][$key]['kills'] = number_format($data['sumkills']/$data['sumlevel']*25,1,'.','');
		$datainfo[$sval][$key]['deaths'] = number_format($data['sumdeaths']/$data['sumlevel']*25,1,'.','');
		$datainfo[$sval][$key]['last_hits'] = number_format($data['sumlast_hits']/$data['sumlevel']*25,1,'.','');
		$datainfo[$sval][$key]['denies'] = number_format($data['sumdenies']/$data['sumlevel']*25,1,'.','');
		$datainfo[$sval][$key]['assists'] = number_format($data['sumassists']/$data['sumlevel']*25,1,'.','');
		$datainfo[$sval][$key]['gold_per_min'] = round($data['sumgold_per_min']/$data['sumlevel']*25);
		$datainfo[$sval][$key]['xp_per_min'] = round($data['sumxp_per_min']/$data['sumlevel']*25);
		$key++;
	}
}

$week_data = json_encode($datainfo['周']);
$month_data = json_encode($datainfo['月']);
$bbh_data = json_encode($datainfo[$bbh['name']]);
$filename = dirname(dirname(__FILE__))."/js/data.js";
if (file_exists($filename)) {
	$json = "var weekdata = ".$week_data.";
			var monthdata = ".$month_data.";
			var bbhdata = ".$bbh_data.";";
	file_put_contents(dirname(dirname(dirname(__FILE__)))."/js/data.js",$json);
}

function getData($data,$dvs='',$bbh){
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
	$sql = "select hero_id,sum(win) as sumwin,sum(count) as sumcount,sum(kills) as sumkills,sum(deaths) as sumdeaths,sum(last_hits) as sumlast_hits,sum(denies) as sumdenies,sum(assists) as sumassists,sum(gold_per_min) as sumgold_per_min,sum(xp_per_min) as sumxp_per_min,sum(level) as sumlevel from stat_hero where match_date >= ".$starttime." and match_date < ".$endtime." and hero_id=".$data;
	$result = mysql_query($sql);
	$res = mysql_fetch_array($result,MYSQL_ASSOC);
	return $res;
}

$memcache = new Memcache();
$memcache->connect('10.59.95.192', 16004) or die ("Could not connect");	
$m = $memcache->set(md5('gamedbdata_info'), serialize(array($datainfo,null)), false) or die ("Failed to save data at the server");
if($m){
	echo "成功";exit;
}