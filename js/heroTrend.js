window.onload=function(){
	var flashvars = {};
	var params = {wmode:"transparent",wmode:"Opaque"};
	var attributes = {};
	attributes.id = "swf01"; 
	swfobject.embedSWF(host+"/js/flash/heroChart.swf", "pn-bd", "710", "422", "9.0.115", "expressInstall.swf", flashvars,params,attributes);
	}
$(function(){
	
	$(".strategy-qs .tag-box .tag-box-in .link").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
		getHeroInfo();
	});
	$(".strategy-info .gb-tab .gb-tab-item:eq(2)").click(function(){
		getHeroInfo();
	});
});

/**
 * 获取英雄图标列表
 */
function getHeroImgList()
{
	if($.trim($(".white_content .gb-tab-con .pn-pic").html())==''){
		$.post(host+"/trend/getImg.html",{},function(callback){
			$(".white_content .gb-tab-con .pn-pic").html(callback);
		})
	}
}
function closeClick()
{
	$(".white_content").hide();
	$(".black_overlay").hide();
}
function setHero2(numId)
{
	$("#hero2").val(numId);
	closeClick();
	getHeroInfo();
}
/**
 * 获取英雄数据信息
 */
function getHeroInfo()
{
	var date = $(".strategy-qs .tag-box-date").find(".current").html();
	var type = $(".strategy-qs .tag-box-type").find(".current").html();
	var hero1 = $("#hero1").val();
	var hero2 = $("#hero2").val();
	$.post(host+"/trend.html",{"date":date, "type":type, "hero1":hero1, "hero2":hero2}, function(callback){
		 swfobject.getObjectById("swf01").freshFlashChart(callback); 
	});
}