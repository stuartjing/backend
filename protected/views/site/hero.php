<?php 
$kq = !empty($_REQUEST['q'])?$_REQUEST['q']:''; 
$skill = new Entity();
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/rangeinput.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tabs.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/slideshow.js"></script>

<input type="hidden" class="getTitle" value="<?php echo $getTitle;?>">
<div class="wrap">
<div class="wrap-in">
	<!-- 头部 开始 -->
	<div class="header">
		<div class="header-in">
			<div class="top-box">
				<!-- logo 开始 -->
				<div class="logo-box">
					<h1><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros.html" class="logo png" title="回到首页"><?php $bbh=$this->get_bbh(); echo $bbh['name']; ?></a></h1>
				</div>
				<!-- logo 结束 -->
				<!-- 搜索框 开始 -->
				<div class="search-wrap">
					<div class="search-box">
						<form name="search_form" method="get" action="<?php echo Yii::app()->request->baseUrl; ?>/search.html" target="_self" class="search-form">
							<input type="text" name="q" id="keyWord" class="search-text" value="<?php if($kq!='搜索英雄、物品' && $kq!=''){echo $kq;}else{?>搜索英雄、物品<?php }?>" onclick="this.value=''"  onFocus="if(this.value=='输入搜索关键字...'){this.value=''}"/>
							<input type="button" class="search-btn" value="" onClick="search_form.submit()"/>
						</form>
					</div>
				</div>
			<!-- 搜索框 结束 -->
			</div>
					<!-- 主导航 开始 -->
			<div class="nav">
				<ul class="nav-in">
					<li class="nav-item nav-item1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros.html" class="nav-con" title="英雄">英雄</a></li>
					<li class="nav-item nav-item2"><a href="<?php echo Yii::app()->request->baseUrl; ?>/items.html" class="nav-con" title="物品">物品</a></li>
					<li class="nav-item nav-item3"><a href="<?php echo Yii::app()->request->baseUrl; ?>/analytics.html" target="_self" class="nav-con" title="数据统计">数据统计</a></li>
				</ul>
			</div>
			<!-- 主导航 结束 -->
		</div>
	</div>	
	<!-- 头部 结束 -->	
	<!-- 主体内容 开始 -->
	<div class="content">
		<div class="content-in">
			<!-- 侧边栏 开始 -->
			<div class="sidebar">
				<!-- 英雄头像 开始 -->
				<a name="lx" style="overflow:visible;"></a>
				<div class="hero-pic-box">
					<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/hero/hero_shot_<?php echo $info['_id'];?>.jpg" alt="" class="hero-pic" />
					<div class="screenshot-box">
						<div class="btn-screenshot"><i class="ico ico-screenshot png"></i>更多截图</div>
						<b class="mask"></b>
					</div>
				</div>
				<!-- 英雄头像 结束 -->
				<!-- 英雄类型 开始 -->
				<ul class="hero-type">
					<li class="item">
						<div class="tit">英雄类型</div>
						<div class="con"><?php echo $info['AttributePrimary'];?>型英雄</div>
						<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$info['AttributePrimary']];?>" alt="" class="ball png" />
					</li>
					<li class="item">
						<div class="tit">英雄阵营</div>
						<div class="con"><?php echo $info['Team'];?></div>
						<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$info['Team']];?>" alt="" class="ball png" />
					</li>
					<li class="item">
						<div class="tit">攻击类型</div>
						<div class="con"><?php echo $info['AttackCapabilities'];?></div>
						<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$info['AttackCapabilities']];?>" alt="" class="ball png" />
					</li>
					<li class="item">
						<div class="tit">英雄定位</div>
						<ul class="item-con">
							<?php foreach($info['Roles'] as $vo){ ?>
							<li>
								<div class="con"><?php echo $vo;?></div>
								<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$vo];?>" alt="" class="ball png" />
							</li>
							<?php } ?>
						</ul>						
					</li>
				</ul>
				<!-- 英雄类型 结束 -->
				<!-- 升级区域 开始 -->
				<div class="col1">
					<div class="slider-box mod-comm2">
						<a name="cz" style="overflow:visible;"></a>
						<input id="rang_input" type="range" name="text" min="1" max="25" value="1"/>
					</div>
					<div class="mod-comm2">生命<span class="num num1 skill1"><?php echo $info['level_1_hp'];?></span></div>
					<div class="mod-comm2">魔法<span class="num num2 skill2"><?php echo $info['level_1_mp'];?></span></div>
					<div class="mod-comm2">力量<span class="num"><span class="num3 skill3"><?php echo $info['AttributeBaseStrength'];?></span>(每等级+<?php echo $info['AttributeStrengthGain'];?>)</span></div>
					<div class="mod-comm2">敏捷<span class="num"><span class="num3 skill4"><?php echo $info['AttributeBaseAgility'];?></span>(每等级+<?php echo $info['AttributeAgilityGain'];?>)</span></div>
					<div class="mod-comm2">智力<span class="num"><span class="num3 skill5"><?php echo $info['AttributeBaseIntelligence'];?></span>(每等级+<?php echo $info['AttributeIntelligenceGain'];?>)</span></div>
					<div class="mod-comm2">初始攻击<span class="num num4 skill6"><?php echo $info['level_1_ap'];?></span></div>
					<div class="mod-comm2">初始护甲<span class="num num4 skill7"><?php echo $info['level_1_armor_qz'];?></span></div>
					<div class="mod-comm2">攻击范围<span class="num num4"><?php echo $info['AttackRange'];?></span></div>	
					<div class="mod-comm2">视野(白天/黑夜)<span class="num num4"><?php echo $info['VisionDaytimeRange'];?>/<?php echo $info['VisionNighttimeRange'];?></span></div>	
					<div class="mod-comm2">移动速度<span class="num num4"><?php echo $info['MovementSpeed'];?></span></div>	
					<div class="mod-comm2">弹道速度<span class="num num4"><?php echo $info['ProjectileSpeed'];?></span></div>	
					<div class="mod-comm2">攻击前摇<span class="num num4"><?php echo $info['AttackAnimationPoint'];?></span></div>
				</div>
				<!-- 升级区域 结束 -->
				<!-- 英雄故事 开始 -->
				<div class="hstory">
					<a id="gs" style="overflow:visible;"></a>
					 <h2>英雄故事</h2>
					<div class="hstory-article">
						<div class="intro1"><?php echo $info['背景故事_1'];?>
						<?php if(strlen($info['背景故事_1'])>=70){?>
						<span class="bt-all">[详细]</span></div>
						<?php }?>
						<div  class="article">
						<p><?php echo $info['背景故事'];?><span class="bt-short">[收起]</span></p>
						</div>							
					
					</div>
				</div>
				<!-- 英雄故事 结束 -->	
				<!-- 推荐视频 开始 -->
				<div class="videos">
					<a name="sp" style="overflow:visible;"></a>
					<div class="vtit"><h2>推荐视频</h2><a class="more" target="_blank" href="<?php if($heroSp[1]!=''){ ?>http://dota2.17173.com/v/<?php echo $heroSp[1];?>/<?php }else{?>http://v.17173.com/dota2/<?php }?>">MORE</a></div>
					<?php
						if($heroSp[0]!=''){
						$fgc = @file_get_contents("http://dota2.17173.com/inc/".$heroSp[0].".inc");
						}else{
						$fgc = @file_get_contents("http://dota2.17173.com/inc/20131118162045.inc");
						}
						echo iconv('gbk', 'utf-8', $fgc);
					?>
				</div>
				<!-- 推荐视频 结束 -->	
				<!-- 推荐攻略 开始 -->
				<div class="raiders">
					<a name="gonglv" style="overflow:visible;"></a>
					<div class="vtit"><h2>推荐攻略</h2><a class="more" target="_blank" href="http://dota2.17173.com/gl/">MORE</a></div>
					<div class="raiders-recom">
					<?php
						$fgc = @file_get_contents("http://dota2.17173.com/inc/20131112110105.inc");
						echo iconv('gbk', 'utf-8', $fgc);
					?>
					</div>
				</div>
				<!-- 推荐攻略 结束 -->					
			</div>
			<!-- 侧边栏 结束 -->
			<!-- 主内容 开始 -->
			<div class="main">
				<div class="main-hd">
					<h2 class="tit"><?php echo $info['name'];?><span class="tit-m"><?php echo $info['_id'];?></span></h2>
					<div class="more"><?php if(!empty($info['真名'])){?>俗称：<?php echo $info['真名'];?><?php }else{echo '&nbsp;';}?>	</div>
					<div class="tweek">
						<a name="zk" style="overflow:visible;"></a>
						<span class="wktit">本周</span>
						<div class="tweek-in tweek-one"><span>出场</span><label><?php echo $info['sumcount'];?></label></div>
						<div class="tweek-in"><span>胜率</span><label><?php echo $info['winning'];?>%</label></div>
					</div>
				</div>
				<div class="main-bd">
					<!-- 升级技能 开始 -->
					<div class="strategy-info comm-tab js-tab">
						<div class="hd dtab">				
							<ul class="gb-tab clearfix">
								<li class="gb-tab-item gb-bab-ys"><a href="javascript:;" class="gb-tab-c current" title="基本信息"><span class="gb-tab-bg">基本信息</span></a></li>
								<li class="gb-tab-item gb-bab-ys gb-tab-tj"><a href="javascript:;" class="gb-tab-c" title="统计"><span class="gb-tab-bg">统计</span></a></li>
								<li class="gb-tab-item gb-bab-ys gb-tab-tj"><a href="javascript:;" class="gb-tab-c" title="趋势"><span class="gb-tab-bg">趋势</span></a></li>									
							</ul>				
						</div>
						<div class="bd gb-tab-pn gb-tab-info">
						
						<!--基本信息 开始 -->
							<div class="gb-tab-con" style="padding:0;">
							<!-- 基本信息 开始 -->
								<div class="basic-info">
									<div class="bd">
										<div class="intro"><?php echo $info['hero_overview_1'];?>
										<?php if(strlen($info['hero_overview_1'])>=160){?>
										<span class="bt-all">[详细]</span>
										<?php }?>
										</div>
										<div class="article">
											<?php echo $info['hero_overview'];?><span class="bt-short">[收起]</span></p>								
										</div>
									</div>
								</div>
								<!-- 基本信息 结束 -->
								<!-- 最强搭档对手 开始 -->
								<div class="partner-x">
								<a id="gongshi" style="overflow:visible;"></a>
									<div class="zqdd par-in">
										<div class="par-tit"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/zqdd.jpg" /></div>
										<ul class="partner-ul">
											<?php foreach($info['good_teammate'] as $vo){ ?>
											<li><a class="link-hero" target="_self" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $vo['id'];?>" href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $vo['id'];?>.html"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo  $vo['id'];?>.jpg" class="pic-hero" alt="<?php echo  $vo['name'];?>"  /></a></li>
											<?php } ?>
										</ul>
									</div>
									<div class="zqds par-in">
										<div class="par-tit"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/zqds.jpg" /></div>
										<ul class="partner-ul">
											<?php foreach($info['force_enemy'] as $vo){ ?>
											<li><a class="link-hero" target="_self" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $vo['id'];?>" href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $vo['id'];?>.html"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo  $vo['id'];?>.jpg" class="pic-hero" alt="<?php echo  $vo['name'];?>"  /></a></li>
											<?php } ?>
										</ul>
									</div>
								</div>
								<!-- 最强搭档对手 结束 -->
								<!-- 技能区域1 开始 -->	
								<a name="jn" style="overflow:visible;"></a>
								<?php foreach($info['Abilities'] as $key=>$vo){ ?>
								<div class="pn-info">
									<div class="pn-skill1">
										<div class="mod-comm2 skill-zone">
											<div class="c1">
												<div class="pn-skill1-link">
													<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $vo['id'];?>.jpg" class="pn-img" alt="<?php echo $vo['name'];?>"  />
													<span class="txt"><?php if(isset($vo['hotkey'])){echo $vo['hotkey'];}?></span>
												</div>
												<div class="pn-skill1-yanshi">
													<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/yanshi.png" class="yanshi-img" alt=""  />
													<?php if(isset($vo['video']) && $vo['video']!=''){ ?>
													<input type="hidden" value="<?php echo $vo['video'];?>" name="video" id="video">
													<?php }else{?>
													<input type="hidden" value="" name="video" id="video">
													<?php }?>
												</div>
											</div>
											<div class="c2">
												<p class="tit"><span class="name"><?php echo $vo['name'];?></span><?php echo $vo['AbilityBehavior'];?></p>
												<?php if(isset($vo['Description']) && $vo['Description']!=''){ ?>
												<p class="description"><?php echo $vo['Description'];?></p>
												<?php }?>
												<?php if(isset($vo['AbilityCooldown']) && $vo['AbilityCooldown']!=''){ ?>
												<p class="pn-prty pn-time"><span>冷却时间：</span><?php echo $vo['AbilityCooldown'];?>s<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/cooldown.jpg" /></p>
												<?php }?>
												<?php if(isset($vo['AbilityManaCost']) && $vo['AbilityManaCost']!=''){ ?>
												<p class="pn-prty pn-cs"><span>魔法消耗：</span><?php echo $vo['AbilityManaCost'];?><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/mana.jpg"/></p>
												<?php }?>
												<?php if(isset($vo['AbilityCastRange']) && $vo['AbilityCastRange']!=''){ ?>
												<p class="pn-prty"><span>作用范围：</span><?php echo $vo['AbilityCastRange'];?></p>
												<?php }?>
												<?php if(isset($vo['AbilityDuration']) && $vo['AbilityDuration']!=''){ ?>
												<p class="pn-prty"><span>持续时间：</span><?php echo $vo['AbilityDuration'];?></p>
												<?php }?>
												<?php if(isset($vo['AbilityDamage']) && $vo['AbilityDamage']!=''){ ?>
												<p class="pn-prty"><span>技能伤害：</span><?php echo $vo['AbilityDamage'];?></p>
												<?php }?>
												<?php if(isset($vo['AbilityUnitDamageType']) && $vo['AbilityUnitDamageType']!=''){ ?>
												<p class="pn-prty"><span>伤害类型：</span><?php echo $vo['AbilityUnitDamageType'];?></p>
												<?php }?>
												<?php if(isset($vo['终极技能']) && $vo['终极技能']!=0){ ?>
												<p class="pn-prty"><span>终极技能：</span>是</p>
												<?php }else{?>
												<p class="pn-prty"><span>终极技能：</span>否</p>
												<?php }?>
												<?php 
												if(isset($vo['lines']) && $vo['lines']!=''){ 
													foreach($vo['lines'] as $k=>$v){
														if(stristr($v,"：")){
														$va = explode("：",$v);
												?>
												<p class="pn-prty"><span><?php echo $va[0];?>：</span><?php echo $va[1];?></p>
												<?php 
													}
													}
												}
												?>
											</div>
										</div>
									</div>
									<div class="pn-skill2">
										<h2>技能细节</h2>
										<?php 
										if(isset($vo['ability_overview']) &&  $vo['ability_overview']!=''){ 
											if(stristr($vo['ability_overview'],"<p>")){
												echo trim(str_replace("<p>",'<p class="pn-con">',str_replace('　　','',$vo['ability_overview'])));
											}else{
												echo '<p class="pn-con">'.str_replace('　　','',$vo['ability_overview']).'</p>';
											}
										}
										?>
									</div>
								</div>
								<?php }?>
								<!-- 技能区域1 结束 -->	
								<!-- 出装攻略 开始 -->
								<div class="strategy-equ comm-tab js-tab">
									<a name="czgl" style="overflow:visible;"></a>
									<div class="hd">				
										<ul class="gb-tab clearfix">
											<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c current" title="<?php echo $info['name'];?>出装攻略"><span class="gb-tab-bg"><?php echo $info['name'];?>出装攻略</span></a></li>
										</ul>				
									</div>
									<div class="bd gb-tab-pn">
										<div class="gb-tab-con">
											<div class="item-type">				
												<div class="tit">出门</div>
												<ul class="item-list">
													<?php foreach($info['出门装备'] as $vo){ ?>
													<li>
														<div class="link-item">
															<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $vo['id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $vo['itemId'];?>.html" target="_self"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $vo['icon'];?>" alt="<?php echo $vo['name'];?>" class="pic-item" /></a>
														</div>
														<div class="con"><?php echo $vo['name'];?></div>
													</li>
													<?php } ?>
												</ul>
												<?php if(isset($info['出门装备描述']) && trim(strip_tags($info['出门装备描述']))!=''){?>
												<div class="intro"><?php echo $info['出门装备描述'];?></div>
												<?php }?>
											</div>
											<div class="item-type">				
												<div class="tit">前期</div>
												<ul class="item-list">
													<?php foreach($info['前期装备'] as $vo){ ?>
													<li>
														<div class="link-item">
															<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $vo['id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $vo['itemId'];?>.html" target="_self"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $vo['icon'];?>" alt="<?php echo $vo['name'];?>" class="pic-item" /></a>
														</div>
														<div class="con"><?php echo $vo['name'];?></div>
													</li>
													<?php }?>									
												</ul>
												<?php if(isset($info['前期装备描述']) && trim(strip_tags($info['前期装备描述']))!=''){?>
												<div class="intro"><?php echo $info['前期装备描述'];?></div>
												<?php }?>
											</div>
											<div class="item-type">				
												<div class="tit">核心</div>
												<ul class="item-list">
													<?php foreach($info['核心装备'] as $vo){ ?>
													<li>
														<div class="link-item">
															<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $vo['id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $vo['itemId'];?>.html" target="_self"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $vo['icon'];?>" alt="<?php echo $vo['name'];?>" class="pic-item" /></a>
														</div>
														<div class="con"><?php echo $vo['name'];?></div>
													</li>
													<?php }?>																			
												</ul>
												<?php if(isset($info['核心装备描述']) && trim(strip_tags($info['核心装备描述']))!=''){?>
												<div class="intro"><?php echo $info['核心装备描述'];?></div>
												<?php }?>
											</div>
											<div class="item-type">				
												<div class="tit">备选</div>
												<ul class="item-list">
													<?php 
														if($info['可选装备']){
															foreach($info['可选装备'] as $vo){ 
															if(isset($vo['name'])){
														?>
													<li>
														<div class="link-item">
															<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $vo['id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $vo['itemId'];?>.html" target="_self"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $vo['icon'];?>" alt="<?php echo $vo['name'];?>" class="pic-item" /></a>
														</div>
														<div class="con"><?php echo $vo['name'];?></div>
													</li>
													<?php 
															}
															}
														}
													?>														
												</ul>
												<?php if(isset($info['可选装备描述']) && trim(strip_tags($info['可选装备描述']))!=''){?>
												<div class="intro"><?php echo $info['可选装备描述'];?></div>
												<?php }?>
											</div>	
										</div>				
									</div>
								</div>
								<!-- 出装攻略 结束 -->
								<!-- 加点攻略 开始 -->
								<div class="strategy-point comm-tab js-tab">
									<a name="jd" style="overflow:visible;"></a>
									<div class="hd">				
										<ul class="gb-tab clearfix">
											<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c current" title="<?php echo $info['name'];?>加点攻略"><span class="gb-tab-bg"><?php echo $info['name'];?>加点攻略</span></a></li>
											<?php if($info['RecommendSkills2']){?>
											<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c" title="<?php echo $info['name'];?>加点攻略"><span class="gb-tab-bg"><?php echo $info['RecommendSkills2Title'];?></span></a></li>
											<?php } ?>
											<?php if($info['RecommendSkills3']){?>
											<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c" title="<?php echo $info['name'];?>加点攻略"><span class="gb-tab-bg"><?php echo $info['RecommendSkills3Title'];?></span></a></li>
											<?php } ?>
										</ul>
									</div>
									<div class="bd gb-tab-pn">
										<?php if(isset($arr1)){?>
										<div class="gb-tab-con">
											<?php foreach ( $arr1 as $key=>$val ) {?>
											<div class="point-box">
												<div class="tit">
													<span class="link-skill">
													<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $val['id']?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-skill" /></a>
													</span><?php if(isset($val['hotkey'])){echo $val['hotkey'];}?>
												</div>
												<ul class="point-list">
													<?php 
														for($i=1;$i<26;$i++){
															if(in_array($i,$val['key'])){
														?>
														<li class="on"><?php echo $i;?></li>
														<?php 
															}else{
														?>
														<li></li>
														<?php 
															}
														}
														?>									
												</ul>
											</div>
											<?php }?>
											<div class="intro">
											<?php if(isset($info['RecommendSkillsDesc'])){echo $info['RecommendSkillsDesc'];}?>
											</div>
										</div>
										<?php }?>
										<?php if($info['RecommendSkills2']){?>
										<?php if(isset($arr2)){?>
										<div class="gb-tab-con" style="display:none">
											<?php foreach ( $arr2 as $key=>$val ) {?>
											<div class="point-box">
												<div class="tit">
													<span class="link-skill">
													<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $val['id']?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-skill" /></a>
													</span><?php if(isset($val['hotkey'])){echo $val['hotkey'];}?>
												</div>
												<ul class="point-list">
													<?php 
														for($i=1;$i<26;$i++){
															if(in_array($i,$val['key'])){
														?>
														<li class="on"><?php echo $i;?></li>
														<?php 
															}else{
														?>
														<li></li>
														<?php 
															}
														}
														?>									
												</ul>
											</div>
											<?php }?>
											<div class="intro">
											<?php if(isset($info['RecommendSkills2Desc'])){echo $info['RecommendSkills2Desc'];}?>
											</div>
										</div>
										<?php }?>
										<?php }?>
										<?php if($info['RecommendSkills3']){?>
										<?php if(isset($arr3)){?>
										<div class="gb-tab-con" style="display:none">
											<?php foreach ( $arr3 as $key=>$val ) {?>
											<div class="point-box">
												<div class="tit">
													<span class="link-skill">
													<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $val['id']?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-skill" /></a>
													</span><?php if(isset($val['hotkey'])){echo $val['hotkey'];}?>
												</div>
												<ul class="point-list">
													<?php 
														for($i=1;$i<26;$i++){
															if(in_array($i,$val['key'])){
														?>
														<li class="on"><?php echo $i;?></li>
														<?php 
															}else{
														?>
														<li></li>
														<?php 
															}
														}
														?>									
												</ul>
											</div>
											<?php }?>
											<div class="intro">
											<?php if(isset($info['RecommendSkills3Desc'])){echo $info['RecommendSkills3Desc'];}?>
											</div>
										</div>
										<?php }?>
										<?php }?>
									</div>
								</div>
								<!-- 加点攻略 结束 -->
								<!--锚点-->
								<div class="maodian">
									<div style="border:1px solid #922911;"></div>
									<ul class="md-nr">
										<li><a href="#jn">技能</a></li>
										<li><a href="#czgl">出装</a></li>
										<li><a href="#jd">加点</a></li>
										<li><a href="#lx">类型</a></li>
										<li><a href="#cz">成长</a></li>
										<li><a href="#gs">故事</a></li>
										<li><a href="#gongshi">搭档</a></li>
										<li><a href="#sp">视频</a></li>
										<li><a href="#gonglv">攻略</a></li>
										<li><a href="#zk">战况</a></li>
										<li style="margin-bottom:0;"><a href="#"><img onclick="pageScroll();" src="<?php echo Yii::app()->params->imgUrl; ?>/images/top.png" /></a></li>
									</ul>
								</div>
								<!--锚点-->
						   </div>
						   <!--基本信息 结束 -->
						   <!--统计 开始-->
						   <div class="gb-tab-con" style="display:none">
								<div class="strategy-tj comm-tab js-tab">
									<div class="hd">
										<div class="tag-box">
											<div class="tag-box-in">
												<a href="javascript:void(0);" class="link current" title="周">周</a><a href="javascript:void(0);" class="link" title="月">月</a><a href="javascript:void(0);" class="link" title="<?php $bbh=$this->get_bbh(); echo $bbh['name']; ?>"><?php $bbh=$this->get_bbh(); echo $bbh['name']; ?></a>
											</div>
										</div>			
									</div>
									<div class="bd gb-tab-pn">
										<!--技能区  开始-->
										<div class="gb-tab-con pn-skill">
											<div class="hd">
												 <h3><?php echo $info['name'];?>前期Lv.1至Lv.10最受欢迎加点Top</h3>
											 </div>
											<ul class="skill-list skill-top">
												<?php foreach($tjinfo['skill'] as $key=>$val){ ?>
												<li class="hero-con">
													<div class="skill-box">
														<img class="skill-h" alt="" src="<?php echo Yii::app()->params->imgUrl; ?>/images/skill-top<?php echo $key+1;?>.png">
													</div>
													<?php 
													foreach($val as $ke=>$va){ 
														if($ke<10){
													?>
													<div class="skill-box">
														<div class="link-skill">
															<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $va['_id'];?>"><img class="pic-skill" alt="" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $va['_id'];?>.jpg"></a>
														 </div>
													</div>
													<?php if($ke<9){?>
														<div class="skill-box">
															<img class="skill-jt" alt="" src="<?php echo Yii::app()->params->imgUrl; ?>/images/skill-jt.png">
														</div>
													<?php } } } ?>
												</li>
												<?php }?>
											</ul>
											<div class="hd">
												 <h3>优先加满顺序</h3>
											 </div>
											<ul class="skill-list skill-yxjm">
												<?php foreach($tjinfo['yxjm'] as $key=>$val){ ?>
												<li class="hero-con">
													<div class="c11">
														<a class="link-skill" title="" target="_self" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $val['_id'];?>">
															<img class="pic-skill" alt="" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $val['_id'];?>.jpg">
														</a>
													</div>
													<div class="c21">
														<div class="xxt" style="width:500px;"></div>
														<div class="xxt-jt"></div>
														<div class="xx-label">
															<label><?php echo $val['total'];?>人</label>
														</div>
													</div>
												</li>
												<?php } ?>
											</ul>
										<!-- </div>-->
										<!--技能区  结束-->
										<!-- 出装区 开始 -->
										<!-- <div class="gb-tab-con" style="padding:0;"> -->
										<a id="tab-x-cz" style="visibility:visible;"></a>
											<div class="pn pn-item">
												<div class="pn-in">
													<!-- 出装统计 开始 -->
													<div class="hd">
														<h3><?php echo $info['name'];?>各阶段最受欢迎出装。</h3>
													</div>
													<div class="info info-cztj">
														<?php 
														$i=1;
														foreach($czinfo as $key=>$val){ 
															$c2s = '';
															if($i==1){$c2s = "c2-hq";}elseif($i==2){$c2s = "c2-cx";}elseif($i==3){$c2s = "c2-gd";}elseif($i==4){$c2s = "c2-qq";}
															$i++;
														?>
															<div class="col col<?php echo $i;?>">
                                                                <div class="col-in">
                                                                    <div class="hd">
                                                                        <h3 class="tit" align="center"><?php echo $key;?></h3>
                                                                    </div>
                                                                    <div class="bd">
                                                                        <ul class="list">
																			<?php foreach($val as $ke=>$va){
																				$iteminfo = array();
																				$iteminfo = $skill->getItem($va['item_id']);
																				if(!empty($iteminfo) && isset($iteminfo[0])){ ?>
																				<li class="item">
																					<div class="c1">
																						<a class="link-item" title="" target="_self" href="<?php echo Yii::app()->request->baseUrl;?>/items/<?php echo $iteminfo[0]['itemId'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl;?>/item/<?php echo $iteminfo[0]['_id'];?>">
																							<img class="pic-item" alt="" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $iteminfo[0]['icon'];?>">
																						</a>
																					</div>
																					<div class="c2 <?php echo $c2s;?>">
																						<label><?php echo $va['sumcount'];?></label>
																						<div class="xxt"></div>
																					</div>
																				</li>
																				
																			<?php }} ?>			
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
														<?php } ?>
													</div>
													<!-- 出装统计 结束 -->
												</div>
											</div>
									   </div>
									   <!-- 出装区 结束 -->
								   </div>
								</div>
						   </div>
						   <!--统计 结束-->
						   <!--趋势 开始-->
						   <div class="gb-tab-con" style="display:none">
                              		<div class="strategy-qs">
                                        <div class="hd">
                                        	<div class="tag-box-t">
                                                   <span class="qs-pop">对比其它英雄</span>
                                                   <img class="qs-pop" src="<?php echo Yii::app()->params->imgUrl; ?>/images/tc.png"/>
                                            </div>		
                                            <div class="tag-box tag-box-s">
                                                <div class="tag-box-in tag-box-type">
                                                    <a href="#" class="link current" title="出场数">出场数</a><a href="#" class="link" title="胜率">胜率</a><a href="#" class="link" title="杀人">杀人</a><a href="#" class="link" title="助攻">助攻</a><a href="#" class="link" title="被杀">被杀</a><a href="#" class="link" title="金钱">金钱</a><a href="#" class="link" title="经验">经验</a>	
                                                </div>
                                            </div>		
                                            <div class="tag-box">
                                                <div class="tag-box-in tag-box-date">
                                                    <a href="#" class="link current" title="周">周</a><a href="#" class="link" title="月">月</a><a href="#" class="link" title="<?php $bbh=$this->get_bbh(); echo $bbh['name']; ?>"><?php $bbh=$this->get_bbh(); echo $bbh['name']; ?></a>
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="pn-bd" id="pn-bd"></div>
                                   </div>
                               </div>
						   <!--趋势 结束-->
					   </div>
					   
					</div>
					<!-- 升级技能 结束 -->
					
				</div>
			</div>
			<!-- 主内容 结束 -->		
			<!--趋势弹出层 开始-->
			<div class="white_content ">
				<div class="gb-tab-con"><div class="pn-pic"></div></div>
			</div>
			<div class="black_overlay"></div>
			<!--趋势弹出层 结束-->
		</div>
	</div>
	<!-- 主体内容 结束 -->
</div>
<input type="hidden" id="hero1" value="<?php echo $info['numId'];?>"/>
<input type="hidden" id="hero2" value=""/>
<div class="screen-mask"></div>
<!--截图浮层开始-->
<div class="screenshot-tips">
	<div class="focus" data-ui-control="Slide">
		<div class="focus-in">
			<ul data-ui-mark="data" style="display: none;">
				<li>
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big1.jpg" data-ui-data="img" />
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big1.jpg" alt="" data-ui-data="thumb" />               
				</li>
				<li>
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big2.jpg" data-ui-data="img" />
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big2.jpg" alt="" data-ui-data="thumb" />                
				</li>
				<li>
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big3.jpg" data-ui-data="img" />
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big3.jpg" alt="" data-ui-data="thumb" />               
				</li>
				<li>
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big4.jpg" data-ui-data="img" />
					<img data-src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/big/hero_<?php echo $info['_id'];?>_big4.jpg" alt="" data-ui-data="thumb" />                
				</li>           
			</ul>
			<div class="focus-con">
				<!-- 焦点图 图片+文字 开始 -->
				<div class="focus-con-item" data-ui-mark="imageContainer">
					<p class="img-box">						
						<img src="http://ue2.17173.itc.cn/a/www/index/2013/images/img-place.png" alt="" data-ui-mark="img" />
					</p>                
				</div>
				<!-- 焦点图 图片+文字 结束 -->
			</div>
			<div class="focus-fun" data-ui-mark="tool">
				<a href="javascript:;" data-ui-mark="prev" class="bt bt-focus-prev png" hidefocus="true" title="前一张">前一张</a>
				<div class="focus-thumb" data-ui-mark="thumbsbox">
					<div class="focus-thumb-in">
						<div class="focus-thumb-box" data-ui-mark="thumbs">
							<p class="focus-thumb-item current">
								<a href="javascript://" title="">
									<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/img-place.png" alt="" /></a>
							</p>
							<p class="focus-thumb-item current">
								<a href="javascript://" title="">
									<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/img-place.png" alt="" /></a>
							</p>
							<p class="focus-thumb-item current">
								<a href="javascript://" title="">
									<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/img-place.png" alt="" /></a>
							</p>
						</div>
					</div>
				</div>
				<a href="javascript:;" class="bt bt-focus-next png" data-ui-mark="next" hidefocus="true" title="后一张">后一张</a>
			</div>
			<div class="num"><span class="txt">1</span>/4</div>
			<div class="bt-close"><span class="ico-x">x</span>关闭</div>      
		</div>
	</div>
</div>
<!--截图浮层结束-->

<!--视频弹层   开始-->
<div class="pop_layer">
	<div class="pop_sp">
	</div>
	<div class="pop_close"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/close.png" /></div>
</div>
<div class="pop_layer_overlay"></div>
<!--视频弹层   结束-->
<script type="text/javascript">
	var AttributeBaseStrength = <?php echo $info['AttributeBaseStrength'];?>;		//力量
	var AttributeBaseAgility = <?php echo $info['AttributeBaseAgility'];?>;			//敏捷
	var AttributeBaseIntelligence = <?php echo $info['AttributeBaseIntelligence'];?>;//智力
	var level_1_ap_min = <?php echo $info['level_1_ap_min'];?>;						//初始攻击
	var level_1_ap_max = <?php echo $info['level_1_ap_max'];?>;
	var level_1_armor = <?php echo $info['level_1_armor'];?>;						//初始护甲
	var AttributeStrengthGain = <?php echo $info['AttributeStrengthGain'];?>;		//力量等级+
	var AttributeAgilityGain = <?php echo $info['AttributeAgilityGain'];?>;			//敏捷等级+
	var AttributeIntelligenceGain = <?php echo $info['AttributeIntelligenceGain'];?>;//智力等级+
	var AttributePrimary = <?php echo '"'.$info['AttributePrimary'].'"';?>;					//英雄类型
	
	//统计趋势用
	var _id = <?php echo '"'.$info['_id'].'"';?>;		//英雄id
	var name = <?php echo '"'.$info['name'].'"';?>;		//英雄名字
	var numId = <?php echo $info['numId'];?>;	//英雄数字编号
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/herojs.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/swfobject.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/heroTrend.js"></script>
