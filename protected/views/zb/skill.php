<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/table.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/skilljs.js"></script>
<input type="hidden" class="getTitle" value="<?php echo $getTitle;?>">
<!-- 主体内容 开始 -->
<div class="content">
	<div class="content-in">
		<!-- 筛选框 开始 -->
		<div class="filter-box">
			<div class="filter-box-in">
				<div class="tag tag1">
					<div class="tit">类型</div>
					<div class="con">
						<input type="radio" name="count_type"/><label class="hRadio_Checked">全部</label>
						<?php foreach($finds['AttributePrimary'] as $key=>$vo){ ?>
						<input type="radio" name="count_type"/><label><?php echo $vo?></label>
                  		<?php } ?>
					</div>
				</div>
				<div class="tag tag2">
					<div class="tit">攻击</div>
					<div class="con">
						<input type="radio" name="attack"/><label class="hRadio_Checked">全部</label>
						<?php foreach($finds['AttackCapabilities'] as $key=>$vo){ ?>
						<input type="radio" name="attack"/><label><?php echo $vo?></label>
                  		<?php } ?>
					</div>
				</div>
				<div class="tag tag3">
					<div class="tit">定位</div>
					<div class="con">
						<input type="radio" name="locate"/><label class="hRadio_Checked">全部</label>
						<?php foreach($finds['Roles'] as $key=>$vo){ ?>
						<input type="radio" name="locate"/><label><?php echo $vo?></label>
                  		<?php } ?>
					</div>
				</div>	
				<div class="tag tag4">
					<div class="tit">版本/时间</div>
					 <div class="con">
						<input type="radio" name="copyright"/><label class="hRadio_Checked"><?php $bbh=$this->get_bbh(); echo $bbh['name']; ?></label>
						<input type="radio" name="copyright"/><label>周</label>
						<input type="radio" name="copyright"/><label>月</label>
					</div>
				</div>						
				<b class="mask"></b>					
			</div>				
		</div>
				
		<!-- 筛选框 结束 -->
		<!-- 加点标题 开始 -->
		<div class="statistics-title">
			<div class="statistics-title-in">
				<h2>加点统计</h2>
				<span class="xwh">本页根据DOTA2官方战报，提供英雄前期加点顺序和最实用技能的统计数据。仅供参考。</span>
			</div>
		</div>
		<!-- 加点标题 结束 -->
		<!-- 加点标签区 开始 -->
		<div class="js-tab pn-hero">
			<div class="bd gb-tab-pn">
				<!-- 详细内容 开始 -->
				<div class="gb-tab-con">
					<div class="pn-detail">
						<div class="pn">
							<div class="pn-bd">								
								<table cellpadding="0" cellspacing="0" border="0" class="table-detail">
									<tr class="title">
										<th class="tit" style="width:130px;">英雄</th>
										<th class="tit">最受欢迎的加点方式</th>
										<th class="tit">最受欢迎优先加满的技能</th>
									</tr>
									<tbody class="count-skill">
									<?php foreach($skillinfo as $key=>$val){ ?>
									<tr>
										<td class="con con-hero">
											<a href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>" target="_self" class="link-hero" title="<?php echo $val['name'];?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo $val['_id'];?>.jpg" class="pic-hero" alt="<?php echo $val['name'];?>"  /><?php echo $val['name'];?></a>
										</td>
										<td class="con">
											<ul class="list clearfix">
												<?php 
												if(!empty($val['ability'])){
													foreach($val['ability'] as $ke=>$va){ ?>
												<li class="link-skill">
													<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $va['_id'];?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $va['_id'];?>.jpg" alt="<?php echo $va['name'];?>" class="pic-skill" /></a>
												</li>
												<?php 
													}
												} ?>
											</ul>	
										</td>
										<td class="con">
											<?php if(!empty($val['yxjm'])){ ?>
											<div class="c1">
												<a class="link-skill" title="<?php echo $val['yxjm']['name'];?>" target="_self" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $val['yxjm']['_id'];?>">
													<img class="pic-skill" alt="<?php echo $val['yxjm']['name'];?>" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $val['yxjm']['_id'];?>.jpg">
												</a>
											</div>
											<div class="c2">
												<label><?php echo $val['total'];?></label>
												<div class="xxt"></div>
											</div>
											<?php } ?>
										</td>
									</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>	
				<!-- 详细内容 结束 -->			
			</div>			
		</div>
		<!-- 加点标签区 结束 -->
	</div>
</div>
<!-- 主体内容 结束 -->