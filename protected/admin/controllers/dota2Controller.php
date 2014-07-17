<?php
/**
 * 数据库显示控制器
 * @author user
 *
 */
class Dota2Controller extends Controller
{
	/**
	 * 英雄，物品，技能
	 */
	public function actionInfoList(){

		//英雄
		$heroitem = 'hero';		//默认实体类型
		$herofilter = isset($_GET['filter'])?$_GET['filter']:'';						//查询过滤器
		$search_fields = array('AttributePrimary', 'AttackCapabilities', 'Roles');	//查询字段
		$data = array();			//数据集合
		//查询构造器
		$fields = array(
			'_id', 'name', '头像', 'AttributePrimary', 'AttackCapabilities', 'Roles'
		);
		
		$herofilter = $this->_structure_filter($herofilter);		//$filter = array('level_1_hp' => array('cond'=>'>', 'val'=>560))
		$herofilter = $this->_parse_filter($herofilter, $search_fields);

		//获取查询数据
		$data = $this->_query_filter($heroitem, $herofilter, $fields);
		$herolist = array();
		$hero = array();
		foreach($data as $val){
			foreach($val as $key=>$va){
				$hero[$fields[$key]] = $va;
				$hero['url'] = 'http://dota2.db.17173.com/index.php?r=site/hero&id='.$val[0];
			}
			$herolist[] = $hero;
		}
		
		//物品
		$item = 'item';
		$itemfilter = isset($_GET['filter'])?$_GET['filter']:'';					//查询过滤器
		$search_fields = array('Category', 'ItemShopTags');		//查询字段，物品分类，商店标签
		$data = array();			//数据集合
		//查询构造器
		$fields = array(
			'_id', 'name', 'icon', 'Category', 'ItemShopTags'
		);
		$itemfilter = $this->_structure_filter($itemfilter);		//$filter = array('level_1_hp' => array('cond'=>'>', 'val'=>560))
		$itemfilter = $this->_parse_filter($itemfilter, $search_fields);

		//获取查询数据
		$data = $this->_query_filter($item, $itemfilter, $fields);
		$itemlist = array();
		$item = array();
		foreach($data as $val){
			foreach($val as $key=>$va){
				$item[$fields[$key]] = $va;
				$item['url'] = 'http://dota2.db.17173.com/index.php?r=site/item&id='.$val[0];
			}
			$itemlist[] = $item;
		}
		
		//技能
		$skill = 'skill';
		$skillfilter = isset($_GET['filter'])?$_GET['filter']:'';					//查询过滤器
		$data = array();			//数据集合
		//查询构造器
		$fields = array(
			'_id', 'name', 'icon'
		);
		$skillfilter = $this->_structure_filter($skillfilter);		//$filter = array('level_1_hp' => array('cond'=>'>', 'val'=>560))
		$skillfilter = $this->_parse_filter($skillfilter);
		//获取查询数据
		$data = $this->_query_filter($skill, $skillfilter, $fields);
		$skilllist = array();
		$skill = array();
		foreach($data as $val){
			foreach($val as $key=>$va){
				$skill[$fields[$key]] = $va;
				$skill['url'] = 'http://dota2.db.17173.com/index.php?r=site/skill&id='.$val[0];
			}
			$skilllist[] = $skill;
		}
		$infolist = array();
		$infolist['hero'] = $herolist;
		$infolist['item'] = $itemlist;
		$infolist['skill'] = $skilllist;
		//生成json
		$infolist = $this->json_encode_china($infolist);
		print_r($infolist);exit;
	}
	
	
}