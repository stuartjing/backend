function pageScroll(){
    window.scrollBy(0,-100);
    scrolldelay = setTimeout('pageScroll()',0);
    var sTop=document.documentElement.scrollTop+document.body.scrollTop;
    if(sTop==0) clearTimeout(scrolldelay);
}
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
	//qs-pop
	$(".qs-pop").click(function(){
		getHeroImgList();
		$(".white_content").show();
		$(".black_overlay").show();
	});
	$(".pn-close").click(function(){
		$(".white_content").hide();
		$(".black_overlay").hide();
	});
	
	//screenshot-box
	$(".hero-pic-box").mouseover(function(){
		$(this).find(".screenshot-box").show();
	});
	$(".hero-pic-box").mouseout(function(){
		$(this).find(".screenshot-box").hide();
	});
	
	//screenshot-tips
	$(".btn-screenshot").click(function(){
		$(".screenshot-tips").show();
		$(".screen-mask").show();
	});	
	$(".screenshot-tips .bt-close").click(function(){
		$(".screenshot-tips").hide();
		$(".screen-mask").hide();
	});
	
	//TAB
	$(".js-tab").each(function(){
		$(".gb-tab:eq(0)",$(this)).tabs($(".gb-tab-pn:eq(0) > div",$(this)),{event:'click'});
	});
		
	//hstory
	$(".hstory-article .bt-all").click(function(){
		var height = $(".hstory-article .article").show().height();
		$(".hstory-article .article").hide();
		$(".hstory-article .intro1").hide();
		$(".hstory-article .article").css({height:'110px'}).show().animate({height:height},500);
	});
	$(".hstory-article .bt-short").click(function(){
		 $(".hstory-article .article").animate(
	       {height:"110px"},
		   500,function(){$(this).hide().css({height:""}).parent().find(".intro1").show();});
	});
	
	//tag-box
	$(".strategy-tj .tag-box .tag-box-in .link").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
		var tj_time = $(this).html();
		data = 'numId='+numId+'&dvs='+tj_time;
		$.ajax({
			type:"POST",
			data:data,
			async:false,	//同步
			url:host+"/ajax/Index.html",
			success:function(data){
				var json = eval('('+data+')');
				if(json.skill==''){
					$(".skill-top").html('<div class="hd" style="text-align:center;"><h3>暂无数据</h3></div>');
				}else{
					$(".skill-top").html(json.skill);
				}
				//优先加满
				if(json.yxjm==''){
					$(".skill-yxjm").html('<div class="hd" style="text-align:center;"><h3>暂无数据</h3></div>');
				}else{
					$(".skill-yxjm").html(json.yxjm);
				}
				$(".info-cztj").html(json.cz);
				itemxxt();
				skillxxt();
				WowLoad();
			}
		});
	});
	$(".pn-skill1-yanshi").click(function(){
		var video = $(this).find("#video").val();
		if(video!=''){
			var flashvars = "<object id='video_show' width='698' height='392' type='application/x-shockwave-flash' name='video_show' data='http://www.wanmei.com/public/swf/player_v2.swf' style='visibility: visible; background: none repeat scroll 0% 0% rgb(0, 0, 0);'><param name='allowfullscreen' value='true'><param name='wmode' value='window'><param name='allowscriptaccess' value='always'><param name='bgcolor' value='0x000000'><param name='flashvars' class='flashvars' value='__objectID=video_show&__url=http://db.dota2.com.cn/hero&source=http://dota2.dl.wanmei.com/dota2/video/abilities/"+video+".flv&autoPlay=true&repeat=true&skinMode=hide&configPath=http://www.wanmei.com/public/swf/player_config.xml'></object>";
			$(".pop_sp").html(flashvars);
		}else{
			$(".pop_sp").html('<div style="color:#777777; font-size:40px; text-align:center; font-weight:bold; margin-top:150px;">敬请期待</div>');
		}
		$(".pop_layer").show();
		$(".pop_layer_overlay").show();		
	});	
	$(".pop_close").click(function(){
		
		$(".pop_layer").hide();
		$(".pop_layer_overlay").hide();			
	});	
		
		
	//basic-info
	$(".basic-info .bt-all").click(function(){
		var height = $(".basic-info .article").show().height();
		$(".basic-info .article").hide();
		$(".basic-info .intro").hide();
		$(".basic-info .article").css({height:'144px'}).show().animate({height:height},500);
	});
	$(".basic-info .bt-short").click(function(){
		 $(".basic-info .article").animate(
	       {height:"144px"},
		   500,function(){$(this).hide().css({height:""}).parent().find(".intro").show();});
	});
	
	//strategy-tj li
	$(".strategy-tj .gb-tab").find("li:first").addClass("first");
	$(".strategy-tj .gb-tab").find("li:last").addClass("last");
		//strategy-tj li
	$(".strategy-tj .tag-box-in").find("a:first").addClass("first");
	$(".strategy-tj .tag-box-in").find("a:last").addClass("last");
	
	$(".strategy-qs .tag-box-in").find("a:first").addClass("first");
	$(".strategy-qs .tag-box-in").find("a:last").addClass("last");
	
	//skill-zone
	$(".skill-zone").find("li:last").addClass("last");
	
	function formatDate(now){
		var year = now.getFullYear();   
		var month = now.getMonth()+1;   
		var date = now.getDate();  
		var time = year;
		if(month < 10)
			time += "0";
		time += month;
		if(date < 10)
			time += "0";
		time += date;
		return time;
	}

});

