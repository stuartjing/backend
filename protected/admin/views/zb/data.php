<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/table.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/datajs.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/data.js"></script>
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
						<input type="radio" class="con-dianji" name="count_type"/><label class="hRadio_Checked">全部</label>
						<?php foreach($finds['AttributePrimary'] as $key=>$vo){ ?>
						<input type="radio" class="con-dianji" name="count_type"/><label><?php echo $vo?></label>
                  		<?php } ?>
					</div>
				</div>
				<div class="tag tag2">
					<div class="tit">攻击</div>
					<div class="con">
						<input type="radio" class="con-dianji" name="attack"/><label class="hRadio_Checked">全部</label>
						<?php foreach($finds['AttackCapabilities'] as $key=>$vo){ ?>
						<input type="radio" class="con-dianji" name="attack"/><label><?php echo $vo?></label>
                  		<?php } ?>
					</div>
				</div>
				<div class="tag tag3">
					<div class="tit">定位</div>
					<div class="con">
						<input type="radio" class="con-dianji" name="locate"/><label class="hRadio_Checked">全部</label>
						<?php foreach($finds['Roles'] as $key=>$vo){ ?>
						<input type="radio" class="con-dianji" name="locate"/><label><?php echo $vo?></label>
                  		<?php } ?>
					</div>
				</div>	
				<div class="tag tag4">
					<div class="tit">版本/时间</div>
					 <div class="con">
						<input type="radio" class="con-dianji" name="copyright"/><label class="hRadio_Checked"><?php $bbh=$this->get_bbh(); echo $bbh['name']; ?></label>
						<input type="radio" class="con-dianji" name="copyright"/><label>周</label>
						<input type="radio" class="con-dianji" name="copyright"/><label>月</label>
					</div>
				</div>						
				<b class="mask"></b>
			</div>				
		</div>
				
		<!-- 筛选框 结束 -->
		<!-- 数据标题 开始 -->
		<div class="statistics-title">
			<div class="statistics-title-in">
			    <h2>数据统计</h2>
				<span class="xwh">本页根据DOTA2官方战报，提供英雄各个战报数据。仅供参考。 例：助攻指数为假设该英雄达到25级时场均助攻数。其他指标类似。</span>
			</div>
		</div>
		<!-- 数据标题 结束 -->
		<!-- 数据标签区 开始 -->
		<div class="js-tab pn-hero">
			<div class="bd gb-tab-pn">
				<!-- 详细内容 开始 -->
				<div class="gb-tab-con">
					<div class="pn-detail">
						<div class="pn">
							<div class="pn-hd">
								<div class="tag-box">
									<div class="tag-box-in">
										<a href="javascript:void(0);" class="link current" title="出场胜率">出场胜率</a><a href="javascript:void(0);" class="link" title="击杀助攻">击杀助攻</a><a href="javascript:void(0);" class="link" title="补刀经验">补刀经验</a>
									</div>
								</div>
							</div>
							<div class="pn-bd">								
								<table cellpadding="0" cellspacing="0" border="0" class="table-detail table-ccsl">
									<tr class="title">
										<th class="tit" style="width:130px">英雄</th>
										<th class="tit" onclick="Table.sortBy('count',1,'winning', 2);">出场数<i class="ico ico-arrow"></i></th>
										<th class="tit" onclick="Table.sortBy('winning',1,'winning', 2);">胜率<i class="ico ico-arrow"></i></th>
									</tr>
									<tbody class="count-winning">
									<?php foreach($heroinfo as $key=>$val){ ?>
									<tr>
										<td class="con con-hero"><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>" target="_self" class="link-hero" title="<?php echo $val['name'];?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo $val['_id'];?>.jpg" class="pic-hero" alt="<?php echo $val['name'];?>"  /><?php echo $val['name'];?></a></td>
										<td class="con">
										   <div class="c21">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['count'];?></label>
												</div>
											</div>
										</td>
										<td class="con">
											 <div class="c2">
												<div class="tit-c2">
													<div class="xxt"></div>
												</div>
												<div class="xx-label">
													<label><?php echo $val['winning'];?>%</label>
												</div>
											</div>
										</td>
									</tr>
									<?php } ?>
									</tbody>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table-detail table-jszg" style="display:none;">
									<tr class="title">
										<th class="tit" style="width:130px">英雄</th>
										<th class="tit" onclick="Table.sortBy('kills',1,'assists', 2);">杀人指数<i class="ico ico-arrow"></i></th>
										<th class="tit" onclick="Table.sortBy('assists',1,'assists', 2);">助攻指数<i class="ico ico-arrow"></i></th>
										<th class="tit" onclick="Table.sortBy('deaths',1,'assists', 2);">被杀指数<i class="ico ico-arrow"></i></th>
									</tr>
									<tbody class="kill-assists">
									<?php foreach($heroinfo as $key=>$val){ ?>
									<tr>
										<td class="con con-hero"><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>" target="_self" class="link-hero" title="<?php echo $val['name'];?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo $val['_id'];?>.jpg" class="pic-hero" alt="<?php echo $val['name'];?>"  /><?php echo $val['name'];?></a></td>
										<td class="con">
										   <div class="c21 srzs">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['kills'];?></label>
												</div>
											</div>
										</td>
										<td class="con">
										   <div class="c21 tgzs">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['assists'];?></label>
												</div>
											</div>
										</td>
										<td class="con">
										   <div class="c21 bszs">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['deaths'];?></label>
												</div>
											</div>
										</td>
									</tr>
									<?php } ?>
									</tbody>
								</table>
								<table cellpadding="0" cellspacing="0" border="0" class="table-detail table-bdjy" style="display:none;">
									<tr class="title">
										<th class="tit" style="width:130px">英雄</th>
										<th class="tit" onclick="Table.sortBy('last_hits',1,'denies', 2);">正补指数<i class="ico ico-arrow"></i></th>
										<th class="tit" onclick="Table.sortBy('denies',1,'denies', 2);">反补指数<i class="ico ico-arrow"></i></th>
										<th class="tit" onclick="Table.sortBy('gold_per_min',1,'denies', 2);">场均打金/分钟<i class="ico ico-arrow"></i></th>
										<th class="tit" onclick="Table.sortBy('xp_per_min',1,'denies', 2);">场均经验/分钟<i class="ico ico-arrow"></i></th>
									</tr>
									<tbody class="hits-denies">
									<?php foreach($heroinfo as $key=>$val){ ?>
									<tr>
										<td class="con con-hero"><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>" target="_self" class="link-hero" title="<?php echo $val['name'];?>"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo $val['_id'];?>.jpg" class="pic-hero" alt="<?php echo $val['name'];?>"  /><?php echo $val['name'];?></a></td>
										<td class="con">
										   <div class="c21 zbzs">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['last_hits'];?></label>
												</div>
											</div>
										</td>
										<td class="con">
										   <div class="c21 fbzs">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['denies'];?></label>
												</div>
											</div>
										</td>
										<td class="con">
										   <div class="c21 cjdj">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['gold_per_min'];?></label>
												</div>
											</div>
										</td>
										<td class="con">
										   <div class="c21 cjjy">
												<div class="xxt"></div>
												<div class="xx-label ">
													<label><?php echo $val['xp_per_min'];?></label>
												</div>
											</div>
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
		<!-- 数据标签区 结束 -->
	</div>
</div>
<!-- 主体内容 结束 -->