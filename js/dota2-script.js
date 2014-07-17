$(document).ready(function(){
	var conH = parseInt($('#content').height());
	$('.no-comment .con-main-in').height(conH-75+'px')
	//$('.main').height(conH+260+'px')
	//$('.side-left').height(conH+30+'px');
	//nav-history
	$('.nav-history ul li').hover(
		function(){
			$(this).css({'color':'#d01d01'});
			$('a',$(this)).css({'color':'#d01d01','text-decoration':'underline'});
		},
		function(){
			$(this).css({'color':'#bfbfbf','border-bottom':'0'});
			$('a',$(this)).css({'color':'#bfbfbf','text-decoration':'none'});
		}
	)
	//news-list-1
	$('.news-list-1').each(function(){
		$('li:first',$(this)).css('border-top','0');
		$('li:last',$(this)).css('border-bottom','0');
	})
	
	//nav-history
	/*
	$('.nav-history ul li').hover(
		function(){$(this).addClass('on')},
		function(){$(this).removeClass('on')}
	)
	*/
	
	//mouse-hover
	$('.mouse-hover').each(function(){
		$('li',$(this)).hover(
			function(){
				$(this).addClass('on');},
			function(){
				$(this).removeClass('on');
			}
		)
	})
	//tab css
	
	$('.js-tab .gb-tab').each(function(){
		$('li:first',$(this)).addClass('on');
		$('li',$(this)).mouseenter(function(){
			$(this).parent('.gb-tab').find('li').removeClass('on');
			$(this).addClass('on');
		})
	})
	
	$('.js-tab-2 .gb-tab').each(function(){
		$('li:first',$(this)).addClass('on');
		$('li',$(this)).click(function(){
			$(this).parent('.gb-tab').find('li').removeClass('on');
			$(this).addClass('on');
		})
	})
	
	//tab
	
	$(".js-tab").each(function(){
	$(".gb-tab:eq(0)",$(this)).tabs($(".gb-tab-pn:eq(0) > div",$(this)),{event:'mouseover'});
	});
	$(".js-tab-2").each(function(){
	$(".gb-tab:eq(0)",$(this)).tabs($(".gb-tab-pn:eq(0) > div",$(this)),{event:'click'});
	});	
	
	$('.js-tab-3').each(function(){
		//$(this).find('.gb-tab').find('li:gt(0)').hide();
		$('.gb-tab-pn > div:gt(0)',$(this)).hide();
		//$(this).find('.gb-tab-pn > div:gt(0)').hide();
		$('li',$(this).find('.gb-tab')).each(function(i){
		//$(this).find('.gb-tab').find('a').each(function(i){
			$(this).hover(function(){
				$(this).parents('.js-tab-3').find('.gb-tab-pn > div').hide();
				var i=$(this).index();
				$(this).parents('.js-tab-3').find('.gb-tab-pn > div:eq('+i+')').show();
				$(this).parents('.js-tab-3').find('.gb-tab li').removeClass('on');
				$(this).addClass('on');
			})
		})
	})
	
	//tb
	$('.tb-data-1, .tb-data-2').each(function(){
		$('tr',$(this).find('tbody:last')).live('mouseover', function(){
			$(this).addClass('on')
		});
		$('tr',$(this).find('tbody:last')).live('mouseout', function(){
			$(this).removeClass('on')
		});
	})
	$('.tb-data-3, .tb-data-4').each(function(){
		$('td:first',$('tr')).each(function(){
			$(this).addClass('col-1');
		})
	})
	//tb-data-mini
	$('td',$('.tb-data-mini tr:odd')).css('background','#eaeaea');
	
	
	//btn-check
	$('.box-btn-check').each(function(){
		//根据查询框的隐藏还是显示决定初始状态
		var checkState = $('.box-check').css('display')=='none'?false:true;
		if(checkState){
			$('.btn-check',$(this)).text('收起')
		}else{
			$('.btn-check',$(this)).text('筛选')
		}
		$('.btn-check').click(function(){
			if(!checkState){
				$('.box-check',$(this).parents('.main')).slideDown();
				$(this).text('收起')
				checkState = true;
			}
			else{
				$('.box-check',$(this).parents('.main')).slideUp();
				$(this).text('筛选')
				checkState = false;
			}
		})
	})
	
	
})