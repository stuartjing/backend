$(function(){
	//var art_title = document.title.split(" - ");	//获取页面标题		
	//art_title = art_title[0];
	var art_title = $(".getTitle").val().substr(0,12);
	var art_url = location.href;					//获取页面链接
	var hisArt = $.cookie("hisArt");				//获取当前值
	
	//若存在当前值
	if(hisArt){
		//转换成数组并获取长度
		hisArt = eval("("+hisArt+")");
		len = hisArt.length;
		//循环查找相同页面
		$.each(hisArt, function(i,n){
			//如果存在则删除该元素
			if(n!=undefined){
				if(n.title == art_title){
					hisArt.splice(i,1);		//删除第i个元素
				}
			}
		});
	}else{
		hisArt = new Array();
	}

	//数量处理
	if(hisArt && hisArt.length>=10){
		hisArt.splice(0,1);				//删除开头
	}
	
	//插入
	var newvo = {title:art_title,url:art_url};
	hisArt.splice(hisArt.length,0,newvo);			//末尾插入
	$.cookie("hisArt",JSON.stringify(hisArt),{expires:1, path: '/dota2'});
	
	//生成html
	var list = "<div class='tit'>浏览历史</div><ul class='list'>";
	for(var i=hisArt.length-1; i>=0;i--){
		list = list + "<li class='item'><a href='"+hisArt[i].url+"' target='_self' class='link' title='"+hisArt[i].title+"'>"+hisArt[i].title+"</a></li>";
	}
	$(".history-box").html(list + '</ul>');
});