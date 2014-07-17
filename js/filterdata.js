/**
 *	过滤数据
 */ 
function filterData()
{
	secondfilterData(global_json_data);
//	
//	if(typeof json_data != 'undefined'){
//		secondfilterData(json_data);
//	}else{
//		json_data = 0;
//		$.getJSON('js/dota2_data.json',{}, function(data){
//			json_data = eval(data);
//			secondfilterData(json_data);
//		});
//	}
}
/**
 * 过滤数据
 */
function secondfilterData(json_data)
{
	var data_arr = json_data;
	// 攻击方式
	var AttackCapabilities = getAttackCapabilities();
	// 定位
	var Roles = getRoles();
	
	// 判断选择的是哪个标签 图标，列表，详细
	$(".gb-tab li").each(function(){
		if($(this).find("a").hasClass("current")){
			tagname = $(this).find("a").get(0).title;
		}
	});
	
	if(tagname == '列表'){
		var Team = '全部';
		var AttributePrimary_tianhui = $(".pn-list .col1 .tag-box").find(".current").html();
		var AttributePrimary_yemo = $(".pn-list .col2 .tag-box").find(".current").html();
		
	}else if(tagname == '详细'){
		// 分类
		var Team = $(".pn-detail .tag-box:last").find(".current").html();
		// 主属性
		var AttributePrimary = $(".pn-detail .tag-box:first").find(".current").html();
	}else{
		// 图标
		var Team = '全部';
		var AttributePrimary = '全部';
	}
	
	var new_arr = new Array();
	var k=0;
	var dlength = data_arr.length;
	for(var i=0; i<dlength; i++){
			var attack_state = false;
			var roles_state =false;
			var team_state = false;
			var attribute_state =false;
			// 攻击方式
			if(AttackCapabilities != 0){
				if(data_arr[i]['AttackCapabilities'] == AttackCapabilities){
					attack_state = true;
				}
			}else{
				attack_state = true;
			}
			// 定位
			if(Roles != 0){
				//alert(data_arr[i]['Roles'].split(','));
				var role = data_arr[i]['Roles'].split(',');
				var roles_length = role.length;
				var Roles_new_arr = Roles.split(",");
				var Rolelength = Roles_new_arr.length;
				var abcd = 0;
				for(var j=0; j<roles_length; j++){
					var isex = isExistsArr(Roles_new_arr, role[j])
					if(isex){
						abcd++;
					}
				}
				if(Rolelength == abcd){
					roles_state = true;
				}
			}else{
				roles_state = true;
			}
			// 分类
			if(Team != '全部'){
				if(data_arr[i]['Team'] == Team){
					team_state = true;
				}
			}else{
				team_state = true;
			}
			// 主属性
			if(tagname == '列表'){
				// 英雄为天辉方
					if(data_arr[i]['Team'] == '天辉'){
					//alert(AttributePrimary_tianhui);return false;
						if((AttributePrimary_tianhui=='全部') || (data_arr[i]['AttributePrimary'] == AttributePrimary_tianhui)){
							attribute_state = true;
						}
					}else{
						// 英雄为夜魔方
						if((AttributePrimary_yemo=='全部') || (data_arr[i]['AttributePrimary'] == AttributePrimary_yemo)){
							attribute_state = true;
						}
					}
			}else{
				if(AttributePrimary != '全部'){
					if(data_arr[i]['AttributePrimary'] == AttributePrimary){
						attribute_state = true;
					}
				}else{
					attribute_state = true;
				}
			}
			//alert(data_arr[i]);return false;
			if((attack_state==true)&&(roles_state==true)&&(team_state==true)&&(attribute_state==true)){
				new_arr[k] = data_arr[i];
				k++;
			}
	}
	//alert(new_arr);return false;
	if(tagname == '列表'){
		showListData(new_arr);
	}else if(tagname == '详细'){
		showDetailData(new_arr);
	}else{
		showPicData(new_arr);
	}
	mouseUnselected();
}
/**
 * 显示图标列表页的数据
 */
function showPicData(data_arr)
{
	var newPicData = new Array();
	var dlength = data_arr.length;
	for(var i=0; i<dlength; i++){
		newPicData[i]=data_arr[i]['name'];
	}
	$(".pn-pic a").each(function(){
		var isExists = isExistsArr(newPicData, $(this).get(0).title);
		if(!isExists){
			$(this).addClass("unselected");
		}else{
			$(this).removeClass("unselected");
		}
	});
}
/**
 * 显示列表页的数据
 */
