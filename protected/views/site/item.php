<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/filteritem.js"></script>
<input type="hidden" class="getTitle" value="<?php echo $getTitle?>" />
	<!-- 主体内容 开始 -->
	<div class="content">
		<div class="content-in">
			<!-- 筛选框 开始 -->
			<div class="filter-box">
				<div class="filter-box-in">
					<div class="tag tag1">
						<div class="tit">分类</div>
						<ul class="con">
							<?php 
							foreach($finds['Category'] as $key=>$vo){ 
								$len = strlen($vo);
							?>
							<li class="item <?php if($len>6){?>item-m<?php }?>">
								<a href="#" class="link" title="<?php echo $vo?>"><?php echo $vo?></a>
								<div class="box">
									<div class="close"></div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
					<div class="tag tag2">
						<div class="tit">标签</div>
						<ul class="con">
							<?php 
							foreach($ShopTags as $key=>$vo){ 
								if (in_array($vo,$finds['ItemShopTags'])){
									$len = strlen($vo);
							?>
							<li class="item <?php if($len>6){?>item-l<?php }?>">
								<a href="#" class="link" title="<?php echo $vo?>"><?php echo $vo?></a>
								<div class="box">									
									<div class="close"></div>
								</div>
							</li>
							<?php } }?>					
						</ul>
					</div>					
					<b class="mask"></b>					
				</div>				
			</div>
			<div class="control-box">
				<div class="control-box-in">
					<div class="bt-control"><i class="ico ico-control"></i><span class="txt">收起</span></div>
				</div>					
			</div>			
			<!-- 筛选框 结束 -->
			
			<a class="middle_top" name="middle_top" id="item_rapier"></a>
			<!-- 物品 开始 -->
			<div class="pn pn-item">
				<div class="pn-in">
					<!-- 物品属性 开始 -->
					<div class="info">
						<a id="info"></a>
						<!-- 物品进阶 开始 -->
						<div class="col col1">
							<div class="col-in">
								<div class="hd">
									<h3 class="tit">物品进阶</h3>
								</div>
								<div class="bd icon-item-fc">
									<ul class="list">
										<?php 
										if($item_info['MaterialOf']){
											foreach($item_info['MaterialOf'] as $key=>$val){?>
										<li class="item">
											<div class="link-item">
												<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
												<input type="hidden" class="get-item-id" value="<?php echo $val['id']?>" />
												<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" />
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
											</div>
											<div class="con"><?php echo $val['name'];?></div>
										</li>
										<?php 
											}
										}?>									
									</ul>
								</div>
							</div>
						</div>
						<!-- 物品进阶 结束 -->
						<!-- 合成所需 开始 -->
						<div class="col col2">
							<div class="col-in">
								<div class="hd">
									<h3 class="tit">合成所需</h3>
								</div>
								<div class="bd icon-item-fc">
									<ul class="list">
										<?php 
										if($item_info['Materials']){
											foreach($item_info['Materials'] as $key=>$val){?>
										<li class="item">
											<div class="link-item">
												<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
												<input type="hidden" class="get-item-id" value="<?php echo $val['id']?>" />
												<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" />
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
											</div>
											<div class="con"><?php echo $val['name'];?></div>
										</li>
										<?php 
											}
										}?>
									</ul>
								</div>
							</div>
						</div>
						<!-- 合成所需 结束 -->
						<!-- 主动 开始 -->
						<div class="col col3">
							<div class="col-in">
								<div class="mod-info">
									<div class="hd">
										<h3 class="tit">物品技能</h3>
									</div>
									<div class="bd">
									<?php if($item_info['Description']){?>
										<p><?php echo $item_info['Description'];?></p>
									<?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- 主动 结束 -->
						<!-- 属性 开始 -->
						<div class="col col4">
							<div class="col-in">
								<div class="hd">
									<h3 class="tit">属性</h3>
								</div>
								<div class="bd">
									<?php if($item_info['Lines']){?>
									<div class="argument">
										<?php foreach($item_info['Lines'] as $key=>$val){?>
										<p><?php echo $val;?></p>
										<?php }?>
									</div>
									<?php }?>
									<div class="argument">
										<?php if($item_info['AbilityManaCost']){?>
										<p class="txt1">魔法消耗 <?php echo $item_info['AbilityManaCost'];?></p>
										<?php }?>
										<?php if($item_info['AbilityCooldown']){?>
										<p class="txt2">冷却时间 <?php echo $item_info['AbilityCooldown'];?></p>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- 属性 结束 -->
						<!-- 物品简介 开始 -->
						<div class="item-info">
							<div class="hd">
								<div class="pic-box">
									<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $item_info['icon'];?>" alt="<?php echo $item_info['name'];?>" class="pic" />
								</div>
								<div class="definition">
									<h2 class="tit"><?php echo $item_info['name'];?></h2>
									<div class="price">总价<span class="num"><?php echo $item_info['RealCost'];?></span></div>
								</div>
							</div>
							<div class="bd">
								<div><?php if(isset($item_info['俗称'])) { echo "俗称：".$item_info['俗称'];}?></div>
								<div class="intro"><?php echo $item_info['Lore'];?></div>
							</div>
						</div>
						<!-- 物品简介 结束 -->
					</div>
					<!-- 物品属性 结束 -->
					<!-- 物品图标 开始 -->
					<div class="icon-box">
						<div class="icon-box-in clearfix">						
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon1.png" alt="" class="pic" /></div>
								<div class="tit">消耗品</div>	
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '消耗品'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon2.png" alt="" class="pic" /></div>
								<div class="tit">属性</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '属性'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>						
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon2.png" alt="" class="pic" /></div>
								<div class="tit">军备</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '军备'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon2.png" alt="" class="pic" /></div>
								<div class="tit">奥术</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '奥术'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon3.png" alt="" class="pic" /></div>
								<div class="tit">普通</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '普通'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon4.png" alt="" class="pic" /></div>
								<div class="tit">辅助</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '辅助'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>	
								</ul>
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon4.png" alt="" class="pic" /></div>
								<div class="tit">法器</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '法器'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon5.png" alt="" class="pic" /></div>
								<div class="tit">武器</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '武器'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>	
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon6.png" alt="" class="pic" /></div>
								<div class="tit">防具</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '防具'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>	
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon7.png" alt="" class="pic" /></div>
								<div class="tit">圣物</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '圣物'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>	
							</div>
							<div class="icon-item icon-item-fc">
								<div class="pic-box"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon8.png" alt="" class="pic" /></div>
								<div class="tit">神秘</div>
								<ul class="list clearfix">
									<?php 
									foreach($data as $key=>$val){ 
										if($val['Category'] == '神秘商店'){
									?>
									<li class="item">
										<div class="link-item">
											<a tipurl="<?php echo Yii::app()->request->baseUrl; ?>/item/<?php echo $val['_id']?>" href="<?php echo Yii::app()->request->baseUrl; ?>/items/<?php echo $val['itemId'];?>.html" target="_self">
											<!--input type="hidden" class="get-item-id" value="<?php echo $val['_id']?>" />
											<input type="hidden" class="get-item-name" value="<?php echo $val['name']?>" /-->
											<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-item" /></a>
										</div>
										<div class="pic-tips">
											<div class="pic-tips-in">
												<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" class="pic-b" />
											</div>
										</div>
									</li>
									<?php 
										}
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<!-- 物品图标 结束 -->
				</div>
			</div>
			<!-- 物品 结束 -->
		</div>
	</div>
	<!-- 主体内容 结束 -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/itemdata.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/itemjs.js"></script>