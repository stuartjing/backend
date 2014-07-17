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
	list();
	
	//.page-statistics ioc
	$(".con").each(function(j){
		$(this).hradio();
	});
	//触发筛选条件
	$(".hRadio").click(function(){
		armoryData();
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
//con-xxt c2 出场数
function list(){
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
		var t1=num2*(130/maxNum1);
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
		var tgd=numgd1*(130/maxNumgd);
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
		var tcx=numcx1*(130/maxNumcx);
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
		var t1=numhq1*(130/maxNumhq);
		$(".list .c2-hq .xxt").eq(j).width(t1);//控制血条宽度
	}
}
/**
 *	过滤数据-类型，攻击，定位
 */ 
function armoryData(){
	//console.log(json_hero);return false;
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
		url:host+"/ajax/ArmoryData.html",
		success:function(data){
			var json = eval('('+data+')');
			if(AttributePrimary=='全部' && AttackCapabilities=='全部' && Roles=='全部'){
				$(".result-box").attr("style","display: none;");
			}else{
				$(".result-box").attr("style","display: block;");
				$(".hero-list").html(json.hero);
			}
			$(".item-list").html(json.item);
			list();
			WowLoad();
		}
	});
}