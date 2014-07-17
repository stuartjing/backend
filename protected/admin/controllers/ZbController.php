<?php
/**
 * 数据库显示控制器
 * @author user
 *
 */
class ZbController extends Controller
{
	public $base_url;

	public function init(){
		$this->base_url = 'http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * 战报统计首页
	 */
	public function actionIndex(){
		$getTitle = '战报统计首页';
		$this->pageTitle='Dota2战报数据统计 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2战报数据统计,分析Dota2英雄战斗数据出场胜率,了解近期战网玩家对英雄的出装及加点顺序。');
		$this->setPageState('keywords', 'Dota2数据库战报数据统计');
		$tj = new Zb();
		//统计周月版本内比赛场次
		$bbh=$this->get_bbh();
		$res = $tj->getNum($bbh['name']);
		//print_r($res);exit;
		//本周胜率最高,本周装备最多,本周最多加满
		$info = $this->getC('infos');					 //获取$info缓存
		if (empty($info)) {
			$weeknum = $tj->getWeekNum();
			if($weeknum['sl']){
				$criteria = new EMongoCriteria(array(
					'conditions'=>array(
						'numId'=>array('==' => intval($weeknum['sl']['hero_id'])),	//条件
					),
					'select'=>array('_id', 'name', '头像', 'numId'),
				));
				$info['sl'] = Entity::model('entity_dota2_hero')->find($criteria);
			}
			if($weeknum['zb']){
				$criteria = new EMongoCriteria(array(
					'conditions'=>array(
						'numId'=>array('==' => intval($weeknum['zb']['item_id'])),	//条件
					),
					'select'=>array('_id', 'name', 'icon', 'numId'),
				));
				$info['zb'] = Entity::model('entity_dota2_item')->find($criteria);
			}
			if($weeknum['jm']){
				$criteria = new EMongoCriteria(array(
					'conditions'=>array(
						'numId'=>array('==' => intval($weeknum['jm']['ability'])),	//条件
					),
					'select'=>array('_id', 'name', 'icon', 'numId'),
				));
				$info['jm'] = Entity::model('entity_dota2_skill')->find($criteria);
			}
			$this->setC('infos',$info,24); 			//存储$info缓存
		}
		$this->layout='analytics_main';
		$this->render('analytics', array('info'=>$info,'res'=>$res,'getTitle'=>$getTitle));
	}
	
	/**
	 * 数据统计页
	 */
	public function actionData(){
		$getTitle = '数据统计页';
		$this->pageTitle='Dota2数据统计 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2战报数据统计,分析Dota2英雄战斗数据出场胜率,了解近期战网玩家对英雄的出装及加点顺序。');
		$this->setPageState('keywords', 'Dota2数据统计,统计英雄出场胜率杀人助攻');
		$tj = new Zb();
		$search_fields = array('AttributePrimary', 'AttackCapabilities', 'Roles');	//查询字段
		//过滤条件配置获取并抽取数据并转换
		$finds = array();
		$findss = array();
		$attrobj = new TextAttr();
		foreach($search_fields as $sf){
			$sf_info = Attr::model()->get('hero', $sf);
			$finds[$sf] = $attrobj->makeOption($sf_info['option']);
			$findss[$sf] = $attrobj->makeOption($sf_info['option']);
			$findss[$sf]['全部'] = '全部';
		}
		
