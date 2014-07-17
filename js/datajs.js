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
	//tag-box
	$(".tag-box .tag-box-in a:nth-child(4n)").addClass("last");
	$(".tag-box-s .tag-box-in a:nth-child(3n)").addClass("last");			
	$(".tag-box .tag-box-in .link").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
		var title = $(this).html();
		filterData(title);
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
	//tag-box
	$(".tag-box .link").click(function(){		
		window.location.hash = "middle_top";
		$(".pn-bd >.table-detail").hide().eq($(".tag-box a").index(this)).show(); 
	});
	
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
	
	//table-detailc21 出场数
	detail1();
	
	//.page-statistics ioc
	$(".con").each(function(j){
		$(this).hradio();
	});
	$(".hRadio").click(function(){
		var title = $(".tag-box .tag-box-in .current").html();
		filterData(title);
	});
	list_data = bbhdata;
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
//table-detailc21 出场数
function detail1(){
	//出场数血条
	var imgNum1=$(".table-ccsl .c21 label").length;//测英雄总数，用来循
	var maxNum1=0;
	for(var i=0;i <imgNum1;i++){
		var num1=$(".table-ccsl .c21 label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNum1)<eval(num1)){
			maxNum1=num1;
		}else{
		}
	}
	for(var j=0;j <imgNum1;j++){
		var num2=$(".table-ccsl .c21 label").eq(j).html();//测出每个英雄的出场数
		var t1=num2*(300/maxNum1);
		$(".table-ccsl .c21 .xxt").eq(j).width(t1);//控制血条宽度
	}
	//胜率血条
	var imgNum=$(".table-ccsl .c2 label").length;//测英雄总数，用来循环
	//var maxNum=$(".table-detail .c2 label").eq(0).html();//测出最多的胜率
	for(var i=0;i <= imgNum;i++){
		var num=$(".table-ccsl .c2 label").eq(i).html();//测出每个英雄的胜率
		var numInt1=parseFloat(num);//获取胜率的整数
		var t=numInt1*(300/100);
		$(".table-ccsl .c2 .xxt").eq(i).width(t);//控制血条宽度
	};
}
function detail2(){
	//杀人指数血条
	var imgNum3=$(".table-jszg .srzs label").length;//测英雄总数，用来循
	var maxNum3=0;
	for(var i=0;i <imgNum3;i++){
		var num3=$(".table-jszg .srzs label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNum3)<eval(num3)){
			maxNum3=num3;
		}
	}
	for(var j=0;j <imgNum3;j++){
		var num4=$(".table-jszg .srzs label").eq(j).html();//测出每个英雄的出场数
		var t3=num4*(170/maxNum3);
		$(".table-jszg .srzs .xxt").eq(j).width(t3);//控制血条宽度
	}
	//团贡指数血条
	var imgNumtg=$(".table-jszg .tgzs label").length;//测英雄总数，用来循
	var maxNumtg=0;
	for(var i=0;i <imgNumtg;i++){
		var numtg=$(".table-jszg .tgzs label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumtg)<eval(numtg)){
			maxNumtg=numtg;
		}
	}
	for(var j=0;j <imgNumtg;j++){
		var numtg1=$(".table-jszg .tgzs label").eq(j).html();//测出每个英雄的出场数
		var t1=numtg1*(170/maxNumtg);
		$(".table-jszg .tgzs .xxt").eq(j).width(t1);//控制血条宽度
	}
	//被杀指数血条
	var imgNumbs=$(".table-jszg .bszs label").length;//测英雄总数，用来循
	var maxNumbs=0;
	for(var i=0;i <imgNumbs;i++){
		var numbs=$(".table-jszg .bszs label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumbs)<eval(numbs)){
			maxNumbs=numbs;
		}
	}
	for(var j=0;j <imgNumbs;j++){
		var numbs1=$(".table-jszg .bszs label").eq(j).html();//测出每个英雄的出场数
		var t1bs=numbs1*(170/maxNumbs);
		$(".table-jszg .bszs .xxt").eq(j).width(t1bs);//控制血条宽度
	}
}
function detail3(){
	//正补指数血条
	var imgNumzb=$(".table-bdjy .zbzs label").length;//测英雄总数，用来循
	var maxNumzb=0;
	for(var i=0;i <imgNumzb;i++){
		var numzb=$(".table-bdjy .zbzs label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumzb)<eval(numzb)){
			maxNumzb=numzb;
		}
	}
	for(var j=0;j <imgNumzb;j++){
		var numzb1=$(".table-bdjy .zbzs label").eq(j).html();//测出每个英雄的出场数
		var tzb=numzb1*(90/maxNumzb);
		$(".table-bdjy .zbzs .xxt").eq(j).width(tzb);//控制血条宽度
	}
	//反补指数血条
	var imgNumfb=$(".table-bdjy .fbzs label").length;//测英雄总数，用来循
	var maxNumfb=0;
	for(var i=0;i <imgNumfb;i++){
		var numfb=$(".table-bdjy .fbzs label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumfb)<eval(numfb)){
			maxNumfb=numfb;
		}
	}
	for(var j=0;j <imgNumfb;j++){
		var numfb1=$(".table-bdjy .fbzs label").eq(j).html();//测出每个英雄的出场数
		var tfb=numfb1*(90/maxNumfb);
		$(".table-bdjy .fbzs .xxt").eq(j).width(tfb);//控制血条宽度
	}
	//场均打金/分钟血条
	var imgNumcj=$(".table-bdjy .cjdj label").length;//测英雄总数，用来循
	var maxNumcj=0;
	for(var i=0;i <imgNumcj;i++){
		var numcj=$(".table-bdjy .cjdj label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumcj)<eval(numcj)){
			maxNumcj=numcj;
		}
	}
	for(var j=0;j <imgNumcj;j++){
		var numcj1=$(".table-bdjy .cjdj label").eq(j).html();//测出每个英雄的出场数
		var tcj=numcj1*(90/maxNumcj);
		$(".table-bdjy .cjdj .xxt").eq(j).width(tcj);//控制血条宽度
	}
	//场均经验/分钟血条
	var imgNumjy=$(".table-bdjy .cjjy label").length;//测英雄总数，用来循
	var maxNumjy=0;
	for(var i=0;i <imgNumjy;i++){
		var numjy=$(".table-bdjy .cjjy label").eq(i).html();//测出每个英雄的出场数
		if(eval(maxNumjy)<eval(numjy)){
			maxNumjy=numjy;
		}
	}
	for(var j=0;j <imgNumjy;j++){
		var numjy1=$(".table-bdjy .cjjy label").eq(j).html();//测出每个英雄的出场数
		var tjy=numjy1*(90/maxNumjy);
		$(".table-bdjy .cjjy .xxt").eq(j).width(tjy);//控制血条宽度
	}
}

