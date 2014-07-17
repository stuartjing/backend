<?php 
$kq = !empty($_REQUEST['q'])?$_REQUEST['q']:''; 
?>
<div class="wrap">
	<!-- 头部 开始 -->
	<div class="header">
		<div class="header-in">
			<div class="top-box">
				<!-- logo 开始 -->
				<div class="logo-box">
					<h1><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros.html" class="logo png" title="回到首页"><?php $bbh=$this->get_bbh(); echo $bbh['name'];?></a></h1>
				</div>
				<!-- logo 结束 -->
				<!-- 搜索框 开始 -->
				<div class="search-wrap">
					<div class="search-box">
						<form name="search_form" method="get" action="<?php echo Yii::app()->request->baseUrl; ?>/search.html" target="_self" class="search-form">
							<input type="text" name="q" id="keyWord" class="search-text" value="<?php if($kq!='搜索英雄、物品' && $kq!=''){echo $kq;}else{?>搜索英雄、物品<?php }?>" onclick="this.value=''"  onFocus="if(this.value=='输入搜索关键字...'){this.value=''}" onkeydown="enterSumbit()"/>
							<!-- <input type="hidden" name="r" value="site/search"/> -->
							<input type="button" class="search-btn" value="" onClick="search_form.submit()"/>
						</form>
					</div>
				</div>
			<!-- 搜索框 结束 -->
			</div>
					<!-- 主导航 开始 -->
			<div class="nav">
				<ul class="nav-in">
					<a name="middle_top" id="middle_top"></a>
					<li class="nav-item nav-item1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/heros.html" class="nav-con" title="英雄">英雄</a></li>
					<li class="nav-item nav-item2"><a href="<?php echo Yii::app()->request->baseUrl; ?>/items.html" class="nav-con" title="物品">物品</a></li>
					<li class="nav-item nav-item3"><a href="<?php echo Yii::app()->request->baseUrl; ?>/analytics.html" target="_self" class="nav-con" title="数据统计">数据统计</a></li>
				</ul>
			</div>
			<!-- 主导航 结束 -->
		</div>
	</div>	
	<!-- 头部 结束 -->	