function showListData(data_arr)
{
	list_data = data_arr;
	var showData_tianhui = '';
	var showData_yemo = '';
	
	var dlength = data_arr.length;
	if(dlength > 0){
		for(var i=0; i<dlength; i++){
			// 定位
			var roles_re = '';
			var role = data_arr[i]['Roles'].split(',');
			var roles_length = role.length;
			for(var j=0; j<roles_length;j++){
				roles_re += '<span class="txt-c2">'+role[j]+'</span>';
			}
			// 技能
			var ablities_re = '';
			var abilities_length = data_arr[i]['Abilities'].length;
			for(var k=0; k<abilities_length; k++){
				ablities_re += '<span class="link-skill"><a tipurl="'+host+'/skill/'+data_arr[i]['Abilities'][k]['id']+'"><img alt="'+data_arr[i]['Abilities'][k]['name']+','+data_arr[i]['name']+'" class="pic-skill" src="'+imgUrl+'/images/data/'+data_arr[i]['Abilities'][k]['icon']+'"><span class="txt-c3">'+data_arr[i]['Abilities'][k]['hotkey']+'</span></a></span>';
			}
			var dataValue = '<li class="item"><div class="c1"><a tipurl="'+host+'/hero/'+data_arr[i]['_id']+'" title="" class="link-hero" target="_self" href="'+host+'/heros/'+data_arr[i]['_id']+'.html"><img alt="'+data_arr[i]['name']+'" class="pic-hero" src="'+imgUrl+'/images/data/hero_shot_'+data_arr[i]['_id']+'.jpg"></a></div><div class="c2"><div class="tit-c2"><a title="" target="_self" href="'+host+'/heros/'+data_arr[i]['_id']+'.html">'+data_arr[i]['name']+'</a></div><div class="con">'+roles_re+'</div></div><div class="c3"><div class="pic-list">'+ablities_re+'</div></div></li>';
			if(data_arr[i]['Team'] == '天辉'){
				showData_tianhui += dataValue;
			}else{
				showData_yemo += dataValue;
			}
		}
	}
	$(".col1 ul").html(showData_tianhui);
	$(".col2 ul").html(showData_yemo);
	$(".col1 ul li:first").addClass("first");
	$(".col2 ul li:first").addClass("first");
	$(".col1 ul li:last").addClass("last");
	$(".col2 ul li:last").addClass("last");
	WowLoad();
}
/**
 * 显示详细列表页的数据
 */
function showDetailData(data_arr)
{
	list_data = data_arr;
	var showData = '';
	if(data_arr.length > 0){
		for(var i=0; i<data_arr.length; i++){
			showData += '<tr><td class="con con-hero"><a tipurl="'+host+'/hero/'+data_arr[i]['_id']+'" href="'+host+'/heros/'+data_arr[i]['_id']+'.html" target="_self" class="link-hero" title=""><img src="'+imgUrl+'/images/data/hero_shot_'+data_arr[i]['_id']+'.jpg" class="pic-hero" alt="'+data_arr[i]['name']+'"  />'+data_arr[i]['name']+'</a></td><td class="con">'+data_arr[i]['level_1_hp']+'</td><td class="con">'+data_arr[i]['level_1_mp']+'</td><td class="con">'+data_arr[i]['AttributeBaseStrength']+'</td><td class="con">'+data_arr[i]['AttributeBaseAgility']+'</td><td class="con">'+data_arr[i]['AttributeBaseIntelligence']+'</td><td class="con">'+data_arr[i]['level_1_ap']+'</td><td class="con">'+data_arr[i]['level_1_armor_qz']+'</td><td class="con">'+data_arr[i]['AttackRange']+'</td><td class="con">'+data_arr[i]['VisionDaytimeRange']+"~"+data_arr[i]['VisionNighttimeRange']+'</td><td class="con">'+data_arr[i]['MovementSpeed']+'</td><td class="con">'+data_arr[i]['ProjectileSpeed']+'</td><td class="con">'+data_arr[i]['AttackAnimationPoint']+'</td></tr>';
		}
	}
	$("#hero_list2").html(showData);
	WowLoad();
	//$(".pn-detail .table-detail tbody").find("tr:gt(0)").detach();
	//$(".pn-detail .table-detail tbody").append(showData);
}
/**
 *	获取攻击方式  AttackCapabilitiesObj
 *	AttackCapabilities==0 表示全选或者没选。不用筛选该项
 */
function getAttackCapabilities()
{
	var AttackCapabilities_arr = new Array(); 
	var i=0;
	var AttackCapabilities = 0;
	$(".tag1 ul li").each(function(){
		if($(this).find(".box").css('display')!='none'){
			AttackCapabilities_arr[i] = $(this).find(".link").html();
			i++;
		}
	});
	if(AttackCapabilities_arr.length == 1){
		var AttackCapabilities = AttackCapabilities_arr[0];
	}
	return AttackCapabilities;
}
/**
 *	获取定位  Roles
 *	Roles==0 表示全选或者没选。不用筛选该项
 */
