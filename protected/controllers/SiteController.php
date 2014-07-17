<?php
/**
 * 数据库显示控制器
 * @author user
 *
 */
class SiteController extends Controller
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

	public function actionTestkun(){
		$this->render('test_kun');
	}
	//视频碎片对应       灰烬之灵 大地之灵
	public $heroSp = array(
		'瘟疫法师'=>array('20131118105946','necrolyte'), '术士'=>array('20131118105902','warlock'), '痛苦女王'=>array('20131118105805','queenofpain'), 
		'死亡先知'=>array('20131118105704','death_prophet'), '帕格纳'=>array('20131118105605','pugna'), '戴泽'=>array('20131118105331','dazzle'), '拉席克'=>array('20131118105213','leshrac'), 
		'黑暗贤者'=>array('20131118105103','dark_seer'), '蝙蝠骑士'=>array('20131118104937','batrider'), '远古冰魄'=>array('20131118104841','aa'), '祈求者'=>array('20131118104742','invoker'), 
		'殁境神蚀者'=>array('20131118104533','obsidian_destroyer'), '暗影恶魔'=>array('20131118104418','shadow_demon'), '维萨吉'=>array('20131118104329','visage'), 
		'先知'=>array('20131118111904','furion'), '魅惑魔女'=>array('20131118111813','enchantress'), '杰奇洛'=>array('20131118111636','jakiro'), '陈'=>array('20131118111542','chen'), 
		'沉默术士'=>array('20131118111451','silencer'), '食人魔魔法师'=>array('20131118111359','ogre_magi'), '拉比克'=>array('20131118111258','rubick'), '干扰者'=>array('20131118111142','disruptor'), 
		'光之守卫'=>array('20131118111052','keeper_of_the_light'), '天怒法师'=>array('20131118111005','skywrath_mage'), '祸乱之源'=>array('20131118110850','bane'), 
		'巫妖'=>array('20131118110754','lich'), '莱恩'=>array('20131118110646','lion'), '巫医'=>array('20131118110551','witch_doctor'), '谜团'=>array('20131118110053','enigma'), 
		'编织者'=>array('20131118152733','weaver'), '幽鬼'=>array('20131118152653','spectre'), '米波'=>array('20131118152604','meepo'), '司夜刺客'=>array('20131118152522','nyx_assassin'), 
		'斯拉克'=>array('20131118152413','slark'), '美杜莎'=>array('20131118152322','medusa'), '灰烬之灵'=>array('20131118152233',''), '水晶室女'=>array('20131118113233','crystal_maiden'), 
		'帕克'=>array('20131118112617','puck'), '风暴之灵'=>array('20131118112511','storm_spirit'), '风行者'=>array('20131118112436','windrunner'), '宙斯'=>array('20131118112241','zuus'), 
		'莉娜'=>array('20131118112153','lina'), '暗影萨满'=>array('20131118112102','shadow_shaman'), '修补匠'=>array('20131118112009','tinker'), '赏金猎人'=>array('20131118154112','bounty_hunter'), 
		'熊战士'=>array('20131118154008','ursa'), '矮人直升机'=>array('20131118153922','gyrocopter'), '德鲁伊'=>array('20131118153741','lone_druid'), '娜迦海妖'=>array('20131118153643','naga_siren'), 
		'巨魔战将'=>array('20131118153552','troll_warlord'), '嗜血狂魔'=>array('20131118153504','bs'), '影魔'=>array('20131118153417','nevermore'), '剃刀'=>array('20131118153338','razor'), 
		'剧毒术士'=>array('20131118153252','venomancer'), '虚空假面'=>array('20131118153157','faceless_void'), '幻影刺客'=>array('20131118153104','phantom_assassin'), 
		'冥界亚龙'=>array('20131118153006','viper'), '克林克兹'=>array('20131118152906','clinkz'), '育母蜘蛛'=>array('20131118152817','broodmother'), '不朽尸王'=>array('20131118160238','ud'), 
		'马格纳斯'=>array('20131118160147','mag'), '亚巴顿'=>array('20131118160109','loa'), '大地之灵'=>array('20131118155932',''), '敌法师'=>array('20131118155004','am'), 
		'卓尔游侠'=>array('20131118154921','drow_ranger'), '主宰'=>array('20131118154836','juggernaut'), '米拉娜'=>array('20131118154759','mirana'), '变体精灵'=>array('20131118154720','morphling'), 
		'幻影长矛手'=>array('20131118154624','phantom_lancer'), '复仇之魂'=>array('20131118154540','vengefulspirit'), '力丸'=>array('20131118154502','riki'), '狙击手'=>array('20131118154339','sniper'), 
		'圣堂刺客'=>array('20131118154259','templar_assassin'), '露娜'=>array('20131118154153','luna'), '钢背兽'=>array('20131118161536','bb'), '巨牙海民'=>array('20131118161437','tusk'), 
		'上古巨神'=>array('20131118161251','tc'), '斧王'=>array('20131118161143','axe'), '帕吉'=>array('20131118161052','tf'), '沙王'=>array('20131118161007','sk'), 
		'斯拉达'=>array('20131118160915','sg'), '潮汐猎人'=>array('20131118160750','th'), '冥魂大帝'=>array('20131118160718','snk'), '噬魂鬼'=>array('20131118160639','naix'), 
		'暗夜魔王'=>array('20131118160601','ns'), '末日使者'=>array('20131118160522','doom'), '裂魂人'=>array('20131118160444','sb'), '狼人'=>array('20131118160401','lyc'), 
		'混沌骑士'=>array('20131118160318','ck'), '撼地者'=>array('20131118162613','es'), '斯温'=>array('20131118162540','sven'), '小小'=>array('20131118162448','tiny'), 
		'昆卡'=>array('20131118162413','coco'), '兽王'=>array('20131118162322','bm'), '龙骑士'=>array('20131118162158','longqi'), '发条技师'=>array('20131118162121','cg'), 
		'全能骑士'=>array('20131118162045','ok'), '哈斯卡'=>array('20131118162009','huskar'), '炼金术士'=>array('20131118161930','alchemist'), '酒仙'=>array('20131118161854','panda'), 
		'树精卫士'=>array('20131118161817','tp'), '艾欧'=>array('20131118161716','wisp'), '半人马战行者'=>array('20131118161644','cw'), '伐木机'=>array('20131118161610','gs'), 
		'恐怖利刃'=>array('20140211145032','tb'), '凤凰'=>array('20140211144902','phx'), '军团指挥官'=>array('20131218170459','lc')
	);
	/*public $heroimg = array(
		'力量'=>'pip_力量英雄.png', '敏捷'=>'pip_agi_敏捷英雄.png', '智力'=>'pip_int_智力英雄.png', 
		'近战'=>'近战.png', '远程'=>'远程.png', 
		'天辉'=>'pip_radiant_天辉阵营.png', '夜魇'=>'pip_dire_夜魇阵营.png',
		'核心'=>'pip_cary_核心.png','逃生'=>'pip_escape.png', '耐久'=>'pip_tank_耐久.png','先手'=>'pip_init_先手.png','控制'=>'pip_disa_控制.png','打野'=>'pip_jung_打野.png','高爆发'=>'pip_gank_高爆发.png','辅助'=>'pip_roam_辅助.png','对线辅助'=>'pip_baby_对线辅助.png','推进'=>'pip_push_推进.png'
	);*/
	
	public $heroimg = array(
		'力量'=>'pip_llyx.png', '敏捷'=>'pip_agi_mjyx.png', '智力'=>'pip_int_zlyx.png', 
		'近战'=>'jz.png', '远程'=>'yc.png', 
		'天辉'=>'pip_radiant_thzy.png', '夜魇'=>'pip_dire_yyzy.png',
		'核心'=>'pip_cary_hx.png','逃生'=>'pip_escape.png', '耐久'=>'pip_tank_nj.png','先手'=>'pip_init_xs.png','控制'=>'pip_disa_kz.png','打野'=>'pip_jung_dy.png','高爆发'=>'pip_gank_gbf.png','辅助'=>'pip_roam_fz.png','对线辅助'=>'pip_baby_dxfz.png','推进'=>'pip_push_tj.png'
	);
	
	/**
	 * 首页
	 */
	public function actionIndex(){
		$this->make_page_cache();	//检查缓存
		$getTitle = '首页';
		$this->pageTitle='Dota2数据库 - 英雄资料 - 物品资料 - 数据统计 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2英雄、物品资料查询,分析Dota2英雄的特性,介绍Dota2物品的使用,根据战报数据统计分析英雄出装加点趋势,指导新手玩家熟悉Dota2英雄出装及加点顺序。');
		$this->setPageState('keywords', 'Dota2数据库,英雄,物品,数据统计');
		$fields = array(
			'_id', 'Team', 'name', '真名', '头像', 'level_1_hp', 'level_1_mp',
			'AttributeBaseStrength', 'AttributeBaseAgility', 'AttributeBaseIntelligence',
			'level_1_ap_min', 'level_1_ap_max', 'level_1_armor', 'AttackRange',
			'VisionDaytimeRange', 'VisionNighttimeRange', 'MovementSpeed',
			'ProjectileSpeed', 'AttackAnimationPoint', 'Abilities','AttributePrimary','AttackCapabilities','Roles'
		);
		$game_id = 'dota2';			//游戏
		$object_id = 'hero';		//默认实体类型
		$team = array('天辉','夜魇');	//radiant（天辉） dire（夜魇）
		$primary = array('力量','敏捷','智力');
		
		//获取缓存文件
		$hero = $this->getC('heross');					 //获取$hero缓存
		if (empty($hero)) {
			// 获取所有信息数据start
			$criteria = new EMongoCriteria(array(
				'sort'=>array(
					'numId'=>1,	//条件
				)
		 	));
			$criteria->select($fields);
			$tmp_hero = Entity::model('entity_'.$game_id.'_'.$object_id)->findAll($criteria);
			// 关联信息获取
			$attr = Attr::model()->getAll($object_id);
			foreach ($tmp_hero as $tKey => $tValue){
				
				$heroDetail_ls[$tKey] = array();
				$heroDetail_ls[$tKey]['_id'] = $tValue['_id'];
				$heroDetail_ls[$tKey]['name'] = $tValue['name'];
				$heroDetail_ls[$tKey]['Roles'] = $tValue['Roles'];
				//攻击范围,初始护甲取整
				$heroDetail_ls[$tKey]['level_1_ap'] = floor(($tValue['level_1_ap_min']+$tValue['level_1_ap_max'])/2);
				$heroDetail_ls[$tKey]['level_1_armor_qz'] = floor($tValue['level_1_armor']);

				foreach ($fields as $fk=>$fo){
					if(isset($attr[$fo])){
						$avo = $attr[$fo];
						$avo['return'] = array('icon','hotkey','maxlevel');
						$heroDetail_ls[$tKey][$fo] = $this->getAttrView($avo, $tValue[$fo]);	//把数据按类型处理
					}
				}
				// 用于首页默认显示英雄图标
				$hero[$tValue['Team']][$tValue['AttributePrimary']][] = $tValue;
				// 列表页的英雄
			}
			krsort($hero);
			ksort($hero['天辉']);
			ksort($hero['夜魇']);
			$lich = $hero['夜魇']['智力'][3];
			$hero['夜魇']['智力'][3] = $hero['夜魇']['智力'][2];
			$hero['夜魇']['智力'][2] = $hero['夜魇']['智力'][1];
			$hero['夜魇']['智力'][1] = $lich;
			
			$this->setC('heross',$hero,24); 			//存储$hero缓存
			$this->setC('heroDetail_lsss',$heroDetail_ls);  //存储$heroDetail_ls缓存
		}
		
		// 获取所有信息数据 end
		$fields_rs = $this->json_encode_china($fields);		//转配置
		
		$filename = dirname(dirname(dirname(__FILE__)))."/js/herodata.js";
		if (file_exists($filename) && filemtime($filename)+60*60*24<=time()) {
			$heroDetail_ls = $this->getC('heroDetail_lsss');  //获取$heroDetail_ls缓存
			$list_rs = json_encode($heroDetail_ls);
			$json = "var list_conf = ".$fields_rs.";
				 var global_json_data = ".$list_rs.";";
			file_put_contents(dirname(dirname(dirname(__FILE__)))."/js/herodata.js",$json);
		}
		
		$search_fields = array('AttributePrimary', 'AttackCapabilities', 'Roles');	//查询字段
		//过滤条件配置获取并抽取数据并转换
		$finds = array();
		$attrobj = new TextAttr();
		foreach($search_fields as $sf){
			$sf_info = Attr::model()->get($object_id, $sf);
			$finds[$sf] = $attrobj->makeOption($sf_info['option']);
		}
		$content = $this->render('index', array('hero'=>$hero, 'list_conf'=>$fields_rs, 'finds'=>$finds, 'team'=>$team, 'getTitle'=>$getTitle, 'heroimg'=>$this->heroimg), true);
		$this->make_page_cache($content);	//存储缓存
	}

	//截取字符串
	public static function truncate_utf8_string($string, $length, $etc = '...'){
		$result = '';
		$string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
		$strlen = strlen($string);
		for ($i = 0; (($i < $strlen) && ($length > 0)); $i++){
			if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')){
				if ($length < 1.0){
					break;
				}
				$result .= substr($string, $i, $number);
				$length -= 1.0;
				$i += $number - 1;
			}else{
			   $result .= substr($string, $i, 1);
			   $length -= 0.5;
			}
		}
		$result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
		if ($i < $strlen){
			$result .= $etc;
		}
		return $result;
	}
   
	/**
	 * 英雄查看
	 */
	public function actionHero($id=''){
		$this->make_page_cache();	//检查缓存
		$object_id = 'hero';
		$id = $id?$id:'brewmaster';		//没串id以默认为酒仙
		
		$fields = array(
			'_id', 'name', '真名', '头像', 'level_1_hp', 'level_1_mp',
			'AttributeBaseStrength', 'AttributeBaseAgility', 'AttributeBaseIntelligence',
			'level_1_ap_min', 'level_1_ap_max', 'level_1_armor', 'AttackRange',
			'VisionDaytimeRange', 'VisionNighttimeRange', 'MovementSpeed','出门装备描述','前期装备描述','核心装备描述','可选装备描述',
			'ProjectileSpeed', 'AttackAnimationPoint', 'Abilities','核心装备','AttributePrimary','出门装备','前期装备','可选装备',
			'背景故事','Team','AttackCapabilities','AttributeStrengthGain','AttributeAgilityGain','AttributeIntelligenceGain',
			'RecommendSkills','RecommendSkillsDesc','numId','hero_overview','item_overview','force_enemy','good_teammate','RecommendSkills2Title','RecommendSkills2','RecommendSkills2Desc',
			'RecommendSkills3Title','RecommendSkills3','RecommendSkills3Desc'
		);
		
		$info[] = Entity::model('entity_'.Yii::app()->params['dbGame'].'_'.$object_id)->findByPk($id);
		if(empty($info[0]->_id)){
			$this->redirect_back();
		}
		//关联信息获取
		$attr = Attr::model()->getAll($object_id);
		foreach ( $info as $key=>$vo ) {
			$info[$key] = array();
			foreach ($fields as $fk=>$fo){
				if(isset($attr[$fo])){
					$info[$key]['_id'] = $vo['_id'];
					$info[$key]['name'] = $vo['name'];
					$info[$key]['Roles'] = $vo['Roles'];
					$avo = $attr[$fo];
					$avo['return'] = array('icon','hotkey','AbilityBehavior','Description','maxlevel','itemId','AbilityCooldown','AbilityManaCost','lines','AbilityDamage','AbilityUnitDamageType','AbilityCastRange','AbilityDuration','终极技能','ability_overview','video');
					$info[$key][$fo] = $this->getAttrView($avo, $vo[$fo]);	//把数据按类型处理
				}
			}
		}
		//攻击范围,初始护甲取整
		$info[0]['level_1_ap'] = floor(($info[0]['level_1_ap_min']+$info[0]['level_1_ap_max'])/2);
		$info[0]['level_1_armor_qz'] = floor($info[0]['level_1_armor']);
		//技能名顺序，在上图中显示对应等级 加点1
		$arr1 = array();
		if(isset($info[0]['RecommendSkills'])){
			$info[0]['abilities_merge'] = $info[0]['RecommendSkills'];
			$arr = array();
			foreach( $info[0]['abilities_merge'] as $k=>$v ){
				if(array_key_exists($v['id'],$arr)){
					array_push($arr[$v['id']],$k+1);
				}else{
					$arr[$v['id']] = array($k+1=>$k+1);
					$arr1[$k+1] = $v;
				}
			}
			foreach($arr1 as $k => $v){
				if(array_search($k,$arr[$v['id']])!== false){
					$arr1[$k]['key'] = $arr[$v['id']];
				}
			}
		}
		//加点2
		$arr2 = array();
		if(isset($info[0]['RecommendSkills2'])){
			$info[0]['abilities_merge2'] = $info[0]['RecommendSkills2'];
			$arr_2 = array();
			foreach( $info[0]['abilities_merge2'] as $k=>$v ){
				if(array_key_exists($v['id'],$arr_2)){
					array_push($arr_2[$v['id']],$k+1);
				}else{
					$arr_2[$v['id']] = array($k+1=>$k+1);
					$arr2[$k+1] = $v;
				}
			}
			foreach($arr2 as $k => $v){
				if(array_search($k,$arr_2[$v['id']])!== false){
					$arr2[$k]['key'] = $arr_2[$v['id']];
				}
			}
		}
		//加点3
		$arr3 = array();
		if(isset($info[0]['RecommendSkills3'])){
			$info[0]['abilities_merge3'] = $info[0]['RecommendSkills3'];
			$arr_3 = array();
			foreach( $info[0]['abilities_merge3'] as $k=>$v ){
				if(array_key_exists($v['id'],$arr_3)){
					array_push($arr_3[$v['id']],$k+1);
				}else{
					$arr_3[$v['id']] = array($k+1=>$k+1);
					$arr3[$k+1] = $v;
				}
			}
			foreach($arr3 as $k => $v){
				if(array_search($k,$arr_3[$v['id']])!== false){
					$arr3[$k]['key'] = $arr_3[$v['id']];
				}
			}
		}
		$info[0]['hero_overview_1'] = $this->truncate_utf8_string($info[0]['hero_overview'],160);
		$info[0]['背景故事_1'] = $this->truncate_utf8_string($info[0]['背景故事'],70);
		
		$this->pageTitle = $info[0]['name']." - ".$info[0]['_id']." - Dota2 - 17173查查";
		$this->setPageState('description', "提供详细的Dota2英雄、物品资料查询,分析Dota2英雄的特性,介绍Dota2物品的使用,根据战报数据统计分析英雄出装加点趋势,指导新手玩家熟悉Dota2英雄出装及加点顺序。");
		$this->setPageState('keywords', $info[0]['name'].",".$info[0]['_id'].",Dota2,出装攻略,技能攻略,视频攻略,战报统计趋势");
		$getTitle = '英雄-'.$info[0]['name'];
		
		$tj = new Zb();
		//本周出场，胜率
		$data = $tj->getData($info[0]['numId'],'周');
		
		$info[0]['sumcount'] = $data['sumcount'];
		$info[0]['winning'] = isset($data['sumcount'])?number_format($data['sumwin']/$data['sumcount']*100,1,'.',''):0;
		
		//统计 技能
		$tjinfo = $this->getC('tjinfo_'.$info[0]['_id']);
		if (empty($tjinfo)) {
			$res = $tj->getTjInfo(array('numId'=>$info[0]['numId'],'dvs'=>'周'));
			$tjinfo = array();
			$skill = new Entity();
			$abilitytop = array();
			foreach($res['skill'] as $key=>$val){
				//获取十个技能的名称，id，图标
				$ability = $skill->getAbility($val['ability']);
				$numid_all = array_map(array($this,'prefixPath'), explode(",",$val['ability']));
				foreach($numid_all as $ke=>$va){
					foreach($ability as $k=>$v){
						if (in_array($va,array($v['numId']))){
							$abilitytop[$key][$ke]['_id'] = $ability[$k]['_id'];
							$abilitytop[$key][$ke]['name'] = $ability[$k]['name'];
							$abilitytop[$key][$ke]['numId'] = $ability[$k]['numId'];
							$abilitytop[$key][$ke]['icon'] = $ability[$k]['icon'];
						}
					}
				}
			}
			$yxjm = array();
			foreach($res['yxjm'] as $key=>$val){
				$abilitys = $skill->getAbility($val['ability']);
				$yxjm[$key]['_id'] = $abilitys[0]['_id'];
				$yxjm[$key]['total'] = $val['total'];
			}
			$tjinfo['skill'] = $abilitytop;
			$tjinfo['yxjm'] = $yxjm;
			$this->setC('tjinfo_'.$info[0]['_id'],$tjinfo,24);
		}	
		//统计 出装
		$czinfo = $this->getC('heross_'.$info[0]['_id']);
		if (empty($czinfo)) {
			$res = $tj->getCzInfo(array('numId'=>$info[0]['numId'],'dvs'=>'周'));
			$czinfo = array_reverse($res);
			$this->setC('heross_'.$info[0]['_id'],$czinfo,24);
		}
		$this->layout='index';
		if(empty($this->heroSp[$info[0]['name']])){
			$this->heroSp[$info[0]['name']] = array('','');
		}
		$content = $this->render('hero', array('object_id'=>$object_id, 'info'=>$info[0], 'heroSp'=>$this->heroSp[$info[0]['name']], 'czinfo'=>$czinfo, 'tjinfo'=>$tjinfo, 'arr1'=>$arr1, 'arr2'=>$arr2, 'arr3'=>$arr3, 'id'=>$id, 'getTitle'=>$getTitle, 'heroimg'=>$this->heroimg), true);
		$this->make_page_cache($content);	//存储缓存
	}
	public function prefixPath($n){
		return intval($n);
	}
	

	/**
	 * 物品
	 */
	public function actionItem(){
		$this->make_page_cache();	//检查缓存
		$this->pageTitle='Dota2物品数据 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2英雄、物品资料查询,分析Dota2英雄的特性,介绍Dota2物品的使用,根据战报数据统计分析英雄出装加点趋势,指导新手玩家熟悉Dota2英雄出装及加点顺序。');
		$this->setPageState('keywords', 'Dota2物品数据库');
		$getTitle = '物品列表';
		$object_id = 'item';
		//排序依据
		$sort_arr = array(38,44,39,188,46,40,45,84,42,43,41,117,33,16,13,14,15,20,17,18,19,21,22,23,24,12,11,182,2,4,6,3,10,5,7,
						  9,8,34,28,27,29,25,31,30,26,37,35,32,1,215,75,77,36,73,71,178,50,63,67,69,65,48,88,94,86,92,212,
						  214,187,180,185,81,79,90,102,106,100,104,190,206,108,98,110,96,149,151,143,152,145,176,137,135,
						  141,139,133,208,131,127,125,129,116,119,147,121,123,112,114,164,172,162,170,166,174,168,210,154,
						  158,160,156,181,56,57,59,61,60,55,51,58,53,52,54);
		//查询构造器
		$fields = array(
			'_id', 'itemId', 'name', 'icon', 'ItemQuality', 'RealCost', 'Materials','MaterialOf',
			'stats_health','stats_mana','stats_armor','stats_damage','Category','ItemShopTags', 'Lines', 'numId'
		);
		$search_fields = array('Category', 'ItemShopTags');		//查询字段，物品分类，商店标签
		$data = Entity::model('entity_'.Yii::app()->params['dbGame'].'_'.$object_id)->findAll();
		//关联信息获取
		$attr = Attr::model()->getAll($object_id);
		foreach ( $data as $key=>$vo ) {
			$data[$key] = array();
			foreach ($fields as $fk=>$fo){
				if(isset($attr[$fo])){
					$data[$key]['_id'] = $vo['_id'];
					$data[$key]['name'] = $vo['name'];
					$avo = $attr[$fo];
					$avo['return'] = array('icon','RealCost');
					$data[$key][$fo] = $this->getAttrView($avo, $vo[$fo]);	//把数据按类型处理
				}
			}
			$sort_key = array_search($vo['numId'],$sort_arr);
			if($sort_key !== false){
				$new_data[$sort_key] =  $data[$key];
			}
		}
		ksort($new_data);
		$data = $new_data;
		unset($new_data);
		//生成json
		$fields = $this->json_encode_china($fields);		//转配置
		$list_rs = json_encode($data);			//转数据
		
		$filename = dirname(dirname(dirname(__FILE__)))."/js/itemdata.js";
		if (file_exists($filename) && filemtime($filename)+60*60*24<=time()) {
			$json_data = "var global_json_item = ".$list_rs.";";
			file_put_contents(dirname(dirname(dirname(__FILE__)))."/js/itemdata.js",$json_data);
		}

		//过滤条件配置获取并抽取数据并转换
		$finds = array();
		$attrobj = new TextAttr();
		foreach($search_fields as $sf){
			$sf_info = Attr::model()->get($object_id, $sf);
			$finds[$sf] = $attrobj->makeOption($sf_info['option']);
		}
		
		$ShopTags = array('力量','敏捷','智力','伤害','护甲','吸血','躲闪','传送','探隐','致命一击概率','生命值','魔法值','生命回复','法力回复','攻击速度','移动速度','魔法抗性');
		
		//默认展示 item_abyssal_blade （深渊之刃）
		$item_id = isset($_REQUEST['id'])?$_REQUEST['id']:'abyssal_blade';
		$item_id = 'item_'.$item_id;
		$field = array(
			'_id', 'itemId', 'name', '俗称', 'icon', 'RealCost', 'Materials','MaterialOf','Lore',
			'AbilityManaCost','AbilityCooldown','Lines','Description'
		);
		$item_info[] = Entity::model('entity_'.Yii::app()->params['dbGame'].'_'.$object_id)->findByPk($item_id);
		foreach ( $item_info as $key=>$vo ) {
			$item_info[$key] = array();
			foreach ($field as $fk=>$fo){
				if(isset($attr[$fo])){
					$item_info[$key]['_id'] = $vo['_id'];
					$item_info[$key]['name'] = $vo['name'];
					$avo = $attr[$fo];
					$avo['return'] = array('icon','RealCost','itemId');
					$item_info[$key][$fo] = $this->getAttrView($avo, $vo[$fo]);	//把数据按类型处理
				}
			}
		}
		if($item_id!='item_abyssal_blade'){
			$item = $item_info[0]['name'].',总价：'.$item_info[0]['RealCost'];
			if($item_info[0]['俗称'])
				$item .= ',俗称：'.$item_info[0]['俗称'];
			else
				$item .= ',俗称：无';
			if($item_info[0]['Lore']){
				$item .= ',物品说明：'.$item_info[0]['Lore'];
			}
			if($item_info[0]['Lines']){
				$item .= '奖励属性：';
				foreach($item_info[0]['Lines'] as $key=>$val){
					$item .= $val;
				}
			}
			if($item_info[0]['AbilityManaCost']){
				$item .= ',魔法消耗：'.$item_info[0]['AbilityManaCost'];
			}
			if($item_info[0]['AbilityCooldown']){
				$item .= ',冷却时间：'.$item_info[0]['AbilityCooldown'];
			}
			if($item_info[0]['Description']){
				$item .= ',技能效果：'.$item_info[0]['Description'];
			}
			if($item_info[0]['Materials']){
				$item .= ',合成材料：';
				foreach($item_info[0]['Materials'] as $key=>$val){
					$item .= $val['name'];
				}
			}
			if($item_info[0]['MaterialOf']){
				$item .= ',作为材料：';
				foreach($item_info[0]['MaterialOf'] as $key=>$val){
					$item .= $val['name'];
				}
			}
			$this->setPageState('description', $item);
			$this->pageTitle='Dota2'.$item_info[0]['name'].' - '.$item_info[0]['itemId'].' - 17173查查';
		}
		$this->layout='item_main';
		$content = $this->render('item', array('object_id'=>$object_id, 'list_rs'=>$list_rs, 'list_conf'=>$fields, 'finds'=>$finds, 'getTitle'=>$getTitle, 'data'=>$data, 'item_info'=>$item_info[0], 'ShopTags'=>$ShopTags), true);
		$this->make_page_cache($content);	//存储缓存
	}

	/**
	 * 搜索
	 */
	public function actionSearch(){
		$this->make_page_cache();	//检查缓存
		$keyWord = !empty($_REQUEST['q'])?$_REQUEST['q']:'';
		$this->pageTitle='「'.$keyWord.'」搜索结果 - 17173查查';
		$this->setPageState('description', '提供详细的Dota2英雄、物品资料查询,分析Dota2英雄的特性,介绍Dota2物品的使用,指导新手玩家熟悉Dota2英雄出装及加点顺序。');
		$this->setPageState('keywords', 'DOTA2英雄,DOTA2装备,DOTA2技能,DOTA2英雄出装,DOTA2英雄加点,DOTA2英雄攻略，DOTA2英雄统计 ');
		$getTitle = '查询-'.$keyWord;
		
		$rs = array();
		//查询物品
		$rs['item'] = Entity::model('entity_'.Yii::app()->params['dbGame'].'_item')->findAllByQuery(
			array( 
				'$or' => array( 
					array('name' => new MongoRegex('/.*'.$keyWord.'.*/i')), 
					array('俗称' => new MongoRegex('/.*'.$keyWord.'.*/i')), 
					array('Lore' => new MongoRegex('/.*'.$keyWord.'.*/i')),
					array('Description' => new MongoRegex('/.*'.$keyWord.'.*/i')),
					array('Lines' => new MongoRegex('/.*'.$keyWord.'.*/i'))
				),
				'hidden'=>array('$nin'=>array(1, true)),		//排除隐藏数据
			), array('_id','name','icon','itemId','RealCost')
		);
		//查询技能
		$rs['skill'] = Entity::model('entity_'.Yii::app()->params['dbGame'].'_skill')->findAllByQuery(
			array(
				'$or' => array( 
					array('name' => new MongoRegex('/.*'.$keyWord.'.*/i')), 
					array('Description' => new MongoRegex('/.*'.$keyWord.'.*/i')),
					array('lines' => new MongoRegex('/.*'.$keyWord.'.*/i'))
				)
			), array('_id','name','icon')
		);
		
		$skill_ids = array();
		if($rs['skill']){
			$skill_ids = $this->list_from_rs($rs['skill'], '_id');
		}
		
		//查询英雄
		$rs['hero'] = Entity::model('entity_'.Yii::app()->params['dbGame'].'_hero')->findAllByQuery(
			array(
				'$or' => array( 
					array('name' => new MongoRegex('/.*'.$keyWord.'.*/i')), 
					array('真名' => new MongoRegex('/.*'.$keyWord.'.*/i')),
					array('Abilities'=>array('$in'=>$skill_ids))
				),
				'hidden'=>array('$nin'=>array(1, true)),
			), array('_id','name','头像','Abilities')
		);
		$object_id = 'hero';
		$fields = array(
			'_id', 'name', '真名', '头像', 'Abilities'
		);
		//关联信息获取
		$attr = Attr::model()->getAll($object_id);
		foreach ( $rs['hero'] as $key=>$vo ) {
			$rs['hero'][$key] = array();
			foreach ($fields as $fk=>$fo){
				if(isset($attr[$fo])){
					$rs['hero'][$key]['_id'] = $vo['_id'];
					$rs['hero'][$key]['name'] = $vo['name'];
					$avo = $attr[$fo];
					$avo['return'] = array('icon','maxlevel','Description', 'lines');
					$rs['hero'][$key][$fo] = $this->getAttrView($avo, $vo[$fo]);	//把数据按类型处理
				}
			}
		}
		$this->layout='search_main';
		$content = $this->render('search', array('keyWord'=>$keyWord, 'rs'=>$rs, 'getTitle'=>$getTitle, 'heroimg'=>$this->heroimg), true);
		$this->make_page_cache($content);	//存储缓存
	}
	
	/**
	 * 更新页面缓存
	 */
	public function actionUC(){
		$lock_url = YiiBase::getPathOfAlias('application.runtime').'\\cache.lock';
		$rs = @file_put_contents($lock_url, 'lock');
		echo '更新缓存结果：'.($rs>0?'成功':'失败');
		exit();
	}
	/**
	 * tips内容加载
	 */
	public function actionTips(){
		$object_code = $this->mkd($_GET, 't', '');		//实体代码
		$language = $this->mkd($_GET, 'l', '');			//语言
		$charset = $this->mkd($_GET, 'c', '');			//编码
		$id = $this->mkd($_GET, 'id', '');				//实体id
		$base_url = 'http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
		
		//获取可用实体类型
		$obs = Object::model()->getAll(Yii::app()->params['dbGame']);
		$obs = $this->list_from_rs($obs, 'code');	
		
		//代码生成
		$tips_div_id = $object_code.$language.$id.'c';	//浮层id标示
		$html = 'Wowcc(\''.$tips_div_id.'\',\'';		//头
		if(!empty($object_code) && !empty($id) && in_array($object_code, $obs)){
			$info = Entity::model('entity_'.Yii::app()->params['dbGame'].'_'.$object_code)->findByPk($id);		//实体值对象
			$attr = Attr::model()->getAll($object_code);														//实体配置
			if($object_code=='hero'){
				$heroimg = $this->heroimg;
				$html .= '<div class="tips hero-tips">
							<img src="'.Yii::app()->params->imgUrl.'/images/data/'.$info['头像'].'" class="pic" alt="'.$info['name'].'" />
							<div class="box">';
								if($info['AttackCapabilities']){
				$html .= '		<div class="ball"><img src="'.Yii::app()->params->imgUrl.'/images/dotaimg/'.$heroimg[$info['AttackCapabilities']].'" class="png pic-ball" alt="'.$info['AttackCapabilities'].'" /></div>';
								}
								if($info['AttributePrimary']){
				$html .= '		<div class="ball"><img src="'.Yii::app()->params->imgUrl.'/images/dotaimg/'.$heroimg[$info['AttributePrimary']].'" class="png pic-ball" alt="'.$info['AttributePrimary'].'" /></div>';
								}
				$html .= '		<div class="txt">'.$info['name'].'</div>';
							if($info['Roles']){
								foreach($info['Roles'] as $key=>$val){
				$html .= '		<div class="ball ball-r"><img src="'.Yii::app()->params->imgUrl.'/images/dotaimg/'.$heroimg[$val].'" class="png pic-ball" alt="'.$val.'" /></div>';
								}
							}
				$html .= '		<b class="mask"></b>
							</div>
						</div>';
			}elseif($object_code=='item'){
				$html .= '<div class="tips item-tips">
							<div class="hd">
									<div class="pic-box">
									<img src="'.Yii::app()->params->imgUrl.'/images/data/'.$info['icon'].'" alt="'.$info['name'].'" class="pic" />
								</div>
								<div class="definition">
									<div class="name">'.$info['name'].'</div>
									<div class="price">总价<span class="num">'.$info['RealCost'].'</span></div>
								</div>
							</div>
							<div class="bd">
								<div class="info-box">
									<div class="info-box-in">
										<div class="tit">属性</div>';
										if($info['Lines']){
					$html .= '			<div class="argument">';
											foreach($info['Lines'] as $k=>$v){
					$html .= '				<p>'.$v.'</p>';
											}
					$html .= '			</div>';
										}
					$html .= '			<div class="argument">';
											if($info['AbilityManaCost']){
					$html .= '				<p class="txt1">魔法消耗 '.$info['AbilityManaCost'].'</p>';
											}
											if($info['AbilityManaCost']){
					$html .= '				<p class="txt2">冷却时间 '.$info['AbilityCooldown'].'</p>';
											}
					$html .= '			</div>
					
									</div>
									<b class="mask"></b>
								</div>
								<div class="info-box">
									<div class="info-box-in">
										<div class="tit">物品技能</div>';
										if($info['Description']){
					$html .= '			<div class="intro intro2">'.$info['Description'].'</div>';
										}
					$html .= '		</div>
									<b class="mask"></b>
								</div>
							</div>
						</div>';
			}elseif($object_code=='skill'){
				$html .= '<div class="tips skill-tips">
							<div class="tips-in">
								<div class="c1">
									<img src="'.Yii::app()->params->imgUrl.'/images/data/ability_'.$info['_id'].'.jpg" class="pic" alt="'.$info['name'].'"  />
									<span class="txt">'.$info['hotkey'].'</span>
								</div>
								<div class="c2">
									<p class="tit"><span class="name">'.$info['name'].'</span>'.$this->getAttrView($attr['AbilityBehavior'], $info['AbilityBehavior']).'</p>
									<p class="description">'.addslashes($info['Description']).'</p>
									<div class="arguments">';
										if($info['AbilityManaCost']){
				$html .= '				<p>魔法消耗：'.$info['AbilityManaCost'].'</p>';
										}
										if($info['AbilityCooldown']){
				$html .= '				<p>冷却时间：'.$info['AbilityCooldown'].'</p>';
										}
										if($info['AbilityDamage']){
				$html .= '				<p>技能伤害：'.$info['AbilityDamage'].'</p>';
										}
										if($info['AbilityUnitDamageType']){
				$html .= '				<p>伤害类型：'.$info['AbilityUnitDamageType'].'</p>';
										}
										if($info['AbilityCastRange']){
				$html .= '				<p>作用范围：'.$info['AbilityCastRange'].'</p>';
										}
										if($info['AbilityDuration']){
				$html .= '				<p>持续时间：'.$info['AbilityDuration'].'</p>';
										}
										if($info['终极技能']==1){
				$html .= '				<p>终极技能：是</p>';
										}else{
				$html .= '				<p>终极技能：否</p>';
										}
										if($info['lines']){
										$html1 = '';
											foreach($info['lines'] as $k=>$v){
												$html1 .= $v.'</br>';
											}
				$html .= '				<p>技能属性：'.$html1.'</p>';
										}
				$html .= '			</div>
								</div>
							</div>
						</div>';
			}else{
				$html .= '制作中...';
			}
		}else{
			$html .= '没有此类数据';
		}
		$html .= '\')';									//尾
		
		//非UTF-8编码的进行转换
		if(strtolower($charset)!='utf-8'){
			$html = iconv('utf-8', $charset, $html);
		}
		echo preg_replace('/(\r\n|\n)/i', '', $html);	//替换回车并返回
		exit();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError(){
		if($error=Yii::app()->errorHandler->error){
			if(YII_DEBUG){
				//开始框架的调试模式则显示错误信息
				if(Yii::app()->request->isAjaxRequest)
					echo $error['message'];
				else
					$this->render('error', $error);
			}else{
				//否则所有的错误都会导致页面重定向到首页
				$this->redirect(array('site/index'));
			}
		}
	}
}