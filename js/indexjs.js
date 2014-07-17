$(function(){
	//search-box
	$(".search-box").click(function(){
		$(this).addClass("current");
	});	
	$(".search-text").blur(function(){
  		$(this).parent().parent().removeClass("current");
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
			300,
			function() {
			    is_show = false;
			});       		
	});
	//图标，鼠标放上去，英雄头像亮
	$(".unselected").mouseover(function(){
		$(this).removeClass("unselected");
	});
	$(".unselected").mouseout(function(){
		$(this).addClass("unselected");
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
	//filter-box
	$(".filter-box .item").click(function(){
		if(!$(this).hasClass('current')){
			//选中
			$(this).addClass("current");		
			$(this).mouseover(function(){
				$(this).find(".box").addClass("hover");
			});	
			$(this).mouseout(function(){
				$(this).find(".box").removeClass("hover");
			});
		}else{
			//取消选中
			$(this).removeClass("current");
		}
		filterData();
	});	
	
	//TAB
	$(".js-tab").each(function(){
		$(".gb-tab:eq(0)",$(this)).tabs($(".gb-tab-pn:eq(0) > div",$(this)),{event:'click'});
	});	
	
	//tag-box
	$(".tag-box .tag-box-in a:nth-child(4n)").addClass("last");
	$(".tag-box-s .tag-box-in a:nth-child(3n)").addClass("last");
	$(".tag-box .tag-box-in .link").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
		filterData();
	});		
	//heroList-tag-box
	$(".tag-box .heroList-tag-box-in a:nth-child(4n)").addClass("last");
	$(".tag-box-s .heroList-tag-box-in a:nth-child(3n)").addClass("last");
	$(".tag-box .heroList-tag-box-in .link").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
		filterData();
	});	
	$(".gb-tab .gb-tab-item").click(function(){
		initCondition();
		filterData();
	});	
			
	//pn-list		
	$(".pn-list .list").find("li:first").addClass("first");
	$(".pn-list .list").find("li:last").addClass("last");
	
	//pn-detail
	var sort=1;
	$(".pn-detail .tit").click(function(){		
		if(!$(this).hasClass('descending') && !$(this).hasClass('ascending')) {
			sort = 1;
		}
		if(sort==1){
		$(this).addClass("descending").removeClass("ascending").siblings().removeClass("ascending descending");
		sort=2;
		}else if(sort==2){
		$(this).addClass("ascending").removeClass("descending").siblings().removeClass("ascending descending");
		sort=1;			
		};		
	});
	$(".table-detail").find("th:first").addClass("first");
	$(".table-detail").find("th:last").addClass("last");
	$(".table-detail").find("tr:eq(1)").addClass("top");
	$(".table-detail").find("tr:last").addClass("last");
});
/**
 * 图标，鼠标放上去，英雄头像亮
 */
function mouseUnselected()
{
	$(".pn-pic .link-hero").each(function(){
		if($(this).hasClass("unselected")){
			//图标，鼠标放上去，英雄头像亮
			$(this).mouseover(function(){
				$(this).removeClass("unselected");
			});
			$(this).mouseout(function(){
				$(this).addClass("unselected");
			});
		}else{
			$(this).unbind("mouseout");
		}
	});
}