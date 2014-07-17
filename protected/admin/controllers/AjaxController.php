<?php
/**
 * ajax请求控制器
 * @author lyj
 */
class AjaxController extends Controller{
	/**
	 * 英雄页-统计
	 */
	public function actionIndex(){
		$numId = $_POST['numId'];			//英雄数字编号
		$dvs = $_POST['dvs'];			//英雄数字编号
		
		//技能
		$tj = new Zb();
		$res = $tj->getTjInfo(array('numId'=>$numId,'dvs'=>$dvs));
		$html = "";
		$skill = new Entity();
		foreach($res['skill'] as $key=>$val){
			//获取十个技能的名称，id，图标
			$ability = $skill->getAbility($val['ability']);
			$numid_all = array_map(array($this,'prefixPath'), explode(",",$val['ability']));
			$abilitytop = array();
			foreach($numid_all as $ke=>$va){
				foreach($ability as $k=>$v){
					if (in_array($va,array($v['numId']))){
						$abilitytop[] = $ability[$k];
					}
				}
			}
			$i = $key+1;
			$html .= "<li class='hero-con'>";
			$html .= "<div class='skill-box'>
						<img class='skill-h' alt='' src='".Yii::app()->params->imgUrl."/images/skill-top".$i.".png'>
					</div>";
			$len =  count($abilitytop);
			foreach($abilitytop as $k=>$v){
				if($k<10){
					$html .= "<div class='skill-box'>
								<div class='link-skill'>
									<a tipurl='".Yii::app()->request->baseUrl."/skill/".$v['_id']."'><img class='pic-skill' alt='' src='".Yii::app()->params->imgUrl."/images/data/ability_".$v['_id'].".jpg'></a>
								 </div>
							</div>";
					if($k<9){
						$html .= "<div class='skill-box'>
									<img class='skill-jt' alt='' src='".Yii::app()->params->imgUrl."/images/skill-jt.png'>
								</div>";
					}
				}
			}
			$html .= "</li>";
		}
		
		$yxjm = "";
		foreach($res['yxjm'] as $key=>$val){
			$ability = $skill->getAbility($val['ability']);
			$yxjm .= "<li class='hero-con'>
						<div class='c11'>
							<a class='link-skill' title='' target='_self' tipurl='".Yii::app()->request->baseUrl."/skill/".$ability[0]['_id']."'>
								<img class='pic-skill' alt='' src='".Yii::app()->params->imgUrl."/images/data/ability_".$ability[0]['_id'].".jpg'>
							</a>
						</div>
						<div class='c21'>
							<div class='xxt' style='width:500px;'></div>
							<div class='xxt-jt'></div>
							<div class='xx-label'>
								<label>".$val['total']."人</label>
							</div>
						</div>
					</li>";
		}
		$info['skill'] = $html;
		$info['yxjm'] = $yxjm;
		
		//出装
		$skill = new Entity();
		$rescz = $tj->getCzInfo(array('numId'=>$numId,'dvs'=>$dvs));
		$czinfo = array_reverse($rescz);
		$cz = "";
		$i = 1;
		foreach($czinfo as $key=>$val){
			$c2s = '';
			if($i==1){$c2s = "c2-hq";}elseif($i==2){$c2s = "c2-cx";}elseif($i==3){$c2s = "c2-gd";}elseif($i==4){$c2s = "c2-qq";}
			
			$cz .= "<div class='col col".$i."'>
					<div class='col-in'>
						<div class='hd'>
							<h3 class='tit' align='center'>".$key."</h3>
						</div>
						<div class='bd'>
							<ul class='list'>";
			$i++;
			foreach($val as $ke=>$va){
				$iteminfo = $skill->getItem($va['item_id']);
				$cz .= "<li class='item'>
							<div class='c1'>
								<a class='link-item' title='' target='_self'  href='".Yii::app()->request->baseUrl."/items/".$iteminfo[0]['itemId'].".html' tipurl='".Yii::app()->request->baseUrl."/item/".$iteminfo[0]['_id']."'>
									<img class='pic-item' alt='' src='".Yii::app()->params->imgUrl."/images/data/".$iteminfo[0]['icon']."'>
								</a>
							</div>
							<div class='c2 ".$c2s."'>
								<label>".$va['sumcount']."</label>
								<div class='xxt'></div>
							</div>
						</li>";
			}
			$cz .= "</li>
							</ul>
						</div>
					</div>
				</div>";
		}
		$info['cz'] = $cz;
		$item = json_encode($info);
		print_r($item);
	}
	public function prefixPath($n){
		return intval($n);
	}
	/**
	 * 英雄页-统计 出装
	 */
	public function actionCz(){
		$numId = $_POST['numId'];			//英雄数字编号
		$dvs = $_POST['dvs'];	//版本/时间
		$tj = new Zb();
		$skill = new Entity();
		$res = $tj->getCzInfo(array('numId'=>$numId,'dvs'=>$dvs));
		$czinfo = array_reverse($res);
		$html = "";
		$i = 1;
		foreach($czinfo as $key=>$val){
			$c2s = '';
			if($i==1){$c2s = "c2-hq";}elseif($i==2){$c2s = "c2-cx";}elseif($i==3){$c2s = "c2-gd";}elseif($i==4){$c2s = "c2-qq";}
			$i++;
			$html .= "<div class='col col".$i."'>
					<div class='col-in'>
						<div class='hd'>
							<h3 class='tit' align='center'>".$key."</h3>
						</div>
						<div class='bd'>
							<ul class='list'>";
			foreach($val as $ke=>$va){
				$iteminfo = $skill->getItem($va['item_id']);
				$html .= "<li class='item'>
							<div class='c1'>
								<a class='link-item' title='' target='_self'  href='' tipurl='".Yii::app()->request->baseUrl."/item/".$iteminfo[0]['_id']."'>
									<img class='pic-item' alt='' src='".Yii::app()->params->imgUrl."/images/data/".$iteminfo[0]['icon']."'>
								</a>
							</div>
							<div class='c2 ".$c2s."'>
								<label>".$va['sumcount']."</label>
								<div class='xxt'></div>
							</div>
						</li>";
			}
			$html .= "</li>
							</ul>
						</div>
					</div>
				</div>";
		}
		$item = json_encode($html);
		print_r($item);
	}
	/**
	 * 数据统计页 查询版本/时间
	 */
	public function actionData(){
		$Attr = isset($_POST['Attr'])?$_POST['Attr']:'';
		$Attack = isset($_POST['Attack'])?$_POST['Attack']:'';
		$Roles = isset($_POST['Roles'])?$_POST['Roles']:'';
		if($_POST['Attr']=='全部')
			$Attr = '';
		if($_POST['Attack']=='全部')
			$Attack = '';
		if($_POST['Roles']=='全部')
			$Roles = '';
		$dvs = isset($_POST['vs'])?$_POST['vs']:'';
		$tj = new Zb();
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'AttributePrimary'=>array('==' => $Attr),	//条件
				'AttackCapabilities'=>array('==' => $Attack),	//条件
				'Roles'=>array('==' => new MongoRegex('/^'.$Roles.'.*/i')),		//模糊查询
			),
			'select'=>array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'),
		));
		$hero = Entity::model('entity_dota2_hero')->findAll($criteria);
		$heroinfo = array();
		foreach($hero as $key=>$val){
			$heroinfo[$key]['_id'] = $val['_id'];
			$heroinfo[$key]['name'] = $val['name'];
			$heroinfo[$key]['头像'] = $val['头像'];
			$heroinfo[$key]['AttributePrimary'] = $val['AttributePrimary'];
			$heroinfo[$key]['AttackCapabilities'] = $val['AttackCapabilities'];
			$heroinfo[$key]['Roles'] = $val['Roles'];
			$data = $tj->getData($val['numId'],$dvs);
			$heroinfo[$key]['win'] = $data['sumwin'];
			$heroinfo[$key]['count'] = $data['sumcount'];
			$heroinfo[$key]['winning'] = number_format($data['sumwin']/$data['sumcount']*100,1,'.','');
			$heroinfo[$key]['kills'] = number_format($data['sumkills']/$data['sumlevel']*25,1,'.','');
			$heroinfo[$key]['deaths'] = number_format($data['sumdeaths']/$data['sumlevel']*25,1,'.','');
			$heroinfo[$key]['last_hits'] = number_format($data['sumlast_hits']/$data['sumlevel']*25,1,'.','');
			$heroinfo[$key]['denies'] = number_format($data['sumdenies']/$data['sumlevel']*25,1,'.','');
			$heroinfo[$key]['assists'] = number_format($data['sumassists']/$data['sumlevel']*25,1,'.','');
			$heroinfo[$key]['gold_per_min'] = round($data['sumgold_per_min']/$data['sumlevel']*25);
			$heroinfo[$key]['xp_per_min'] = round($data['sumxp_per_min']/$data['sumlevel']*25);
		}
		$hero_data = json_encode($heroinfo);
		$html['winning'] = "";
		$html['jszg'] = "";
		$html['bdjy'] = "";
		foreach($heroinfo as $key=>$val){
			$trr = '';
			if(count($heroinfo)==1){$trr = "class='last'";}else if($key==0){$trr = "class='top'";}else if($key==count($heroinfo)-1){$trr = "class='last'";}
			$html['winning'] .= "<tr ".$trr.">
									<td class='con con-hero'><a href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."' target='_self' class='link-hero' title='".$val['name']."'><img src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg' class='pic-hero' alt='".$val['name']."'  />".$val['name']."</a></td>
									<td class='con'>
									   <div class='c21'>
											<div class='xxt'></div>
											<div class='xx-label '>
												<label>".$val['count']."</label>
											</div>
										</div>
									</td>
									<td class='con'>
										 <div class='c2'>
											<div class='tit-c2'>
												<div class='xxt'></div>
											</div>
											<div class='xx-label'>
												<label>".$val['winning']."%</label>
											</div>
										</div>
									</td>
								</tr>";
			$html['jszg'] .= "<tr ".$trr.">
								<td class='con con-hero'><a href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."' target='_self' class='link-hero' title='".$val['name']."'><img src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg' class='pic-hero' alt='".$val['name']."'  />".$val['name']."</a></td>
								<td class='con'>
								   <div class='c21 srzs'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['kills']."</label>
										</div>
									</div>
								</td>
								<td class='con'>
								   <div class='c21 tgzs'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['assists']."</label>
										</div>
									</div>
								</td>
								<td class='con'>
								   <div class='c21 bszs'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['deaths']."</label>
										</div>
									</div>
								</td>
							</tr>";
			$html['bdjy'] .= "<tr ".$trr.">
								<td class='con con-hero'><a href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."' target='_self' class='link-hero' title='".$val['name']."'><img src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg' class='pic-hero' alt='".$val['name']."'  />".$val['name']."</a></td>
								<td class='con'>
								   <div class='c21 zbzs'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['last_hits']."</label>
										</div>
									</div>
								</td>
								<td class='con'>
								   <div class='c21 fbzs'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['denies']."</label>
										</div>
									</div>
								</td>
								<td class='con'>
								   <div class='c21 cjdj'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['gold_per_min']."</label>
										</div>
									</div>
								</td>
								<td class='con'>
								   <div class='c21 cjjy'>
										<div class='xxt'></div>
										<div class='xx-label '>
											<label>".$val['xp_per_min']."</label>
										</div>
									</div>
								</td>
							</tr>";
		}
		$html['data_arr'] = $hero_data;
		$data = json_encode($html);			//转数据
		print_r($data);
	}
	
	/**
	 * 数据统计页 查询版本/时间
	 */
	public function actionSkill(){
		$Attr = isset($_POST['Attr'])?$_POST['Attr']:'';
		$Attack = isset($_POST['Attack'])?$_POST['Attack']:'';
		$Roles = isset($_POST['Roles'])?$_POST['Roles']:'';
		if($_POST['Attr']=='全部')
			$Attr = '';
		if($_POST['Attack']=='全部')
			$Attack = '';
		if($_POST['Roles']=='全部')
			$Roles = '';
		$dvs = isset($_POST['vs'])?$_POST['vs']:'';
		
		$tj = new Zb();
		$skill = new Entity();
	
		//获取所有英雄
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'AttributePrimary'=>array('==' => $Attr),	//条件
				'AttackCapabilities'=>array('==' => $Attack),	//条件
				'Roles'=>array('==' => new MongoRegex('/^'.$Roles.'.*/i')),		//模糊查询
			),
			'select'=>array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'),
		));
		$hero = Entity::model('entity_dota2_hero')->findAll($criteria);
		
		$skillinfo = array();
		foreach($hero as $key=>$val){
			$skillinfo[$key]['_id'] = $val['_id'];
			$skillinfo[$key]['name'] = $val['name'];
			$skillinfo[$key]['头像'] = $val['头像'];
			$skillinfo[$key]['AttributePrimary'] = $val['AttributePrimary'];
			$skillinfo[$key]['AttackCapabilities'] = $val['AttackCapabilities'];
			$skillinfo[$key]['Roles'] = $val['Roles'];
			$data = $tj->getSkill($val['numId'],$dvs);
			//获取十个技能的名称，id，图标
			$ability = $skill->getAbility($data['skill']['ability']);
			$numid_all = array_map(array($this,'prefixPath'), explode(",",$data['skill']['ability']));
			$abilitytop = array();
			$yxjm = array();
			foreach($numid_all as $ke=>$va){
				foreach($ability as $k=>$v){
					if (in_array($va,array($v['numId']))){
						$abilitytop[] = $ability[$k];
					}
					if (in_array($data['yxjm']['ability'],array($v['numId']))){
						$yxjm = $ability[$k];
						continue;
					}
				}
			}
			$skillinfo[$key]['ability'] = $abilitytop;
			$skillinfo[$key]['yxjm'] = $yxjm;
			$skillinfo[$key]['total'] = $data['yxjm']['total'];
			
		}
		
		$skill_data = json_encode($skillinfo);
		$html['info'] = "";
		foreach($skillinfo as $key=>$val){
			$trr = '';
			if(count($skillinfo)==1){$trr = "class='last'";}else if($key==0){$trr = "class='top'";}else if($key==count($skillinfo)-1){$trr = "class='last'";}
			$html['info'] .= "<tr ".$trr.">
						<td class='con con-hero'>
							<a href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."' target='_self' class='link-hero' title='".$val['name']."'><img src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg' class='pic-hero' alt='".$val['name']."'  />".$val['name']."</a>
						</td>
						<td class='con'>
							<ul class='list clearfix'>";
								foreach($val['ability'] as $ke=>$va){
			$html['info'] .= "			<li class='link-skill'>
									<a tipurl='".Yii::app()->request->baseUrl."/skill/".$va['_id']."'><img src='".Yii::app()->request->hostInfo.Yii::app()->params->imgUrl."/images/data/ability_".$va['_id'].".jpg' alt='".$va['name']."' class='pic-skill' /></a>
								</li>";
								}
			$html['info'] .= "		</ul>	
						</td>
						<td class='con'>
							<div class='c1'>
								<a class='link-skill' title='".$val['yxjm']['name']."' target='_self' tipurl='".Yii::app()->request->baseUrl."/skill/".$val['yxjm']['_id']."'>
									<img class='pic-skill' alt='".$val['yxjm']['name']."' src='".Yii::app()->params->imgUrl."/images/data/ability_".$val['yxjm']['_id'].".jpg'>
								</a>
							</div>
							<div class='c2'>
								<label>".$val['total']."</label>
								<div class='xxt'></div>
							</div>
						</td>
					</tr>";
		}
		$html['skill_arr'] = $skill_data;
		$data = json_encode($html);			//转数据
		print_r($data);
		
	}
	
	
	//出装统计-筛选符合条件的英雄
	public function actionArmory(){
		$Attr = isset($_POST['Attr'])?$_POST['Attr']:'';
		$Attack = isset($_POST['Attack'])?$_POST['Attack']:'';
		$Roles = isset($_POST['Roles'])?$_POST['Roles']:'';
		if($_POST['Attr']=='全部')
			$Attr = '';
		if($_POST['Attack']=='全部')
			$Attack = '';
		if($_POST['Roles']=='全部')
			$Roles = '';
		$dvs = isset($_POST['vs'])?$_POST['vs']:'';
		
		$tj = new Zb();
		$skill = new Entity();
	
		//获取所有英雄
		$criteria = new EMongoCriteria(array(
			'conditions'=>array(
				'AttributePrimary'=>array('==' => $Attr),	//条件
				'AttackCapabilities'=>array('==' => $Attack),	//条件
				'Roles'=>array('==' => new MongoRegex('/^'.$Roles.'.*/i')),		//模糊查询
			),
			'select'=>array('_id', 'name', '头像', 'numId', 'AttributePrimary', 'AttackCapabilities', 'Roles'),
		));
		$hero = Entity::model('entity_dota2_hero')->findAll($criteria);
		$numid = array();
		$html['hero'] = "";
		foreach($hero as $key=>$val){
			$numid[] = $val['numId'];
			$html['hero'] .= "<li class='hero-box'>
						<a class='link-hero' title='".$val['name']."' target='_self' href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."'>
							<img class='pic-hero' alt='".$val['name']."' src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg'>
						</a>
					</li>";
		}
		if(count($hero)%20<20 &&count($hero)%20>0){
			for($i=0;$i<(20-count($hero)%20);$i++){
				$html['hero'] .= "<li class='hero-box'></li>";
			}
		}
		
		//列表
		$numid_all = implode(",",$numid);
		$datas = $tj->getArmory($numid_all,$dvs);
		$dataitem = array_reverse($datas);
		$html['item'] = "";
		$i=1;
		foreach($dataitem as $key=>$val){
			$c2s = '';
			if($i==1){$c2s = "c2-hq";}elseif($i==2){$c2s = "c2-cx";}elseif($i==3){$c2s = "c2-gd";}elseif($i==4){$c2s = "c2-qq";}
			$html['item'] .= "<div class='col col".$i."'>
								<div class='col-in'>
									<div class='hd'>
										<h3 class='tit' align='center'>".$key."</h3>
									</div>
									<div class='bd'>
										<ul class='list'>";
			foreach($val as $ke=>$va){
				$criteria = new EMongoCriteria(array(
					'conditions'=>array(
						'numId'=>array('==' => intval($va['item_id'])),	//条件
					),
					'select'=>array('_id', 'name', 'icon', 'numId', 'itemId'),
				));
				$iteminfo = Entity::model('entity_dota2_item')->find($criteria);
				$html['item'] .= "<li class='item'>
									<div class='c1'>
										<a class='link-item' title='".$iteminfo['name']."' target='_self' href='".Yii::app()->request->baseUrl."/items/".$iteminfo['itemId'].".html' tipurl='".Yii::app()->request->baseUrl."/item/".$iteminfo['_id']."'>
											<img class='pic-item' alt='".$iteminfo['name']."' src='".Yii::app()->params->imgUrl."/images/data/".$iteminfo['icon']."'>
										</a>
									</div>
									<div class='c2  ".$c2s."'>
										<label>".$va['sumcount']."</label>
										<div class='xxt'></div>
									</div>
								</li>";
			}
			$html['item'] .= "</ul></div></div></div>";
			$i++;
		}
		$data = json_encode($html);			//转数据
		print_r($data);
	}
	//获取出装统计缓存
	public function actionArmoryData(){
		$Attr = isset($_POST['Attr'])?$_POST['Attr']:'';
		$Attack = isset($_POST['Attack'])?$_POST['Attack']:'';
		$Roles = isset($_POST['Roles'])?$_POST['Roles']:'';
		$dvs = isset($_POST['vs'])?$_POST['vs']:'';
		$heroinfo = $this->getC('armory_heross');					 //获取缓存
		$hero = $heroinfo[$Attr.'_'.$Attack.'_'.$Roles];
		$heroData = '';
		if(count($hero)>0){
			foreach($hero as $key=>$val){
				$heroData .= "<li class='hero-box'>
								<a class='link-hero' title='".$val['name']."' target='_self' href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."'>
									<img class='pic-hero' alt='".$val['name']."' src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg'>
								</a>
							</li>";
			}
			
			if(count($hero)%20<20 &&count($hero)%20>0){
				for($i=0;$i<(20-count($hero)%20);$i++){
					$heroData .= "<li class='hero-box'></li>";
				}
			}
		}else{
			for($i=0;$i<20;$i++){
				$heroData .= "<li class='hero-box'></li>";
			}
		}
		
		if($dvs=='周'){
			$item_info = $this->getC('armory_item_week');					 //获取缓存
		}elseif($dvs=='月'){
			$item_info = $this->getC('armory_item_month');					 //获取缓存
		}else{
			$item_info = $this->getC('armory_item_bbh');					 //获取缓存
		}
		$item = $item_info[$Attr.'_'.$Attack.'_'.$Roles];
		$itemData = '';
		$i=1;
		foreach($item as $key=>$val){ 
			$itemData .= "<div class='col col".$i.">'>
				<div class='col-in'>
					<div class='hd'>
						<h3 class='tit' align='center'>".$key."</h3>
					</div>
					<div class='bd'>
						<ul class='list'>";
						foreach($val as $ke=>$va){
							$c2 = '';
							if($i==1){$c2 = 'c2-hq';}elseif($i==2){$c2 = 'c2-cx';}elseif($i==3){$c2 = 'c2-gd';}elseif($i==4){$c2 = 'c2-qq';}
							$itemData .= "<li class='item'>
								<div class='c1'>
									<a class='link-item' title='".$va['name']."' target='_self' href='".Yii::app()->request->baseUrl."/items/".$va['itemId'].".html' tipurl='".Yii::app()->request->baseUrl."/item/".$va['_id']."'>
										<img class='pic-item' alt='".$va['name']."' src='".Yii::app()->params->imgUrl."/images/data/".$va['icon']."'>
									</a>
								</div>
								<div class='c2 ".$c2."'>
									<label>".$va['sumcount']."</label>
									<div class='xxt'></div>
								</div>
							</li>";	
						 }							
			$itemData .= "</ul>
					</div>
				</div>
			</div>";
			$i++;
		}
		$html['hero'] = $heroData;
		$html['item'] = $itemData;
		$data = json_encode($html);			//转数据
		print_r($data);
	}
	
	//获取加点统计缓存
	public function actionSkillData(){
		$Attr = isset($_POST['Attr'])?$_POST['Attr']:'';
		$Attack = isset($_POST['Attack'])?$_POST['Attack']:'';
		$Roles = isset($_POST['Roles'])?$_POST['Roles']:'';
		$dvs = isset($_POST['vs'])?$_POST['vs']:'';
		if($dvs=='周'){
			$skill_info = $this->getC('week_data1');					 //获取缓存
		}elseif($dvs=='月'){
			$skill_info = $this->getC('month_data1');					 //获取缓存
		}else{
			$skill_info = $this->getC('bbh_data1');					 //获取缓存
		}
		$new_arr = array();
		$k = 0;
		for($i=0;$i<count($skill_info);$i++){
			$attr_state = false;
			$attack_state = false;
			$roles_state =false;
			//类型
			if($Attr != '全部'){
				if($skill_info[$i]['AttributePrimary'] == $Attr){
					$attr_state = true;
				}
			}else{
				$attr_state = true;
			}
			//攻击方式
			if($Attack != '全部'){
				if($skill_info[$i]['AttackCapabilities'] == $Attack){
					$attack_state = true;
				}
			}else{
				$attack_state = true;
			}
			// 定位
			if($Roles != '全部'){
				$role = $skill_info[$i]['Roles'];
				if (in_array($Roles,$skill_info[$i]['Roles'])){
					$roles_state = true;
				}
			}else{
				$roles_state = true;
			}
			if(($attack_state==true)&&($roles_state==true)&&($attr_state==true)){
				$new_arr[$k] = $skill_info[$i];
				$k++;
			}
		}
		$skillData = '';
		foreach($new_arr as $key=>$val){ 
			$skillData .= "<tr>
							<td class='con con-hero'>
								<a href='".Yii::app()->request->baseUrl."/heros/".$val['_id'].".html' tipurl='".Yii::app()->request->baseUrl."/hero/".$val['_id']."' target='_self' class='link-hero' title='".$val['name']."'><img src='".Yii::app()->params->imgUrl."/images/data/hero_shot_".$val['_id'].".jpg' class='pic-hero' alt='".$val['name']."'  />".$val['name']."</a>
							</td>
							<td class='con'>
								<ul class='list clearfix'>";
								foreach($val['ability'] as $ke=>$va){
					$skillData .= "<li class='link-skill'>
										<a tipurl='".Yii::app()->request->baseUrl."/skill/".$va['_id']."'><img src='".Yii::app()->request->hostInfo.Yii::app()->params->imgUrl."/images/data/ability_".$va['_id'].".jpg' alt='".$va['name']."' class='pic-skill' /></a>
									</li>";
								}
				$skillData .= "</ul>	
							</td>
							<td class='con'>
								<div class='c1'>
									<a class='link-skill' title='".$val['yxjm']['name']."' target='_self' tipurl='".Yii::app()->request->baseUrl."/skill/".$val['yxjm']['_id']."'>
										<img class='pic-skill' alt='".$val['yxjm']['name']."' src='".Yii::app()->params->imgUrl."/images/data/ability_".$val['yxjm']['_id'].".jpg'>
									</a>
								</div>
								<div class='c2'>
									<label>".$val['total']."</label>
									<div class='xxt'></div>
								</div>
							</td>
						</tr>";
		}
		$data = json_encode($skillData);			//转数据
		print_r($data);
	}
	
	
	//物品页，展示选中物品
	public function actionAjaxItem(){
		$object_id = 'item';
		$item_id = $this->mkd($_POST, 'item_id', 0);
		$info[] = Entity::model('entity_'.Yii::app()->params['dbGame'].'_item')->findByPk($item_id);
		
		//查询构造器
		$fields = array(
			'_id', 'name', 'icon', 'ItemQuality', 'RealCost', 'Materials','MaterialOf',
			'stats_health','stats_mana','stats_armor','stats_damage','Category','ItemShopTags',
			'Lore','AbilityManaCost','AbilityCooldown','Description','Lines','俗称'
		);
		//关联信息获取
		$attr = Attr::model()->getAll($object_id);
		foreach ( $info as $key=>$vo ) {
			$info[$key] = array();
			foreach ($fields as $fk=>$fo){
				if(isset($attr[$fo])){
					$info[$key]['_id'] = $vo['_id'];
					$info[$key]['name'] = $vo['name'];
					$avo = $attr[$fo];
					$avo['return'] = array('icon','RealCost');
					$info[$key][$fo] = $this->getAttrView($avo, $vo[$fo]);	//把数据按类型处理
				}
			}
		}
		$html = "";
		$html['html1'] = 	"<div class='hd'>
								<div class='pic-box'>
									<img src='".Yii::app()->params->imgUrl."/images/data/".$info[0]['icon']."' alt='".$info[0]['name']."' class='pic' />
								</div>
								<div class='definition'>
									<h2 class='tit'>".$info[0]['name']."</h2>";
									if($info[0]['RealCost']){
		$html['html1'] .= 	"		<div class='price'>总价<span class='num'>".$info[0]['RealCost']."</span></div>";
									}
		$html['html1'] .= 	"	</div>
							</div>
							<div class='bd'>";
								if($info[0]['俗称']){
		$html['html1'] .= 	"	<div>俗称：".$info[0]['俗称']."</div>";
								}
								if($info[0]['Lore']){
		$html['html1'] .= 	"	<div class='intro'>".$info[0]['Lore']."</div>";
								}
	    $html['html1'] .= 	"</div>";
		$html['html2'] = "<div class='col-in'>
								<div class='hd'>
									<h3 class='tit'>属性</h3>
								</div>
								<div class='bd'>
									<div class='argument'>";
								if($info[0]['Lines']){
									foreach($info[0]['Lines'] as $k=>$v){
		$html['html2'] .= "				<p>".$v."</p>";
									}
								}
		$html['html2'] .= "			</div>
									<div class='argument'>";
									if($info[0]['AbilityManaCost']){
		$html['html2'] .= "			<p class='txt1'>魔法消耗 ".$info[0]['AbilityManaCost']."</p>";
									}
									if($info[0]['AbilityManaCost']){
		$html['html2'] .= "			<p class='txt2'>冷却时间 ".$info[0]['AbilityCooldown']."</p>";
									}
		$html['html2'] .= "		</div>
								</div>
							</div>";
		$html['html3'] = "<div class='col-in'>
								<div class='mod-info'>
									<div class='hd'>
										<h3 class='tit'>物品技能</h3>
									</div>
									<div class='bd'>";
									if($info[0]['Description']){
		$html['html3'] .= "				<p>".$info[0]['Description']."</p>";
									}
		$html['html3'] .= "			</div>
								</div>
							</div>";
		$html['html4'] = "<div class='col-in'>
								<div class='hd'>
									<h3 class='tit'>合成所需</h3>
								</div>
								<div class='bd icon-item-fc'>
									<ul class='list'>";
									if($info[0]['Materials']){
										foreach($info[0]['Materials'] as $k=>$v){
		$html['html4'] .=				"<li class='item'>
											<div class='link-item'>
												<a tipurl='".Yii::app()->request->baseUrl."/item/".$v['id']."'>
												<input type='hidden' class='get-item-id' value='".$v['id']."' />
												<input type='hidden' class='get-item-name' value='".$v['name']."' />
												<img src='".Yii::app()->params->imgUrl."/images/data/".$v['icon']."' alt='".$v['name']."' class='pic-item' /></a>
											</div>
											<div class='con'>".$v['name']."</div>
										</li>";
										}
									}
		$html['html4'] .= 			"</ul>
								</div>
							</div>";
		$html['html5'] = "<div class='col-in'>
								<div class='hd'>
									<h3 class='tit'>物品进阶</h3>
								</div>
								<div class='bd icon-item-fc'>
									<ul class='list'>";
									if($info[0]['MaterialOf']){
										foreach($info[0]['MaterialOf'] as $key=>$v){
		$html['html5'] .= "			<li class='item'>
										<div class='link-item'>
											<a tipurl='".Yii::app()->request->baseUrl."/item/".$v['id']."'>
											<input type='hidden' class='get-item-id' value='".$v['id']."' />
												<input type='hidden' class='get-item-name' value='".$v['name']."' />
											<img src='".Yii::app()->params->imgUrl."/images/data/".$v['icon']."' alt='".$v['name']."' class='pic-item' /></a>
										</div>
										<div class='con'>".$v['name']."</div>
									</li>";
										}
									}
		$html['html5'] .= "		</ul>
								</div>
							</div>"; 						
		$item = json_encode($html);			//转数据
		print_r($item);
	}
}