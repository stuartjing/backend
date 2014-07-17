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
	
	//filter-box
	$(".filter-box .item").click(function(){
		if(!$(this).hasClass('current')){
			$(this).addClass("current");
		}else{	
			$(this).removeClass("current");
		}
		filterItem();
	});
	$(".filter-box .item").each(function(j){
			$(this).addClass("item"+j);
	});
	
	$(".control-box").click(function(){
		$(".filter-box .tag2").slideToggle();
		if(!$(this).hasClass("retract")){
			$(this).find(".txt").html("展开");
			$(this).addClass("retract");
		}else{
			$(this).find(".txt").html("收起");
			$(this).removeClass("retract");	
		};
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

	//pic-tips
	$(".icon-item-fc .list").find("li").live('click',function(){
		var item_name = $(this).find(".get-item-name").val();
		if(item_name.indexOf("卷轴") >= 0 ){ 
			return false;
		}
	});
	
	$('body').bind('click.info', function() {
		$(".icon-item-fc .list .current").removeClass("current");
	});
	//info
	function getMax(){
		var ret=0;
		$(".info .col").each(function(){		
		var h = $(this).height();
		if( h > ret){ ret = h;};
		});	
		return ret;		
	};
	var h = getMax()-22;	
	var h1=$(".info .item-info").height();	
	$(".info .col .col-in").each(function(){
		if(h>h1){
			$(this).height(h);
			$(".info .item-info").height(h);
		}else{
			$(this).height(h1);
			$(".info .item-info").height(h1);
		}
	});
});
function setMouseOver()
{
	//pn-pic
	$(".icon-box .list li").each(function(j){	
		if($(this).hasClass("unselected")){					 
			$(this).mouseover(function(event){
				$(this).removeClass("unselected");
			}).mouseout(function(event){
				$(this).addClass("unselected");
			});
		}else{
			$(this).unbind("mouseout");
		}
	});	
}