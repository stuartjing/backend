<?php /* source file: F:\wamp\www\jing\test1\protected\views\site\index.php */ ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/table.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/filterdata.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/herodata.js"></script>

<input type="hidden" class="getTitle" value="<?php echo $getTitle;?>">
<a name="middle_top" id="middle_top"></a>
	<!-- 主体内容 开始 -->
	<div class="content">
		<div class="content-in">
			<!-- 筛选框 开始 -->
			<div class="filter-box">
				<div class="filter-box-in">
					<div class="tag tag1">
						<div class="tit">攻击</div>
						<ul class="con">
							<?php foreach($finds['AttackCapabilities'] as $key=>$vo){ ?>
							<li class="item <?php if(isset($filters['AttackCapabilities'])&&in_array($key, $filters['AttackCapabilities'])){?> current <?php }?>">
								<a href="javascript:void(0);" class="link" id='2_<?php echo $key?>' title="<?php echo $vo?>"><?php echo $vo?></a>
								<div class="box">
									<div class="pic"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$vo];?>" class="png avatar" alt="<?php echo $vo?>" /></div>
									<div class="close"></div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
					<div class="tag tag2">
						<div class="tit">定位</div>
						<ul class="con">
							<?php 
							foreach($finds['Roles'] as $key=>$vo){
								$len = strlen($vo);
							?>
							<li class="item <?php if($len>6){?>item-l<?php }?> <?php if(isset($filters['Roles'])&&in_array($key, $filters['Roles'])){?> current <?php }?>">
								<a href="javascript:void(0);" class="link" id='3_<?php echo $key?>' title="<?php echo $vo;?>"><?php echo $vo;?></a>
								<div class="box">
									<div class="pic"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$vo];?>" class="png avatar" alt="<?php echo $vo;?>" /></div>
									<div class="close"></div>
								</div>
							</li>
							<?php 
							}
							?>
						</ul>
					</div>
					<b class="mask"></b>
				</div>			
			</div>
			<!-- 筛选框 结束 -->
			<!-- 标签切换区 开始 -->
			<div class="js-tab pn-hero">
				<div class="hd clearfix">				
					<ul class="gb-tab clearfix">
						<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c current" title="图标"><i class="ico ico-pic"></i>图标</a></li>
						<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c" title="列表"><i class="ico ico-list"></i>列表</a></li>
						<li class="gb-tab-item"><a href="javascript:;" class="gb-tab-c" title="详细"><i class="ico ico-detail"></i>详细</a></li>					
					</ul>
				</div>
				<div class="bd gb-tab-pn">
					<!-- 图标内容 开始 -->
					<div class="gb-tab-con">										
						<div class="pn-pic">
							<!-- 天辉 夜魇 开始 -->
							<?php 
							if(!empty($hero)){
								$a = 1;
								foreach ( $hero as $key=>$val ) {
							?>
							<div class="pn">
								<div class="pn-hd">
									<h2 class="tit"><?php echo $key;?></h2>
								</div>
								<div class="pn-bd clearfix">
									<?php 
									$i = 1;
									foreach ( $val as $k=>$v ) {
									?>
									<div class="mod-comm1 col<?php echo $i;?>">
										<div class="hd">
											<h3 class="tit"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/dotaimg/<?php echo $heroimg[$k];?>" class="pic-t png" alt="<?php echo $k;?>"  /><?php echo $k;?></h3>
										</div>
										<div class="bd">
											<?php 
											foreach ( $v as $va ) {
											?>
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $va['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $va['_id'];?>.html" target="_self" class="link-hero-pic link-hero" title="<?php echo $va['name'];?>">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo  $va['_id'];?>.jpg" class="pic-hero" alt="<?php echo $va['name'];?>"  />
											</a>
											<?php 
											}
											?>
										</div>
									</div>
									<?php 
										$i++;
									} ?>
								</div>
							</div>
							<?php 
								if($a==1){
							?>
							<div class="line"></div>
							<?php
								}
									$a++;
								}
							} ?>
							<!-- 天辉 夜魇 结束 -->
						</div>					
					</div>
					<!-- 图标内容 结束 -->
					<!-- 列表内容 开始 -->
					<div class="gb-tab-con"  style="display:none">
						<div class="pn-list">
							<div class="pn-list-in">
								<!-- 天辉夜魇 开始 -->
								
								<div class="pn col1">
									<div class="pn-hd">
										<h2 class="tit">天辉</h2>
										<div class="tag-box">
											<div class="heroList-tag-box-in">
												<a href="javascript:void(0);" class="link current" id="1_" title="全部">全部</a><?php foreach($finds['AttributePrimary'] as $k=>$vo){ ?><a href="javascript:void(0);" class="link" id="1_<?php echo $vo?>" title="<?php echo $vo?>"><?php echo $vo?></a><?php } ?>
												</div>
										</div>
									</div>
									<div class="pn-bd">
										<ul class="list team1">
										
										</ul>						
									</div>
								</div>
								<div class="pn col2">
									<div class="pn-hd">
										<h2 class="tit">夜魔</h2>
										<div class="tag-box">
											<div class="heroList-tag-box-in">
												<a href="javascript:void(0);" class="link current" id="1_" title="全部">全部</a><?php foreach($finds['AttributePrimary'] as $k=>$vo){ ?><a href="javascript:void(0);" class="link" id="1_<?php echo $vo?>" title="<?php echo $vo?>"><?php echo $vo?></a><?php } ?>
												</div>
										</div>
									</div>
									<div class="pn-bd">
										<ul class="list team2">
											<!-- 动态加载 -->
										</ul>						
									</div>
								</div>
								<!-- 天辉夜魇 结束 -->
							</div>
						</div>			
					</div>
					<!-- 列表内容 结束 -->
					<!-- 详细内容 开始 -->
					<div class="gb-tab-con" style="display:none" >
						<div class="pn-detail">
							<div class="pn">
								<div class="pn-hd">
									<h2 class="tit"><?php if(empty($filters['Team'][0])) echo '全部'; else echo $filters['Team'][0];?></h2>
									<div class="tag-box">
										<div class="tag-box-in tag-box-detail">	
											<a href="javascript:void(0);" class="link <?php if(empty($filters['AttributePrimary'][0])){?> current <?php }?>" id="1_" title="全部">全部</a><?php foreach($finds['AttributePrimary'] as $key=>$vo){ ?><a href="javascript:void(0);" class="link <?php if(isset($filters['AttributePrimary'])&&in_array($vo, $filters['AttributePrimary'])){?> current <?php }?>" id="1_<?php echo $vo?>" title="<?php echo $vo?>"><?php echo $vo?></a><?php } ?>
										</div>
									</div>
									<div class="tag-box tag-box-s">
										<div class="tag-box-in">
											<a href="#" class="link <?php if(empty($filters['Team'][0])){?> current <?php }?>" id="0_" title="全部">全部</a><?php foreach($team as $key=>$vo){ ?><a href="#" class="link <?php if(isset($filters['Team'])&&in_array($vo, $filters['Team'])){?> current <?php }?>" id="0_<?php echo $vo?>" title="<?php echo $vo?>"><?php echo $vo?></a><?php } ?>
										</div>
									</div>
								</div>
								<div class="pn-bd">								
									<table cellpadding="0" cellspacing="0" border="0" class="table-detail">
										<tbody>
										<tr class="title">
											<th class="tit" style="width:151px;" onclick="Table.sortBy('name',0,'hero_list', 2);"><a href="javascript:void(0);">英雄</a></th>
											<!--th class="tit"><a href="javascript:Table.sortBy('level_1_hp',1,'hero_list', 2);">生命<i class="ico ico-arrow"></i></a></th-->
											<th class="tit" onclick="Table.sortBy('level_1_hp',1,'hero_list', 2);"><a href="javascript:void(0);">生命<i class="ico ico-arrow"></i></a></th>
											<th class="tit" onclick="Table.sortBy('level_1_mp',1,'hero_list', 2);"><a href="javascript:void(0);">魔法</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('AttributeBaseStrength',1,'hero_list', 2);"><a href="javascript:void(0);">力量</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('AttributeBaseAgility',1,'hero_list', 2);"><a href="javascript:void(0);">敏捷</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('AttributeBaseIntelligence',1,'hero_list', 2);"><a href="javascript:void(0);">智力</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('level_1_ap',1,'hero_list', 2);"><a href="javascript:void(0);">初始攻击</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('level_1_armor_qz',1,'hero_list', 2);"><a href="javascript:void(0);">初始护甲</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('AttackRange',1,'hero_list', 2);"><a href="javascript:void(0);">攻击范围</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('VisionNighttimeRange',1,'hero_list', 2);"><a href="javascript:void(0);">视野(白天/黑夜)</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('MovementSpeed',1,'hero_list', 2);"><a href="javascript:void(0);">移动速度</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('ProjectileSpeed',1,'hero_list', 2);"><a href="javascript:void(0);">弹道速度</a><i class="ico ico-arrow"></i></th>
											<th class="tit" onclick="Table.sortBy('AttackAnimationPoint',1,'hero_list', 2);"><a href="javascript:void(0);">攻击前摇</a><i class="ico ico-arrow"></i></th>
										</tr>
										</tbody>
										<tbody id="hero_list2">
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>	
					<!-- 详细内容 结束 -->			
				</div>			
			</div>
			<!-- 标签切换区 结束 -->
		</div>
	</div>
	<!-- 主体内容 结束 -->
	
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/indexjs.js"></script>