function getRoles()
{
	var Roles_arr = new Array();
	var i=0;
	var Roles = 0;
	$(".tag2 ul li").each(function(){
		if($(this).find(".box").css('display')!='none'){
			Roles_arr[i] = $(this).find(".link").html();
			i++;
		}
	});
	if(Roles_arr.length >= 1 && Roles_arr.length < 10){
		var Roles = Roles_arr.join(',');
	}
	return Roles;
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
/**
 * 根据英雄名称查询英雄信息
 */
function getInfoByName(name)
{
	if(typeof name != 'undefined'){
		var data_arr = global_json_data;
		var dlength = data_arr.length;
		for (var i=0; i<dlength; i++){
			if(data_arr[i]['name'] == name){
				return data_arr[i];
			}
		}
	}
	return false;
}
/**
 * 根据英雄技能名称，筛选技能
 * @param name		技能迷彩
 * @param skill		所有技能数据
 */
function getSkillByname(name,skill)
{
	if((typeof name != 'undefined') && (typeof skill !='undefined')){
		var slength = skill.length;
		for(var i=0;i<slength; i++){
			if(name == skill[i]['name']){
				return skill[i];
			}
		}
	}
	return false;
}
/**
 * 英雄浮层数据
 */
function showHeroTips(info, heroimg)
{
	// 设置信息
	// 定位
	var roles = '';
	var ilength = info['Roles'].length;
	for(var i=0; i<ilength; i++){
		roles += '<div class="ball ball-r"><img src="'+imgUrl+'/images/dotaimg/'+heroimg[info['Roles'][i]]+'" class="png pic-ball" alt="" /></div>';
	}
	var showInfo = '<img src="'+imgUrl+'/images/data/'+info['头像']+'" class="pic" alt="" /><div class="box"><div class="ball"><img src="'+imgUrl+'/images/dotaimg/'+heroimg[info['AttackCapabilities']]+'" class="png pic-ball" alt="" /></div><div class="ball"><img src="'+imgUrl+'/images/dotaimg/'+heroimg[info['AttributePrimary']]+'" class="png pic-ball" alt="" /></div><div class="txt">'+info['name']+'</div>'+roles+'<b class="mask"></b></div>';
	$(".hero-tips").html(showInfo);
}
/**
 * 技能浮层数据
 */
function showSkillTips(title)
{
	var title_arr = title.split(",");
	var info = getInfoByName(title_arr[1]);
	var skillInfo = getSkillByname(title_arr[0],info['Abilities']);
	var skill = '';
	if(skillInfo['AbilityManaCost'] != ''){
		skill+='<p>魔法消耗：'+skillInfo['AbilityManaCost']+'</p>';
	}
	if(skillInfo['AbilityCooldown'] != ''){
		skill+='<p>冷却时间：'+skillInfo['AbilityCooldown']+'</p>';
	}
	if(skillInfo['AbilityDamage'] != ''){
		skill+='<p>技能伤害：'+skillInfo['AbilityDamage']+'</p>';
	}
	if(skillInfo['AbilityUnitDamageType'] != ''){
		skill+='<p>伤害类型：'+skillInfo['AbilityUnitDamageType']+'</p>';
	}
	if(skillInfo['AbilityCastRange'] != ''){
		skill+='<p>作用范围：'+skillInfo['AbilityCastRange']+'</p>';
	}
	if(skillInfo['AbilityDuration'] != ''){
		skill+='<p>持续时间：'+skillInfo['AbilityDuration']+'</p>';
	}
	if(skillInfo['终极技能'] == 1){
		skill+='<p>终极技能：是</p>';
	}else{
		skill+='<p>终极技能：否</p>';
	}
	if(skillInfo['AbilityCastPoint'] != ''){
		skill+='<p>施法点：'+skillInfo['AbilityCastPoint']+'</p>';
	}
	if(skillInfo['lines']!=''){
		var lines = '';
		for(var i=0;i<skillInfo['lines'].length;i++){
			lines +=  skillInfo['lines'][i] + "</br>";
		}
		skill += '<p>技能属性：'+lines+'</p>';
	}
	var showInfo = '<div class="c1"><img src="'+imgUrl+'/images/data/'+skillInfo['icon']+'" class="pic" alt="" /><span class="txt">'+skillInfo['hotkey']+'</span></div><div class="c2"><p class="tit"><spanclass="name">'+skillInfo['name']+' '+'</span>'+skillInfo['AbilityBehavior']+'</p><p class="description">'+skillInfo['Description']+'</p><div class="arguments">'+skill+'</div></div>';
	$(".skill-tips .tips-in").html(showInfo);
}
/**
 * 初始化搜索条件
 * @param obj	点击的标签
 */
function initCondition()
{
	$(".tag1 ul li").each(function(){
		$(this).removeClass("current");
	});
	$(".tag2 ul li").each(function(){
		$(this).removeClass("current");
	});
	$(".tag-box").find("a:first").addClass("current");
	$(".tag-box").find("a:gt(0)").removeClass("current");
}