/**
 *	过滤数据
 */ 
function filterData(title){
	var data_arr = '';
	
	//类型
	var AttributePrimary = $(".tag1 .con .hRadio_Checked").html();
	//攻击方式
	var AttackCapabilities = $(".tag2 .con .hRadio_Checked").html();
	//定位
	var Roles = $(".tag3 .con .hRadio_Checked").html();
	//版本/时间
	var version = $(".tag4 .con .hRadio_Checked").html();
	if(version=='周'){
		data_arr = weekdata;
	}else if(version=='月'){
		data_arr = monthdata;
	}else{
		data_arr = bbhdata;
	}
	var new_arr = new Array();
	var k=0;
	var dlength = data_arr.length;
	//console.log(data_arr);return false;
	for(var i=0; i<dlength; i++){
		var attr_state = false;
		var attack_state = false;
		var roles_state =false;
		//类型
		if(AttributePrimary != '全部'){
			if(data_arr[i]['AttributePrimary'] == AttributePrimary){
				attr_state = true;
			}
		}else{
			attr_state = true;
		}
		//攻击方式
		if(AttackCapabilities != '全部'){
			if(data_arr[i]['AttackCapabilities'] == AttackCapabilities){
				attack_state = true;
			}
		}else{
			attack_state = true;
		}
		// 定位
		if(Roles != '全部'){
			var role = data_arr[i]['Roles'];
			var isex = isExistsArr(role, Roles)
			if(isex){
				roles_state = true;
			}
		}else{
			roles_state = true;
		}
		
		if((attack_state==true)&&(roles_state==true)&&(attr_state==true)){
			new_arr[k] = data_arr[i];
			k++;
		}
	}
	//console.log(new_arr);return false;
	showData(new_arr,title);
}

