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
	$(".table-detail").find("th:first").addClass("first");
	$(".table-detail").find("th:last").addClass("last");
	$(".table-detail").find("tr:eq(1)").addClass("top");
	$(".table-detail").find("tr:last").addClass("last");
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
	//con-xxt c2 出场数
	con_xxt();
	//.page-statistics ioc
	$(".con").each(function(j){
		$(this).hradio();
	});
	
	$(".hRadio").click(function(){
		filterData();
	});
});
	
//.page-statistics ioc
;(function($){
    $.fn.hradio = function(options){
        var self = this;
        return $(':radio+label',this).each(function(){
            $(this).addClass('hRadio');
            if($(this).prev().is("checked"))
                $(this).addClass('hRadio_Checked');
        }).click(function(event){
            $(this).siblings().removeClass("hRadio_Checked");
            if(!$(this).prev().is(':checked')){
				$(this).addClass("hRadio_Checked");
                $(this).prev()[0].checked = true;
            }
               
            event.stopPropagation();
        })
        .prev().hide();
    }
})(jQuery)


/**
 *	过滤数据
 */ 
function filterData(){
	//console.log(data);return false;
	//类型
	var AttributePrimary = $(".tag1 .con .hRadio_Checked").html();
	//攻击方式
	var AttackCapabilities = $(".tag2 .con .hRadio_Checked").html();
	//定位
	var Roles = $(".tag3 .con .hRadio_Checked").html();
	//版本/时间
	var version = $(".tag4 .con .hRadio_Checked").html();
	data = 'Attr='+AttributePrimary+'&Attack='+AttackCapabilities+'&Roles='+Roles+'&vs='+version;
	$.ajax({
		type:"POST",
		data:data,
		async:false,	//同步
		url:host+"/ajax/SkillData.html",
		success:function(data){
			var json = eval('('+data+')');
			$(".count-skill").html(json);
			con_xxt();
			WowLoad();
			
		}
	});
}
//con-xxt c2 出场数
function con_xxt(){
	var imgNum1=$(".table-detail .c2 label").length;//测英雄总数，用来循
	var maxNum1=0;
	for(var i=0;i <imgNum1;i++){
		var num1=$(".table-detail .c2 label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNum1)<eval(num1)){
			maxNum1=num1;
		}
	}
	for(var j=0;j <imgNum1;j++){
		var num2=$(".table-detail .c2 label").eq(j).html();//测出每个英雄的出场数
		var t1=num2*(180/maxNum1);
		$(".table-detail .c2 .xxt").eq(j).width(t1);//控制血条宽度
	}
}