$(document).ready(function(){
	//slider
	$("#rang_input").rangeinput({
        value: 1,
        step: 1,
        onSlide: function (event, step)  {
			//力量=初始力量（1级时的）+[每等级提升力量值+（上级截余小数）]取整
			var rang = $("#rang_input").val()-1;
			//力量
			var lg = parseInt(AttributeBaseStrength+rang*AttributeStrengthGain);
			$(".skill3").text(lg);
			//生命
			var sm = 150+lg*19;
			$(".skill1").text(sm);
			//敏捷
			var mj = parseInt(AttributeBaseAgility+rang*AttributeAgilityGain);
			$(".skill4").text(mj);
			//智力
			var zl = parseInt(AttributeBaseIntelligence+rang*AttributeIntelligenceGain);
			$(".skill5").text(zl);
			//魔法
			var mf = zl*13;
			$(".skill2").text(mf);
			//初始攻击
			var zsx = '';
			if(AttributePrimary=='力量'){
				zsx = AttributeStrengthGain;
			}else if(AttributePrimary=='敏捷'){
				zsx = AttributeAgilityGain;
			}else if(AttributePrimary=='智力'){
				zsx = AttributeIntelligenceGain;
			}
			var min = parseInt(level_1_ap_min+rang*zsx);
			var max = parseInt(level_1_ap_max+rang*zsx);
			csgj = parseInt((min+max)/2);
			$(".skill6").text(csgj);
			//初始护甲
			var cshj = parseInt(level_1_armor-AttributeBaseAgility/7+mj/7);
			$(".skill7").text(cshj);
        }
    });
	
	//screenshot-tips
	var ct = $('[data-ui-control="Slide"]');
	el = ct.find('.focus-thumb-item');
	el.click(function() {
		var i = $(this).index() + 1;
		ct.find('.num .txt').text(i);
	});
	ct.find('[data-ui-mark="prev"]').click(function() {
		var n = parseInt(ct.find('.num .txt').text());
		if(n==1) n=5;
		ct.find('.num .txt').text( +n - 1);
	});
	ct.find('[data-ui-mark="next"]').click(function() {
		var n = parseInt(ct.find('.num .txt').text());
		if(n==4) n=0;
		ct.find('.num .txt').text( +n + 1);
	});
	
	//screenshot-tips
	$(".screen-mask").height($(document.body).height()); 
	$(".screen-mask").width($(window).width());
	$(".screenshot-tips").css('left',parseInt($(window).width())/2-309+'px');
	
	
	//con-xxt c2 出装统计
	
	itemxxt();
	skillxxt();
});
function itemxxt(){
	//前期
	var imgNum1=$(".list .c2-qq label").length;//测英雄总数，用来循
	var maxNum1=0;
	for(var i=0;i <imgNum1;i++){
		var num1=$(".list .c2-qq label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNum1)<eval(num1)){
			maxNum1=num1;
		}
	}
	for(var j=0;j <imgNum1;j++){
		var num2=$(".list .c2-qq label").eq(j).html();//测出每个英雄的出场数
		var t1=num2*(75/maxNum1);
		$(".list .c2-qq .xxt").eq(j).width(t1);//控制血条宽度
	}
	//过度
	var imgNumgd=$(".list .c2-gd label").length;//测英雄总数，用来循
	var maxNumgd=0;
	for(var i=0;i <imgNumgd;i++){
		var numgd=$(".list .c2-gd label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumgd)<eval(numgd)){
			maxNumgd=numgd;
		}
	}
	for(var j=0;j <imgNumgd;j++){
		var numgd1=$(".list .c2-gd label").eq(j).html();//测出每个英雄的出场数
		var tgd=numgd1*(75/maxNumgd);
		$(".list .c2-gd .xxt").eq(j).width(tgd);//控制血条宽度
	}
	//成型
	var imgNumcx=$(".list .c2-cx label").length;//测英雄总数，用来循
	var maxNumcx=0;
	for(var i=0;i <imgNumcx;i++){
		var numcx=$(".list .c2-cx label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumcx)<eval(numcx)){
			maxNumcx=numcx;
		}
	}
	for(var j=0;j <imgNumcx;j++){
		var numcx1=$(".list .c2-cx label").eq(j).html();//测出每个英雄的出场数
		var tcx=numcx1*(75/maxNumcx);
		$(".list .c2-cx .xxt").eq(j).width(tcx);//控制血条宽度
	}
	//后期
	var imgNumhq=$(".list .c2-hq label").length;//测英雄总数，用来循
	var maxNumhq=0;
	for(var i=0;i <imgNumhq;i++){
		var numhq=$(".list .c2-hq label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumhq)<eval(numhq)){
			maxNumhq=numhq;
		}
	}
	for(var j=0;j <imgNumhq;j++){
		var numhq1=$(".list .c2-hq label").eq(j).html();//测出每个英雄的出场数
		var thq=numhq1*(75/maxNumhq);
		$(".list .c2-hq .xxt").eq(j).width(thq);//控制血条宽度
	}
}
function skillxxt(){
	var imgNum=$(".skill-list .c21 label").length;//测英雄总数，用来循环
	//var maxNum=$(".table-detail .c2 label").eq(0).html();//测出最多的胜率
	var maxNum1=0;
	for(var j=0;j <imgNum;j++){
		var num=$(".skill-list .c21 label").eq(j).html();
		var numInt=parseInt(num);//获取胜率的整数
		if(maxNum1<numInt){
			maxNum1=numInt;
		}
	}
	for(var i=0;i <= imgNum;i++){
		var num=$(".skill-list .c21 label").eq(i).html();//测出每个英雄的胜率
		var numInt1=parseInt(num);//获取胜率的整数
		var t=numInt1*(500/maxNum1);
		$(".skill-list .c21 .xxt").eq(i).width(t);//控制血条宽度
	};
}