		$bbh = $this->get_bbh();//获取当前版本号
		$datainfo = $this->getC('data_info');		//获取缓存
		if(empty($datainfo)){
			$datainfo = array();
			$start = array('周','月',$bbh['name']);
			foreach($start as $sval){
				$criteria = new EMongoCriteria(array(
					'select'=>array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'),
				));
				$hero = Entity::model('entity_dota2_hero')->findAll($criteria);
				foreach($hero as $key=>$val){
					$datainfo[$sval][$key]['_id'] = $val['_id'];
					$datainfo[$sval][$key]['name'] = $val['name'];
					$datainfo[$sval][$key]['头像'] = $val['头像'];
					$datainfo[$sval][$key]['AttributePrimary'] = $val['AttributePrimary'];
					$datainfo[$sval][$key]['AttackCapabilities'] = $val['AttackCapabilities'];
					$datainfo[$sval][$key]['Roles'] = $val['Roles'];
					$data = $tj->getData($val['numId'],$sval);
					$datainfo[$sval][$key]['win'] = isset($data['sumwin'])?$data['sumwin']:0;
					$datainfo[$sval][$key]['count'] = isset($data['sumcount'])?$data['sumcount']:0;
					$datainfo[$sval][$key]['winning'] = isset($data['sumcount'])?number_format($data['sumwin']/$data['sumcount']*100,1,'.',''):0;
					$datainfo[$sval][$key]['kills'] = isset($data['sumlevel'])?number_format($data['sumkills']/$data['sumlevel']*25,1,'.',''):0;
					$datainfo[$sval][$key]['deaths'] = isset($data['sumlevel'])?number_format($data['sumdeaths']/$data['sumlevel']*25,1,'.',''):0;
					$datainfo[$sval][$key]['last_hits'] = isset($data['sumlevel'])?number_format($data['sumlast_hits']/$data['sumlevel']*25,1,'.',''):0;
					$datainfo[$sval][$key]['denies'] = isset($data['sumlevel'])?number_format($data['sumdenies']/$data['sumlevel']*25,1,'.',''):0;
					$datainfo[$sval][$key]['assists'] = isset($data['sumlevel'])?number_format($data['sumassists']/$data['sumlevel']*25,1,'.',''):0;
					$datainfo[$sval][$key]['gold_per_min'] = isset($data['sumlevel'])?round($data['sumgold_per_min']/$data['sumlevel']*25):0;
					$datainfo[$sval][$key]['xp_per_min'] = isset($data['sumlevel'])?round($data['sumxp_per_min']/$data['sumlevel']*25):0;
				}
			}
			$this->setC('data_info',$datainfo,24); 			//存储缓存
			
			$week_data = json_encode($datainfo['周']);
			$month_data = json_encode($datainfo['月']);
			$bbh_data = json_encode($datainfo[$bbh['name']]);
			$filename = dirname(dirname(dirname(__FILE__)))."/js/data.js";
			if (file_exists($filename) && filemtime($filename)+60*60*24<=time()) {
				$json = "var weekdata = ".$week_data.";
						var monthdata = ".$month_data.";
						var bbhdata = ".$bbh_data.";";
				file_put_contents(dirname(dirname(dirname(__FILE__)))."/js/data.js",$json);
			}
		}
		$this->layout='data_main';
		$this->render('data', array('heroinfo'=>$datainfo[$bbh['name']],'getTitle'=>$getTitle,'finds'=>$finds));
	}
	
	/**
	 * 出装统计页
	 */
	public function actionArmory(){
		$getTitle = '出装统计页';
		$this->pageTitle='Dota2出装统计 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2战报数据统计,分析Dota2英雄战斗数据出场胜率,了解近期战网玩家对英雄的出装及加点顺序。');
		$this->setPageState('keywords', 'Dota2出装统计,统计英雄前期中期后期出装');
		$tj = new Zb();
		$search_fields = array('AttributePrimary', 'AttackCapabilities', 'Roles');	//查询字段
		//过滤条件配置获取并抽取数据并转换
		$finds = array();
		$findss = array();
		$attrobj = new TextAttr();
		foreach($search_fields as $sf){
			$sf_info = Attr::model()->get('hero', $sf);
			$finds[$sf] = $attrobj->makeOption($sf_info['option']);
			$findss[$sf] = $attrobj->makeOption($sf_info['option']);
			$findss[$sf]['全部'] = '全部';
		}
		$heroinfo = $this->getC('armory_heross');					 //获取缓存
		$item_week = $this->getC('armory_item_week');					 //获取缓存
		$item_month = $this->getC('armory_item_month');					 //获取缓存
		$item_bbh = $this->getC('armory_item_bbh');					 //获取缓存
		$bbh = $this->get_bbh();//获取当前版本号
		if (empty($heroinfo) || empty($item_week) || empty($item_month) || empty($item_bbh)) {
			$armory = array();
			$hero = array();
			$item = array();
			$heroinfo = array();
			$start = array('周','月',$bbh['name']);
			foreach($start as $sval){
				foreach($findss['AttributePrimary'] as $key=>$lx){
					foreach($findss['AttackCapabilities'] as $ke=>$gj){
						foreach($findss['Roles'] as $k=>$dw){
							if($lx=='全部')$lx1 = '';else $lx1 = $lx;
							if($gj=='全部')$gj1 = '';else $gj1 = $gj;
							if($dw=='全部')$dw1 = '';else $dw1 = $dw;
							$criteria = new EMongoCriteria(array(
								'conditions'=>array(
									'AttributePrimary'=>array('==' => $lx1),	//条件
									'AttackCapabilities'=>array('==' => $gj1),	//条件
									'Roles'=>array('==' => new MongoRegex('/^'.$dw1.'.*/i')),		//模糊查询
								),
								'select'=>array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'),
							));
							
							$hero[$lx.'_'.$gj.'_'.$dw] = Entity::model('entity_dota2_hero')->findAll($criteria);
							$numid = array();
							foreach($hero[$lx.'_'.$gj.'_'.$dw] as $vke=>$val){
								$numid[] = $val['numId'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['_id'] = $val['_id'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['name'] = $val['name'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['Roles'] = $val['Roles'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['AttackCapabilities'] = $val['AttackCapabilities'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['AttributePrimary'] = $val['AttributePrimary'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['numId'] = $val['numId'];
								$heroinfo[$lx.'_'.$gj.'_'.$dw][$vke]['头像'] = $val['头像'];
							}
							$numid_all = implode(",",$numid);
							$datas = $tj->getArmory($numid_all,$sval);
							$dataitem = array_reverse($datas);
							foreach($dataitem as $ikey=>$ival){
								foreach($ival as $ike=>$iva){
									$criterias = new EMongoCriteria(array(
										'conditions'=>array(
											'numId'=>array('==' => intval($iva['item_id'])),	//条件
										),
										'select'=>array('_id', 'name', 'icon', 'numId', 'itemId'),
									));
									$iteminfo = Entity::model('entity_dota2_item')->find($criterias);
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
			$this->setC('armory_heross',$heroinfo,24); 			//存储$armory缓存
			$this->setC('armory_item_week',$item_week,24); 			//存储$armory缓存
			$this->setC('armory_item_month',$item_month,24); 			//存储$armory缓存
			$this->setC('armory_item_bbh',$item_bbh,24); 			//存储$armory缓存
		}
		$this->layout='armory_main';
		$this->render('armory', array('getTitle'=>$getTitle,'data'=>$item_bbh,'hero'=>$heroinfo,'finds'=>$finds));
	}
	
	/**
	 * 加点统计页
	 */
	public function actionSkill(){
		set_time_limit(0);
		$getTitle = '加点统计页';
		$this->pageTitle='Dota2加点统计 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2战报数据统计,分析Dota2英雄战斗数据出场胜率,了解近期战网玩家对英雄的出装及加点顺序。');
		$this->setPageState('keywords', 'Dota2加点统计,统计英雄加点方式');
		$tj = new Zb();
		$skill = new Entity();
		$search_fields = array('AttributePrimary', 'AttackCapabilities', 'Roles');	//查询字段
		//过滤条件配置获取并抽取数据并转换
		$finds = array();
		$attrobj = new TextAttr();
		foreach($search_fields as $sf){
			$sf_info = Attr::model()->get('hero', $sf);
			$finds[$sf] = $attrobj->makeOption($sf_info['option']);
		}
		$criteria = new EMongoCriteria(array(
			'select'=>array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'),
		));
		$hero = Entity::model('entity_dota2_hero')->findAll($criteria);
				
		$bbh = $this->get_bbh();//获取当前版本号
		$skill_week = $this->getC('week_data1');					 //获取缓存
		$skill_month = $this->getC('month_data1');					 //获取缓存
		$skill_bbh = $this->getC('bbh_data1');					 //获取缓存
		$i = 0;
		if (empty($skill_week) || empty($skill_month) || empty($skill_bbh)) {
			$start = array($bbh['name'],'周','月');
			foreach($start as $sval){
				foreach($hero as $key=>$val){
					$skinfo1[$sval][$key]['_id'] = $val['_id'];
					$skinfo1[$sval][$key]['name'] = $val['name'];
					$skinfo1[$sval][$key]['头像'] = $val['头像'];
					$skinfo1[$sval][$key]['AttributePrimary'] = $val['AttributePrimary'];
					$skinfo1[$sval][$key]['AttackCapabilities'] = $val['AttackCapabilities'];
					$skinfo1[$sval][$key]['Roles'] = $val['Roles'];
					$data = $tj->getSkill($val['numId'],$sval);
					//获取十个技能的名称，id，图标
					$ability = $skill->getAbility($data['skill']['ability']);
					$numid_all = array_map(array($this,'prefixPath'), explode(",",$data['skill']['ability']));
					$abilitytop = array();
					$ability_top = array();
					$yxjm = array();
					$yxjm_info = array();
					foreach($numid_all as $ke=>$va){
						foreach($ability as $k=>$v){
							if (in_array($va,array($v['numId']))){
								$ability_top['_id'] = $ability[$k]['_id'];
								$ability_top['name'] = $ability[$k]['name'];
								$abilitytop[] = $ability_top;
							}
							if (in_array($data['yxjm']['ability'],array($v['numId']))){
								$yxjm_info['_id'] = $ability[$k]['_id'];
								$yxjm_info['name'] = $ability[$k]['name'];
								$yxjm = $yxjm_info;
								continue;
							}
						}
					}
					$skinfo1[$sval][$key]['ability'] = $abilitytop;
					$skinfo1[$sval][$key]['yxjm'] = $yxjm;
					$skinfo1[$sval][$key]['total'] = $data['yxjm']['total'];
				}
			}
			
			$skill_week = $skinfo1['周'];
			$skill_month = $skinfo1['月'];
			$skill_bbh = $skinfo1[$bbh['name']];
			$this->setC('week_data1',$skill_week,24); 			//存储缓存
			$this->setC('month_data1',$skill_month,24); 			//存储缓存
			$this->setC('bbh_data1',$skill_bbh,24); 			//存储缓存
		}
		$this->layout='skill_main';
		$this->render('skill', array('getTitle'=>$getTitle,'skillinfo'=>$skill_bbh,'finds'=>$finds));
	}
	
	
	public function prefixPath($n){
		return intval($n);
	}
}