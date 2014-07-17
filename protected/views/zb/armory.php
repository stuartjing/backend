<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/table.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/armoryjs.js"></script>
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
		<!-- 出装标题 开始 -->
		<div class="statistics-title">
			<div class="statistics-title-in">
			    <h2>出装统计</h2>
				<span class="xwh">本页根据DOTA2官方战报，提供不同类型英雄各个成长阶段出装统计数据。仅供参考。</span>
			</div>
		</div>
		<!-- 出装标题 结束 -->
		<div class="pn pn-hero">
			<div class="pn-in">
				<!-- 符合条件的英雄 开始 -->
				<div class="result-box hero-result-box" style="display: none;">
					<div class="hd">
						<h3 class="tit">符合筛选条件的英雄</h3>
					</div>
					<div class="bd">
						<ul class="hero-list">
							<!--
							<?php foreach($hero['全部_全部_全部'] as $key=>$val){ ?>
							<li class="hero-box">
								<a class="link-hero" title="<?php echo $val['name'];?>" target="_self" href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>">
									<img class="pic-hero" alt="<?php echo $val['name'];?>" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/hero_shot_<?php echo $val['_id'];?>.jpg">
								</a>
							</li>
							<?php }
							if(count($hero['全部_全部_全部'])%20<20 &&count($hero['全部_全部_全部'])%20>0){
								for($i=0;$i<(20-count($hero['全部_全部_全部'])%20);$i++){
									?>
									<li class="hero-box"></li>
									<?php 
								}
							}
							?>-->
						</ul>
					</div>
				</div>
				<!-- 符合条件的英雄 结束 -->
			</div>
		</div>
		
		<!-- 出装标签区 开始 -->
		<div class="pn pn-item">
			<div class="pn-in">
				<!-- 出装统计 开始 -->
				<div class="info item-list">
					<!-- 出装后期,成型,过渡,前期 开始 -->
					<?php 
					$i=1;
					foreach($data['全部_全部_全部'] as $key=>$val){ 
					//print_r($val);exit;
					?>
					<div class="col col<?php echo $i;?>">
						<div class="col-in">
							<div class="hd">
								<h3 class="tit" align="center"><?php echo $key;?></h3>
							</div>
							<div class="bd">
								<ul class="list">
									<?php foreach($val as $ke=>$va){ ?>
									<li class="item">
										<div class="c1">
											<a class="link-item" title="<?php echo $va['name'];?>" target="_self" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $va['itemId'];?>.html" tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $va['_id']?>">
												<img class="pic-item" alt="<?php echo $va['name'];?>" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $va['icon'];?>">
											</a>
										</div>
										<div class="c2 <?php if($i==1){echo "c2-hq";}elseif($i==2){echo "c2-cx";}elseif($i==3){echo "c2-gd";}elseif($i==4){echo "c2-qq";} ?> ">
											<label><?php echo $va['sumcount'];?></label>
											<div class="xxt"></div>
										</div>
									</li>	
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<?php 
					$i++;
					} ?>
				</div>
				<!-- 出装统计 结束 -->
			</div>
		</div>
		<!-- 出装标签区 结束 -->
		
	</div>
</div>
<!-- 主体内容 结束 -->