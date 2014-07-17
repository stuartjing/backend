<input type="hidden" class="getTitle" value="<?php echo $getTitle;?>">
<!-- 主体内容 开始 -->
<div class="content">
	<div class="content-in">
		<!-- 场数统计 开始 -->
		<div class="filter-box">
			<div class="filter-box-in">
				<div class="tag tag1">
					<div class="con">
						<a class="item">上周<strong><?php echo $res['week']['sumcount'];?></strong>场</a>
						<a class="item">上月<strong><?php echo $res['month']['sumcount'];?></strong>场</a>
						<a class="item"><?php $bbh=$this->get_bbh(); echo $bbh['name']; ?><strong><?php echo $res['bbh']['sumcount'];?></strong>场</a>
					</div>
				</div>
				<b class="mask"></b>
			</div>
		</div>
		<!-- 场数统计 结束 -->
		<!-- 统计 开始 -->
		<div class="pn pn-item">
			<div class="pn-in">
				<!-- 统计 开始 -->
				<div class="info">
					<a id="info"></a>
					<!-- 加点统计 开始 -->
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/analytics/skill.html" target="_self">
					<div class="col col1" style="cursor:pointer;">
						<div class="col-in">
							<div class="photo">
								<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/ssh3.png" alt="" height="290" width="290" />
							</div>
							<div class="bd">
								<h2>加点统计</h2>
								 <samp>本周最多加满</samp>
								 <div class="icon_bj" title="<?php echo $info['jm']['name'];?>">
									<img class="tp" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/ability_<?php echo $info['jm']['_id'];?>.jpg" alt="<?php echo $info['jm']['name'];?>"    height="88" width="88" />
									<img class="bj" src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon_bj.png" alt="" height="88" width="88"/>
								 </div>
							</div>
						</div>
					</div>
					</a>
					<!-- 加点统计 结束 -->
					<!-- 出装统计 开始 -->
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/analytics/armory.html" target="_self">
					<div class="col col2" style="cursor:pointer;">
						<div class="col-in">
							<div class="photo">
								<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/ssh2.png" alt="" height="290" width="290" />
							</div>
							<div class="bd">
								<h2>出装统计</h2>
								 <samp>本周装备最多</samp>
								 <div class="icon_bj" title="<?php echo $info['zb']['name'];?>">
									<img class="tp" src="<?php echo Yii::app()->params->imgUrl; ?>/images/data/<?php echo $info['zb']['icon'];?>" alt="<?php echo $info['zb']['name'];?>" title="" height="88" width="88" />
									<img class="bj" src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon_bj.png" alt="" height="88" width="88"/>
								 </div>
							</div>
						</div>
					</div>
					</a>
					<!-- 出装统计 结束 -->
					<!-- 数据统计 开始 -->
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/analytics/data.html" target="_self">
					<div class="col col3" style="cursor:pointer;">
						<div class="col-in">
							<div class="mod-info">
								<div class="photo">
									<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/ssh1.png" alt="" height="290" width="290" />
								</div>
								<div class="bd">
									<h2>数据统计</h2>
									<samp>本周胜率最高</samp>	
									<div class="icon_bj" title="<?php echo $info['sl']['name'];?>">
										<img class="tp" src="<?php echo Yii::app()->params->imgUrl; ?>/images/hero_circle/hero_shot_<?php echo $info['sl']['_id'];?>.png" alt="<?php echo $info['sl']['name'];?>" height="88" width="88" />
										<img class="bj" src="<?php echo Yii::app()->params->imgUrl; ?>/images/icon_bj.png" alt="" height="88" width="88"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					</a>
					<!-- 数据统计 结束 -->
				</div>
				<!-- 统计 结束 -->
				<div class="explain">
					<div class="explain-box">
						<div class="explain-top">
							<img src="<?php echo Yii::app()->params->imgUrl; ?>/images/explainx.jpg" />
						</div>
						<div class="explain-center">
							<span class="expwz">点击左上角“控制台”，选择“游戏”选项，启用“共享比赛历史”</span>
							<span class="exptb"></span>
						</div>
						<div class="explain-bottom"><img src="<?php echo Yii::app()->params->imgUrl; ?>/images/exptp.jpg" /></div>
					</div>
				</div>
			</div>
		</div>
		<!-- 统计 结束 -->
	</div>
</div>
<!-- 主体内容 结束 -->
<script type="text/javascript">
$(function(){	  
	//search-box
	$(".search-box").click(function(){
		$(this).addClass("current");
	});	
	$(".search-text").blur(function(){
  		$(this).parent().parent().removeClass("current");
	});
	
	//topbar
	$(".topbar-control-box").click(function(){
		$(".topbar .topbar-in").slideToggle(500);
		if(!$(this).hasClass("retract")){			
			$(this).addClass("retract");
		}else{			
			$(this).removeClass("retract");	
		};
	});
	$(".explain-center").click(function(){
		if(!$(".explain-bottom").hasClass("explain_retract")||!$(this).hasClass("retract")){		
			$(".explain-bottom").show();	
			$(".explain-bottom").addClass("explain_retract");
			$(this).addClass("retract");
			$(document).scrollTop(1000);
			
		}else{		
			$(".explain-bottom").hide();	
			$(".explain-bottom").removeClass("explain_retract");
			$(this).removeClass("retract");		
		};
	});

	//history-box
	var is_show = false;
	$(".history-box").find("li:first").addClass("first");
	$(".history-box").mouseenter(function(){		
	   if(is_show) return;
	   is_show = true;
       $(this).find(".list").animate(
	       {height:"show"},
		   500);
	});
	$(".history-box").mouseleave(function(){	
     	$(this).find(".list").animate(
		    {height:"hide"},
			500,
			function() {
			    is_show = false;
			});       		
	});

});
</script>