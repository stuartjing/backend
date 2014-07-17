
<input type="hidden" class="getTitle" value="<?php echo $getTitle?>" />
	
	<!-- 主体内容 开始 -->
	<div class="content">
		<div class="content-in">
			<!-- 搜索结果 开始 -->
			<div class="pn pn-search">
				<div class="pn-in">					
					<div class="prompt"><span class="name">“<?php if($keyWord!='搜索英雄、物品'){echo $keyWord;}?>”</span>的搜索结果</div>
					<div class="result-box hero-result-box">
						<div class="hd">
							<h2 class="tit">英雄</h2>
							<div class="more"><span class="num"><?php echo count($rs['hero']);?></span>个符合条件</div>
						</div>
						<div class="bd">
							<?php if($rs['hero']){?>
							<ul class="hero-list">
								<?php 
								$i=1;
								foreach($rs['hero'] as $key=>$val){
								?>
								<li class="hero-con <?php if($i%2==0){?> li-odd<?php }?>">
									<div class="line"></div>
									<div class="hero-box">
										<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id']?>.html" target="_self" title="<?php echo $val['name']?>" class="link-hero">
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/hero/hero_shot_<?php echo $val['_id'];?>.jpg" alt="<?php echo $val['name']?>" class="pic-hero" />
											<input type="hidden" class="get-hero-id" value="<?php echo $val['_id']?>" />
										</a>
										<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/hero/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/heros/<?php echo $val['_id']?>.html" target="_self" class="txt" title="<?php echo $val['name']?>"><?php echo str_replace($keyWord,'<span class="highlight">'.$keyWord.'</span>',$val['name']);?></a>
										<span class="mask2"></span>
									</div>
									<?php 
									if($val['Abilities']){
										foreach($val['Abilities'] as $key=>$val){
											if($val['maxlevel']>1){
									?>
									<div class="skill-box <?php if($keyWord!='' && (strpos($val['Description'],$keyWord)===false && strpos($val['name'],$keyWord)===false && strpos(implode('',$val['lines']),$keyWord)===false)){?>unselected<?php }?>">
										<div class="link-skill">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/skill/<?php echo $val['id']?>">
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $val['id'];?>.jpg" alt="<?php echo $val['name'];?>" class="pic-skill" />
											<input type="hidden" class="get-skill-id" value="<?php echo $val['id']?>" /></a>
										</div>
										<div class="txt"><?php echo str_replace($keyWord,'<span class="highlight">'.$keyWord.'</span>',$val['name']);?></div>
									</div>
									<?php }}
									}?>
								</li>
								<?php 
									$i++;
								}?>																						
							</ul>
							<?php }else{?>
							<div class="txt-search">没有符合条件的英雄</div>
							<?php } ?>	
						</div>
					</div>
					<div class="result-box">
						<div class="hd">
							<h2 class="tit">物品</h2>
							<div class="more"><span class="num"><?php echo count($rs['item']);?></span>个符合条件</div>
						</div>
						<div class="bd">
							<?php if($rs['item']){?>
							<ul class="item-list">
								<?php 
								foreach($rs['item'] as $key=>$val){?>
								<li class="item-con">
									<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self" title="<?php echo $val['name'];?>" class="link-item">
										<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" />
										<input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
										<span class="txt"><?php echo str_replace($keyWord,'<span class="highlight">'.$keyWord.'</span>',$val['name']);?></span>
									</a>
								</li>
								<?php }?>
							</ul>
							<?php }else{?>
							<div class="txt-search">没有符合条件的物品</div>
							<?php } ?>
						</div>
					</div>					
					<b class="mask"></b>
				</div>
			</div>			
			<!-- 搜索结果 结束 -->			
		</div>
	</div>
	<!-- 主体内容 结束 -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/searchjs.js"></script>