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
$db = $mongo->selectDB('gamedb');
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
	$finds[$sf]['全部'] = '全部';
}
$bbh =  $mongo->selectDB('gamedb')->selectCollection('entity_dota2_bbh')->findOne();//获取当前版本号
$armory = array();
$hero = array();
$item = array();
$heroinfo = array();
$start = array('周','月',$bbh['name']);
foreach($start as $sval){
	foreach($finds['AttributePrimary'] as $key=>$lx){
		foreach($finds['AttackCapabilities'] as $ke=>$gj){
			foreach($finds['Roles'] as $k=>$dw){
				$aa = array();
				if($lx!='全部')$aa['AttributePrimary'] = $lx;
				if($gj!='全部')$aa['AttackCapabilities'] = $gj;
				if($dw!='全部')$aa['Roles'] = new MongoRegex('/^'.$dw.'.*/i');
				$hero[$lx.'_'.$gj.'_'.$dw] = $db->selectCollection('entity_dota2_hero')->find($aa,array('_id','name','头像','numId','AttributePrimary','AttackCapabilities','Roles'));
				
				$vke = 0;
				$numid = array();
				foreach($hero[$lx.'_'.$gj.'_'.$dw] as $val){
					$numid[] = $val['numId'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['_id'] = $val['_id'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['name'] = $val['name'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['Roles'] = $val['Roles'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['AttackCapabilities'] = $val['AttackCapabilities'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['AttributePrimary'] = $val['AttributePrimary'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['numId'] = $val['numId'];
					$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['头像'] = $val['头像'];
					$vke++;
				}
				$numid_all = implode(",",$numid);
				$datas = getArmory($numid_all,$sval,$bbh);
				$dataitem = array_reverse($datas);
				foreach($dataitem as $ikey=>$ival){
					foreach($ival as $ike=>$iva){
						$iteminfo = $db->selectCollection('entity_dota2_item')->findOne(array('numId'=>intval($iva['item_id'])),array('_id', 'name', 'icon', 'numId', 'itemId'));
						$item[$sval][$lx.'_'.$gj.'_'.$dw][$ikey][$ike]['_id'] = $iteminfo['_id'];
						$item[$sval][$lx.'_'.$gj.'_'.$dw][$ikey][$ike]['name'] = $iteminfo['name'];
						$item[$sval][$lx.'_'.$gj.'_'.$dw][$ikey][$ike]['itemId'] = $iteminfo['itemId'];
						$item[$sval][$lx.'_'.$gj.'_'.$dw][$ikey][$ike]['icon'] = $iteminfo['icon'];
						$item[$sval][$lx.'_'.$gj.'_'.$dw][$ikey][$ike]['sumcount'] = $iva['sumcount'];
					}
				}
			}
		}
	}
}
$item_week = $item['周'];
$item_month = $item['月'];
$item_bbh = $item[$bbh['name']];
//出装统计首页
function getArmory($data,$dvs='',$bbh){
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
	$datas = "";
	if($data!=''){
		$datas = " and hero_id in(".$data.")";
	}
	$level = array('前期'=>array(1,2,3,4,5,6,7,8),'过渡'=>array(9,10,11,12,13,14),'成型'=>array(15,16,17,18,19,20),'后期'=>array(21,22,23,24,25));
	foreach($level as $key=>$val){
		$sql = "select item_id,sum(count) as sumcount from stat_item where match_date >= ".$starttime." and match_date < ".$endtime." and level in (".implode(",",$val).") ".$datas." group by item_id order by sumcount desc limit 10";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result,MYSQL_ASSOC) ){
			$res[$key][] = $row;
		}
	}
	return $res;
}
$memcache = new Memcache();
$memcache->connect('10.59.95.192', 16004) or die ("Could not connect");	
$m1 = $memcache->set(md5('gamedbarmory_heross'), serialize(array($heroinfo,null)), false) or die ("Failed to save data at the server");
$m2 = $memcache->set(md5('gamedbarmory_item_week'), serialize(array($item_week,null)), false) or die ("Failed to save data at the server");
$m3 = $memcache->set(md5('gamedbarmory_item_month'), serialize(array($item_month,null)), false) or die ("Failed to save data at the server");
$m4 = $memcache->set(md5('gamedbarmory_item_bbh'), serialize(array($item_bbh,null)), false) or die ("Failed to save data at the server");
if($m1 && $m2 && $m3 && $m4){
	echo "成功";exit;
}