function showData(data_arr,title){
	list_data = data_arr;
	var winning = '';
	var jszg = '';
	var bdjy = '';
	if(data_arr.length > 0){
		for(var i=0; i<data_arr.length; i++){
			var trr = '';
			if(data_arr.length==1){trr = 'class="last"';}else if(i==0){trr = 'class="top"';}else if(i==data_arr.length-1){trr = 'class="last"';}
			if(title=='出场胜率'){
				winning += '<tr '+trr+'><td class="con con-hero"><a href="'+host+'/heros/'+data_arr[i]['_id']+'.html" tipurl="'+host+'/hero/'+data_arr[i]['_id']+'" target="_self" class="link-hero" title="'+data_arr[i]['name']+'"><img src="'+imgUrl+'/images/data/hero_shot_'+data_arr[i]['_id']+'.jpg" class="pic-hero" alt="'+data_arr[i]['name']+'"  />'+data_arr[i]['name']+'</a></td><td class="con"><div class="c21"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['count']+'</label></div></div></td><td class="con"><div class="c2"><div class="tit-c2"><div class="xxt"></div></div><div class="xx-label"><label>'+data_arr[i]['winning']+'%</label></div></div></td></tr>';
			}else if(title=='击杀助攻'){
				jszg += '<tr '+trr+'><td class="con con-hero"><a href="'+host+'/heros/'+data_arr[i]['_id']+'.html" tipurl="'+host+'/hero/'+data_arr[i]['_id']+'" target="_self" class="link-hero" title="'+data_arr[i]['name']+'"><img src="'+imgUrl+'/images/data/hero_shot_'+data_arr[i]['_id']+'.jpg" class="pic-hero" alt="'+data_arr[i]['name']+'"  />'+data_arr[i]['name']+'</a></td><td class="con"><div class="c21 srzs"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['kills']+'</label></div></div></td><td class="con"><div class="c21 tgzs"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['assists']+'</label></div></div></td><td class="con"><div class="c21 bszs"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['deaths']+'</label></div></div></td></tr>';
			}else{
				bdjy += '<tr '+trr+'><td class="con con-hero"><a href="'+host+'/heros/'+data_arr[i]['_id']+'.html" tipurl="'+host+'/hero/'+data_arr[i]['_id']+'" target="_self" class="link-hero" title="'+data_arr[i]['name']+'"><img src="'+imgUrl+'/images/data/hero_shot_'+data_arr[i]['_id']+'.jpg" class="pic-hero" alt="'+data_arr[i]['name']+'"  />'+data_arr[i]['name']+'</a></td><td class="con"><div class="c21 zbzs"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['last_hits']+'</label></div></div></td><td class="con"><div class="c21 fbzs"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['denies']+'</label></div></div></td><td class="con"><div class="c21 cjdj"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['gold_per_min']+'</label></div></div></td><td class="con"><div class="c21 cjjy"><div class="xxt"></div><div class="xx-label "><label>'+data_arr[i]['xp_per_min']+'</label></div></div></td></tr>';
			}
		}
	}
	//alert(winning);return false;
	if(title=='出场胜率'){
		$(".count-winning").html(winning);
		detail1();
	}else if(title=='击杀助攻'){
		$(".kill-assists").html(jszg);
		detail2();
	}else{
		$(".hits-denies").html(bdjy);
		detail3();
	}
	//detailc21();
	WowLoad();
}
/**
 *	用于判断值是否存在数组中
 *  arr_obj array  查找的数组above
 *  val  被查找的值
 */
function isExistsArr(arr_obj, val)
{
	if((typeof arr_obj != 'undefined') && (typeof val != 'undefined'))
	{
		var olength = arr_obj.length;
		for(var i=0; i<olength; i++){
			if(val == arr_obj[i]){
				return true;
			}
		}
	}
	return false;
}







