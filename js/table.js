var _createf = false;
var _sortby  = 1;			//排序依据
var _curTab  = "";
var _tmp_x = 0;
//team(分类（天辉夜魇），类型,判定位置（1天辉 2夜魇）)
function team(key, val, num){
	var heroList = heroList_data;//获取数据
	var length  = heroList[key].length;			//获取数据量
	var html1 = [];
	var abc = 1;
	for (var i = 0; i < length; i++){
		if(heroList[key][i].AttributePrimary==val && val!=''){
			html1.push('\
				<li class="item ');
				if(abc==1){
					html1.push('\
					first\
				');
				abc++;
				}
			html1.push('\
				">\
					<div class="c1">\
						<a href="index.php?r=site/hero&id='+heroList[key][i]._id+'" target="_self" class="link-hero" title="'+heroList[key][i].name+'">\
						<img src="'+imgUrl+'/images/data/hero_shot_'+heroList[key][i]._id+'.jpg" class="pic-hero" alt="'+heroList[key][i].name+'"  /></a>\
					</div>\
					<div class="c2">\
						<div class="tit-c2"><a href="index.php?r=site/hero&id='+heroList[key][i]._id+'" target="_self" title="'+heroList[key][i].name+'">'+heroList[key][i].name+'</a></div>\
						<div class="con">\
						');	
						for(j=0;j<heroList[key][i].Roles.length;j++){
			html1.push('\
							<span class="txt-c2">'+heroList[key][i].Roles[j]+'</span>\
					');
						}
			html1.push('\
						</div>\
					</div>\
					<div class="c3">\
						<div class="pic-list">\
						');
							for(j=0;j<heroList[key][i].Abilities.length;j++){
								if(heroList[key][i].Abilities[j].hotkey==undefined){heroList[key][i].Abilities[j].hotkey='';}
			html1.push('\
							<span class="link-skill">\
								<img src="'+imgUrl+'/images/data/ability_'+heroList[key][i].Abilities[j].id+'.jpg" class="pic-skill" alt="'+heroList[key][i].Abilities[j].name+'"  />\
								<span class="txt-c3">'+heroList[key][i].Abilities[j].hotkey+'</span>\
							</span>\
					');
							}
			html1.push('\
						</div>\
					</div>\
				</li>\
			');
		}else if(val==''){
			html1.push('\
				<li class="item ');
				if(abc==1){
					html1.push('\
					first\
				');
				abc++;
				}
			html1.push('\
				">\
					<div class="c1">\
						<a href="index.php?r=site/hero&id='+heroList[key][i]._id+'" target="_self" class="link-hero" title="'+heroList[key][i].name+'">\
						<img src="'+imgUrl+'/images/data/hero_shot_'+heroList[key][i]._id+'.jpg" class="pic-hero" alt="'+heroList[key][i].name+'"  /></a>\
					</div>\
					<div class="c2">\
						<div class="tit-c2"><a href="index.php?r=site/hero&id='+heroList[key][i]._id+'" target="_self" title="'+heroList[key][i].name+'">'+heroList[key][i].name+'</a></div>\
						<div class="con">\
						');	
						for(j=0;j<heroList[key][i].Roles.length;j++){
			html1.push('\
							<span class="txt-c2">'+heroList[key][i].Roles[j]+'</span>\
					');
						}
			html1.push('\
						</div>\
					</div>\
					<div class="c3">\
						<div class="pic-list">\
						');
							for(j=0;j<heroList[key][i].Abilities.length;j++){
								if(heroList[key][i].Abilities[j].hotkey==undefined){heroList[key][i].Abilities[j].hotkey='';}
			html1.push('\
							<span class="link-skill">\
								<img src="'+imgUrl+'/images/data/ability_'+heroList[key][i].Abilities[j].id+'.jpg" class="pic-skill" alt="'+heroList[key][i].Abilities[j].name+'"  />\
								<span class="txt-c3">'+heroList[key][i].Abilities[j].hotkey+'</span>\
							</span>\
					');
							}
			html1.push('\
						</div>\
					</div>\
				</li>\
			');
		}
	}
	html1 = html1.join("");
	$(".team"+num).html(html1);
}
var Table = {
	//生成列表（列表id，显示页码，定位判定）
	create: function(id, currpage, pos){
		var id   = id;
		//var conf = list_conf;			//获取配置
		var data = list_data;			//获取数据
		var len  = data.length;			//获取数据量
		
		var html1 = [];
		var html2 = [];
		var html3 = [];
		var html4 = [];
		if (pos == 1){window.location.hash = "middle_top";}	//设置页面访问的锚点

		//记录循环，pB与pE之间的数据
		if(len>0){
			for (var i = 0; i < len; i++){
				//根据类型处理表记录
				switch (id){
					case "hero_list":    //英雄
						html2.push('\
							<tr>\
								<td class="con con-hero">\
									<a href="'+host+'/heros/'+data[i]._id+'.html" tipurl="'+host+'/hero/'+data[i]._id+'" target="_self" class="link-hero" title="'+data[i].name+'">\
									<img src="'+imgUrl+'/images/data/hero_shot_'+data[i]._id+'.jpg" class="pic-hero" alt="'+data[i].name+'"  />'+data[i].name+'</a>\
								</td>\
								<td class="con">'+data[i].level_1_hp+'</td>\
								<td class="con">'+data[i].level_1_mp+'</td>\
								<td class="con">'+data[i].AttributeBaseStrength+'</td>\
								<td class="con">'+data[i].AttributeBaseAgility+'</td>\
								<td class="con">'+data[i].AttributeBaseIntelligence+'</td>\
								<td class="con">'+data[i].level_1_ap_min+'~'+data[i].level_1_ap_max+'</td>\
								<td class="con">'+data[i].level_1_armor_qz+'</td>\
								<td class="con">'+data[i].AttackRange+'</td>\
								<td class="con">'+data[i].VisionDaytimeRange+'/'+data[i].VisionNighttimeRange+'</td>\
								<td class="con">'+data[i].MovementSpeed+'</td>\
								<td class="con">'+data[i].ProjectileSpeed+'</td>\
								<td class="con">'+data[i].AttackAnimationPoint+'</td>\
							</tr>\
						');	
						break;
					case "winning":    //数据统计-出场胜率
						html1.push('\
							<tr>\
								<td class="con con-hero">\
									<a href="'+host+'/heros/'+data[i]._id+'.html" tipurl="'+host+'/hero/'+data[i]._id+'" target="_self" class="link-hero" title="'+data[i].name+'">\
									<img src="'+imgUrl+'/images/data/hero_shot_'+data[i]._id+'.jpg" class="pic-hero" alt="'+data[i].name+'"  />'+data[i].name+'</a>\
								</td>\
								<td class="con">\
								    <div class="c21">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].count+'</label>\
										</div>\
									</div>\
								</td>\
								<td class="con">\
									 <div class="c2">\
										<div class="tit-c2">\
											<div class="xxt"></div>\
										</div>\
										<div class="xx-label">\
											<label>'+data[i].winning+'%</label>\
										</div>\
									</div>\
								</td>\
							</tr>\
						');
						break;
					case "assists":    //数据统计-击杀助攻
						html3.push('\
							<tr>\
								<td class="con con-hero">\
									<a href="'+host+'/heros/'+data[i]._id+'.html" tipurl="'+host+'/hero/'+data[i]._id+'" target="_self" class="link-hero" title="'+data[i].name+'">\
									<img src="'+imgUrl+'/images/data/hero_shot_'+data[i]._id+'.jpg" class="pic-hero" alt="'+data[i].name+'"  />'+data[i].name+'</a>\
								</td>\
								<td class="con">\
								   <div class="c21 srzs">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].kills+'</label>\
										</div>\
									</div>\
								</td>\
								<td class="con">\
								   <div class="c21 tgzs">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].assists+'</label>\
										</div>\
									</div>\
								</td>\
								<td class="con">\
								   <div class="c21 bszs">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].deaths+'</label>\
										</div>\
									</div>\
								</td>\
							</tr>\
						');
						break;
					case "denies":    //数据统计-补刀经验
						html4.push('\
							<tr>\
								<td class="con con-hero">\
									<a href="'+host+'/heros/'+data[i]._id+'.html" tipurl="'+host+'/hero/'+data[i]._id+'" target="_self" class="link-hero" title="'+data[i].name+'">\
									<img src="'+imgUrl+'/images/data/hero_shot_'+data[i]._id+'.jpg" class="pic-hero" alt="'+data[i].name+'"  />'+data[i].name+'</a>\
								</td>\
								<td class="con">\
								   <div class="c21 zbzs">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].last_hits+'</label>\
										</div>\
									</div>\
								</td>\
								<td class="con">\
								   <div class="c21 fbzs">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].denies+'</label>\
										</div>\
									</div>\
								</td>\
								<td class="con">\
								   <div class="c21 cjdj">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].gold_per_min+'</label>\
										</div>\
									</div>\
								</td>\
								<td class="con">\
								   <div class="c21 cjjy">\
										<div class="xxt"></div>\
										<div class="xx-label ">\
											<label>'+data[i].xp_per_min+'</label>\
										</div>\
									</div>\
								</td>\
							</tr>\
						');
						break;
						
						
				}
			}
		}else{
			switch (id){				
				case "hero_list":    //英雄
					html2.push('<tr><td colspan="13">没有符合条件的英雄</td></tr>');
					break;
			}
		}	
	  	html2 = html2.join("");
	  	html1 = html1.join("");
	  	html3 = html3.join("");
	  	html4 = html4.join("");
		switch (id){
			case "hero_list":    //英雄
				$("#"+id+'2').html(html2);
				break;
			case "winning":    //数据统计-出场胜率
				$(".count-winning").html(html1);
				detail1();
				break;
			case "assists":    //数据统计-击杀助攻
				$(".kill-assists").html(html3);
				detail2();
				break;
			case "denies":    //数据统计-补刀经验
				$(".hits-denies").html(html4);
				detail3();
				break;
		}
		WowLoad();
	},

	
	//排序（索引位置，是否为数字排序，列表id，列表编号）
	sortBy: function (x, y, id, no){
		var data = list_data;
		// 全局变量tmp_x用于识别当前点击的是否为同一个标签
		if(_tmp_x != x){
			_sortby = 1;
			_tmp_x = x;
		}
		_sortby = ((_sortby % 2) == 1) ? 1 : 0;
		
		//不能被2整除，倒序
		if (_sortby){
			if (y){
			    data.sort(function(a,b){
					ax=(a[x]==null)?0:a[x]-0;
					bx=(b[x]==null)?0:b[x]-0;
					return 	(bx-ax);		
				});
			}else{
				data.sort(function(a,b){
					return b[x].localeCompare(a[x]);	//直接字符串比较
				});
			}
			_sortby = 2;
		//能被2整除，正序
		}else{
			if (y){
				data.sort(function(a,b){
					ax=(a[x]==null)?0:a[x]-0;
					bx=(b[x]==null)?0:b[x]-0;
					return 	(ax-bx);
				});
			}else{
				data.sort(function(a,b){
					return a[x].localeCompare(b[x]);
				});
			}
			_sortby = 1;
		}

		//_sortby++;	//排序累加器

		Table.create(id, 1, 1);	//重新生成第一页
	},
	//从配置中获取字段序号
	get: function (name){
		var key = false;
		alert(list_conf.length);return false;
		for(var i=0; i<list_conf.length; i++){
			if(list_conf[i] == name)
				key = i;
		}
		return key;
	}
}

var tab = { 
	initab: function(tab0,tab1,tabarea,classname,classname1 ){

	  var tmp = $(tab0,tabarea);
	  var tmp0 = $(tab1,tabarea);
	  $(tmp).each( function(){ $(this).removeClass() });
	  $(tmp).each( function(){ $(this).addClass(classname1) });
	  $(tmp[0]).addClass(classname);
	  $(tmp0).each( function(){ $(this).hide() }) ;
	  $(tmp0[0]).show();	
	  	  
	  for( var i=0; i<tmp.length; i++ ){
		 tmp[i].i = i;
		 $(tmp[i]).click(function(){ 
			 $(tmp).each( function(){ $(this).removeClass() });
			 $(tmp).each( function(){ $(this).addClass(classname1) });
			 $(this).addClass(classname);
			 $(tmp0).each( function(){ $(this).hide( ) }) ;
			 $(tmp0[this.i]).show();
			 //$.cookie( cookiename, this.i, {expires: 999} ); 
			 return false;
		 }) 
	  }
	}		   
}

/**
 * 允许列表页勾选头部的复选框快速查询

function list_filter_url_make(url){
	//勾选并提交
	$('.box-check-btm').find(':checkbox').live('click', function(){
		var ap=new Array(),ac=new Array(),ro=new Array();
		
		//获取勾选信息并跳转
		$('.box-check-btm').find(':checked').each(function(){
			var ob = $(this);
			var va = ob.val();
			var info = va.split('_');
			
			if(info[0]==='0'){
				ap.push(info[1]);
			}else if(info[0]==='1'){
				ac.push(info[1]);
			}else if(info[0]==='2'){
				ro.push(info[1]);
			}
		})
		
		var str = "cr=0:1:2;crs=6:6:6;crv="+ap.join(',')+':'+ac.join(',')+':'+ro.join(',');
		location='index.php?r='+url+'/filter/'+str;
	});
}
 */


