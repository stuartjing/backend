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
			500,
			function() {
			    is_show = false;
			});       		
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
	
	//hero-list	
	var n = $(".hero-con").size();
	if(n==1){
		$(".hero-list").addClass("only-one");
		$(".hero-con").removeClass("last");
	};

	//skill-box
	$(".skill-box").each(function(j){
		if($(this).hasClass("unselected")){					 
			$(this).mouseenter(function(event){
				$(this).removeClass("unselected");
			}).mouseleave(function(event){
				$(this).addClass("unselected");
			});
		};
	});	
});