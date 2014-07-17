var __TOPBAROBJECT__;
(function(global) {
/* LazyLoad 2.0.3 */
LazyLoad=(function(j){var g,h,b={},e=0,f={css:[],js:[]},m=j.styleSheets;function l(p,r,o){var q=j.createElement(p),n;if(r){q.setAttribute("charset",r)}for(n in o){if(o.hasOwnProperty(n)){q.setAttribute(n,o[n])}}return q}function i(n){var q=b[n],r,o;if(q){r=q.callback;o=q.urls;o.shift();e=0;if(!o.length){r&&r.call(q.context,q.obj);b[n]=null;f[n].length&&k(n)}}}function c(){var n=navigator.userAgent;g={async:j.createElement("script").async===true};(g.webkit=/AppleWebKit\//.test(n))||(g.ie=/MSIE/.test(n))||(g.opera=/Opera/.test(n))||(g.gecko=/Gecko\//.test(n))||(g.unknown=true)}function k(B,A,C,w,r){var t=function(){i(B)},D=B==="css",o=[],v,y,s,q,z,n;g||c();if(A){A=typeof A==="string"?[A]:A.concat();if(D||g.async||g.gecko||g.opera){f[B].push({urls:A,callback:C,obj:w,context:r})}else{for(v=0,y=A.length;v<y;++v){f[B].push({urls:[A[v]],callback:v===y-1?C:null,obj:w,context:r})}}}if(b[B]||!(q=b[B]=f[B].shift())){return}h||(h=j.head||j.getElementsByTagName("head")[0]);z=q.urls;for(v=0,y=z.length;v<y;++v){n=z[v];var u="";var x=n.match(/\[charset=([a-zA-Z0-9-]+)\]$/);if(x){u=x[1];n=n.replace(x[0],"")}if(D){s=g.gecko?l("style",u):l("link",u,{href:n,rel:"stylesheet"})}else{s=l("script",u,{src:n});s.async=false}s.className="lazyload";if(g.ie&&!D){s.onreadystatechange=function(){if(/loaded|complete/.test(s.readyState)){s.onreadystatechange=null;t()}}}else{if(D&&(g.gecko||g.webkit)){if(g.webkit){q.urls[v]=s.href;d()}else{s.innerHTML='@import "'+n+'";';a(s)}}else{s.onload=s.onerror=t}}o.push(s)}for(v=0,y=o.length;v<y;++v){h.appendChild(o[v])}}function a(p){var o;try{o=!!p.sheet.cssRules}catch(n){e+=1;if(e<200){setTimeout(function(){a(p)},50)}else{o&&i("css")}return}i("css")}function d(){var o=b.css,n;if(o){n=m.length;while(--n>=0){if(m[n].href===o.urls[0]){i("css");break}}e+=1;if(o){if(e<200){setTimeout(d,50)}else{i("css")}}}}return{css:function(p,q,o,n){k("css",p,q,o,n)},js:function(p,q,o,n){k("js",p,q,o,n)}}})(this.document);

function global_topnav_main($){
	$.fn.newsscroll=function(options){var settings={time:3000};var opts=$.extend(settings,options);var $this=$(this),timer;function doScroll(){var ulheight=$this.find('ul').height(),liheight=36;timer=setInterval(function(){$this.find('ul').animate({marginTop:'-='+liheight},{complete:function(){if($this.find('ul').css('marginTop')==('-'+ulheight+'px'))$this.find('ul').css('marginTop',0)}},1000)},opts.time)}return this.each(function(){doScroll();$this.hover(function(){if(timer)clearInterval(timer)},function(){doScroll()})})}
	
	$.fn.loginForTopbar = function( options ){
		var settings = {
			passportSC:null,
			tip:null		
		};
		var opts = $.extend(settings, options);
		var $this = $(this),loginoutstr=[],flag = false;
		
		function initLoginOut(){
			$this.html( loginoutstr.join('') );
			
			opts.passportSC.autopad = '';
			opts.passportSC.emailInput = $('#js-global-username')[0];
			opts.passportSC.passwdInput = $('#js-global-password')[0];
	
			opts.passportSC.isSetFocus = false;
			opts.passportSC.bindSelector();
			opts.passportSC.email = '\u7528\u6237\u540d';
			opts.passportSC._drawLoginForm = function(){setTimeout(function(){initLoginOut();},500);}
			
			$( '#js-global-topnav-form' ).submit( function () {
				$this.html('<span id="js-global-loginMsg">\u6b63\u5728\u767b\u5f55\u641c\u72d0\u901a\u884c\u8bc1\uff0c\u8bf7\u7a0d\u5019</span>...<a href="javascript:void(0);" id="js-topnav-cancel">\u9000\u51fa</a>');
				var pd = $('#js-global-loginMsg').html();
				opts.passportSC.loginMsg = $('#js-global-loginMsg')[0];
				
				setTimeout( function(){
					if( $('#js-global-loginMsg').html() == pd ){
						alert('\u7528\u6237\u540d\u6216\u5bc6\u7801\u9519\u8bef');
						start();
					}
				},6000);
				
				$('#js-topnav-cancel').click( function(){
					start();
				} );
				return doLogin2();
			} );
			
			$( '#js-global-username' ).focus( function(){
				if( $(this).val()=='\u7528\u6237\u540d' )
					$(this).val('');
			} ).blur( function(){
				if( $(this).val()=='' )
					$(this).val('\u7528\u6237\u540d');
			} );	
		}
		
		function doLogin2(){
			var e_UserID = opts.passportSC.emailInput.value;
			var e_Pwd = opts.passportSC.passwdInput.value;
			var e_Index = e_UserID.indexOf("@");
			if (e_Index == "-1") {
				alert("\u7528\u6237\u540d\u4e0d\u5408\u6cd5");
				opts.passportSC.emailInput.focus();
				return false
			}
			if (e_Pwd == "") {
				alert("\u8bf7\u8f93\u5165\u5bc6\u7801");
				opts.passportSC.passwdInput.focus();
				return false
			}
			var e_Domain = e_UserID.substr(e_Index + 1);
			var e_Username = e_UserID.substr(0, e_Index);
			if (e_Domain == "") {
				opts.passportSC.autopad = "17173.com";
			}
			opts.passportSC.loginHandle(opts.passportSC.emailInput.value, opts.passportSC.passwdInput.value, "0", opts.passportSC.sElement, opts.passportSC.loginFailCall.bindFunc(opts.passportSC), opts.passportSC.loginSuccessCall.bindFunc(opts.passportSC));
			if( typeof( Passport17173 ) != 'undefined' ){
				PassportSC.emailInput.value = opts.passportSC.emailInput.value;
				PassportSC.passwdInput.value = opts.passportSC.passwdInput.value;
				Passport17173.loginHandle();
			}
			return false;
		}
		
		function loginSuccess(){}
		function logoutFail(){}
		function logoutApp() {}
		
		opts.passportSC._drawPassportCard = function(){
			var logininstr = [];
			
			logininstr.push( '<div id="js-global-topnav-loginin">' );
			logininstr.push( '<a href="javascript:void(0);" class="g-topnav-username" id="js-g-topnav-username"><span></span>' + opts.passportSC.cookieHandle() + '</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="js-global-topnav-loginout">\u9000\u51fa</a>' );
			logininstr.push( '</div>' );
			
			logininstr.push( '<div class="g-topnav-uf" id="js-g-topnav-uf">' );
			logininstr.push( '<h3>\u641c\u72d0<span>\u901a\u884c\u8bc1</span><a href="javascript:void(0);" class="g-topnav-uf-close-btn" id="js-g-topnav-uf-close-btn"></a></h3>' );
			logininstr.push( '<div class="g-topnav-uf-cnt">' );
			logininstr.push( '  <div class="g-topnav-uf-cnt3">' );
			logininstr.push( '	<div class="g-topnav-uf-tab">' );
			logininstr.push( '	  <ul>' );
			logininstr.push( '		<li><a href="http://bbs.17173.com/" target="_blank">\u793e\u533a</a></li>' );
			logininstr.push( '		<li><a href="http://gh.17173.com/" target="_blank">\u516c\u4f1a</a></li>' );
			logininstr.push( '		<li><a href="http://blog.17173.com/" target="_blank">\u535a\u5ba2</a></li>' );
			logininstr.push( '		<li><a href="http://vlog.17173.com/" target="_blank">\u64ad\u5ba2</a></li>' );
			logininstr.push( '		<li><a href="http://pic.17173.com/" target="_blank">\u622a\u56fe</a></li>' );
			logininstr.push( '	  </ul>' );
			logininstr.push( '	  <div class="clear"></div>' );
			logininstr.push( '	</div>' );
			logininstr.push( '	<div class="g-topnav-uf-cnt2">\u6b22\u8fce\u60a8\uff0c\u60a8\u5df2\u7ecf\u6210\u529f\u767b\u5f5517173.com\uff01</div>' );
			logininstr.push( '  </div>' );
			logininstr.push( '  <div class="g-topnav-uf-btm"><span class="g-topnav-17173">17173</span> <span class="g-topnav-17173-2"><a href="http://bai.sohu.com/" target="_blank">\u767d\u793e\u4f1a</a> | <a href="http://t.sohu.com/" target="_blank">\u5fae\u535a</a> | <a href="http://pp.sohu.com/" target="_blank">\u76f8\u518c</a></span></div>' );
			logininstr.push( '<div class="g-topnav-uf-btm2"><a href="http://blog.sohu.com/camp?from=1029" target="_blank"></a></div>' );
			logininstr.push( '</div>' );
			logininstr.push( '</div>' );
			
			$this.html( logininstr.join('') );
			
			/*$( '#js-g-topnav-uf' ).find('a').each( function(){
				if( $(this).attr('href').indexOf('http://') != -1 )
				$(this).attr("href",'http://log1.17173.com/click?category=topnav&redirect=' + $(this).attr('href').split('//')[1]);
			} );*/
			
			$('.js-global-topnav-loginout').click( function(e){
				if($.browser.msie&&($.browser.version == "6.0")&&!$.support.style){
					if (e.preventDefault) {
						e.preventDefault(); 
					} else if (window.event) {
						window.event.returnValue = false; 
					}
				}
				opts.passportSC.doLogout();
				initLoginOut();
			} );
			
			$('#js-g-topnav-username').add($('#js-g-topnav-uf-close-btn')).click( function(){
				$('#js-g-topnav-uf').toggle();
			} );
		}
		
		function start(){
			loginoutstr = [];
			loginoutstr.push('<form method="post" id="js-global-topnav-form">');
			loginoutstr.push('<table width="100%" border="0">');
			loginoutstr.push('	<tr>');
			loginoutstr.push('		<td width="110"><input type="text" autocomplete="off" class="global-txt2" value="\u7528\u6237\u540d" id="js-global-username" /></td>');
			loginoutstr.push('		<td width="88"><input type="password" class="global-pwd" id="js-global-password" /></td>');
			loginoutstr.push('		<td><input type="submit" value="\u767b\u5f55" class="global-submit" id="js-global-submit"  /></td>');
			loginoutstr.push('		<td><a href="http://passport.17173.com/register" target="_blank">\u6ce8\u518c</a></td>');
			loginoutstr.push('	</tr>');
			loginoutstr.push('</table>');
			loginoutstr.push('</form>');		
			
			__TOPBAROBJECT__ = opts.passportSC;
			opts.passportSC.appid = 1029;
			opts.passportSC.registerUrl = "http://passport.17173.com/register";
			opts.passportSC.recoverUrl  = "http://passport.17173.com/find/pwd";
			opts.passportSC.helpUrl = "http://800.17173.com";
			opts.passportSC.app17173UserInfoUrl = "";
			opts.passportSC.app17173LogoutUrl   = "";
			opts.passportSC.otherLink = '<A href="http://blog.17173.com" target=_blank>\u5f00\u901a\u6e38\u620f\u535a\u5ba2</A>';
			opts.passportSC.loginInfo = '';
			opts.passportSC.autopad = "17173.com";
			opts.passportSC.selectorTitle = "\u9009\u62e9\u60a8\u6240\u8981\u767b\u5f55\u7684\u7528\u6237";
			
			//opts.passportSC.drawPassport($('#js-global-topnav-login')[0]);
			opts.passportSC.init( opts.tip[0] );
			opts.passportSC.cElement.className = "";
			opts.passportSC.curCardIndex = PassportCardList.length;
			opts.passportSC.isSetFocus = false;
			PassportCardList.push(opts.passportSC);
	
			opts.passportSC.successCalledFunc = eval("loginSuccess");
			//opts.passportSC.logoutFailCall = eval("logoutFail");
			if (opts.passportSC.cookie && opts.passportSC.cookie['userid'] != '') {
				opts.passportSC.cElement.className = "passportc";
				opts.passportSC.cElement.style.display = "none";
				opts.passportSC.drawPassportCard();
			} else {
				initLoginOut();
			}
	
		}
		
		return this.each( function(){
			start();
			
			if( typeof( Passport17173 ) != 'undefined' ){
				setInterval( function(){
					if( $('#17173passport').has( $('#spp_logout_botton') ).length == 0 ){	
						$('.js-global-topnav-loginout').click();
					}
				},1000 );
			}
			
		} );
	};
	
$.fn.main=function(options){var settings={data:null,passportSC:null};var opts=$.extend(settings,options);var $this=$(this),flag=false;function tongji(el){$(el).find('a').each(function(){if($(this).attr('href').indexOf('http://')!=-1)$(this).attr("href",'http://log1.17173.com/click?category=topnav&redirect='+$(this).attr('href').split('//')[1])})}function start(){var str=[];str.push('<div class="g-topnav">');str.push('  <div class="g-topnav-cnt">');str.push('	<div class="g-topnav-link"><span class="g-topnav-home"><a href="http://www.17173.com/" target="_blank">17173\u9996\u9875</a></span></div>');str.push('	<div class="g-topnav-nav">');str.push('	  <input type="text" name="keyword" class="g-topnav-txt1" value="\u5168\u7ad9\u5bfc\u822a" id="js-global-nav" title="\u70b9\u51fb\u8f93\u5165\u5173\u952e\u8bcd" />');str.push('	  <input type="submit" class="g-topnav-txt4" value="" id="js-global-submit2"/>');str.push('	  <input type="button" class="g-topnav-txt4 g-topnav-txt5" value="" id="js-global-submit3"/>');str.push('	</div>');str.push('	<div style="display:none" id="js-global-nav-cnt" class="g-topnav-nav-cnt">');str.push('	<div class="g-topnav-nav-cnt-1">');str.push('	  <h3><a class="global-c1" target="_blank" href="http://news.17173.com/">\u65b0\u95fb</a></h3>');str.push('	  <a target="_blank" href="http://news.17173.com/main/no3.shtml">\u4ea7\u4e1a</a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://news.17173.com/main/no2.shtml">\u5168\u7403</a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://news.17173.com/main/no1.shtml">\u5927\u9646</a>&nbsp;&nbsp;&nbsp;<br><a target="_blank" href="http://news.17173.com/look/">\u56fe\u7247</a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://news.17173.com/topic/">\u8bdd\u9898</a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://news.17173.com/gameview/">\u5927\u89c2</a></div>');str.push('	<div class="g-topnav-nav-cnt-2">');str.push('	  <h3><span class="global-c2">\u70ed\u95e8\u6e38\u620f</span></h3>');str.push('	  <a target="_blank" href="http://wow.17173.com/">\u9b54\u517d\u4e16\u754c</a>&nbsp;&nbsp;<a target="_blank" href="http://dnf.17173.com/">DNF</a><br><a target="_blank" href="http://xyq.17173.com/">\u68a6\u5e7b\u897f\u6e38</a>&nbsp;&nbsp;<a target="_blank" href="http://lol.17173.com/">\u82f1\u96c4\u8054\u76df</a> <br><a target="_blank" href="http://gfyx.17173.com/">\u529f\u592b\u82f1\u96c4</a>&nbsp;&nbsp;<a target="_blank" href="http://tl.17173.com/">\u5929\u9f99\u516b\u90e8</a><br><a target="_blank" href="http://speed.17173.com/">QQ\u98de\u8f66</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://nycs.17173.com/">\u8bfa\u4e9a\u4f20\u8bf4</a><br><a target="_blank" href="http://qn.17173.com/">\u5029\u5973\u5e7d\u9b42</a>&nbsp;&nbsp;<a target="_blank" href="http://f.17173.com/">\u627e\u6e38\u620f&gt;&gt;</a></div>');str.push('	<div class="g-topnav-nav-cnt-3">');str.push('	  <h3><a class="global-c3" target="_blank" href="http://media.17173.com/">\u6e38\u620f\u89c6\u9891</a></h3>');str.push('	  <a target="_blank" href="http://media.17173.com/new/">\u65b0\u6e38\u89c6\u9891</a>&nbsp;&nbsp;<a target="_blank" href="http://media.17173.com/games/">\u5355\u673a</a><br><a target="_blank" href="http://vlog.17173.com/gc/">\u4f9b\u9700\u5e73\u53f0</a>&nbsp;&nbsp;<a target="_blank" href="http://vlog.17173.com/">\u64ad\u5ba2</a><br><a target="_blank" href="http://wow.17173.com/wowmv/">\u9b54\u517d</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://media.17173.com/dnf/">DNF</a><br><a target="_blank" href="http://media.17173.com/tl/">\u5929\u9f99\u516b\u90e8</a>&nbsp;&nbsp;<a target="_blank" href="http://media.17173.com/zt2/">\u5f81\u90142</a><br><a target="_blank" href="http://media.17173.com/lol/">LOL</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://media.17173.com/zhuanti/list/index.shtml">\u4e13\u9898 </a></div>');str.push('	<div class="g-topnav-nav-cnt-4">');str.push('	  <h3><a class="global-c4" target="_blank" href="http://bbs.17173.com/">\u4e92\u52a8\u4e2d\u5fc3</a></h3>');str.push('	  <a target="_blank" href="http://my.17173.com/">\u73a9\u5bb6\u4e2d\u5fc3</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://bbs.17173.com/">\u8bba\u575b</a><br><a target="_blank" href="http://shop.17173.com/">\u5546\u57ce</a>&nbsp;&nbsp;<a target="_blank" href="http://hao.17173.com/">\u53d1\u53f7</a>&nbsp;&nbsp;<a target="_blank" href="http://bk.17173.com/">\u767e\u79d1</a><br><a target="_blank" href="http://act.17173.com/">\u6d3b\u52a8</a>&nbsp;&nbsp;<a target="_blank" href="http://gh.17173.com/">\u516c\u4f1a</a>&nbsp;&nbsp;<a target="_blank" href="http://dkp.17173.com/">DKP</a><br><a target="_blank" href="http://book.17173.com/">\u8bfb\u4e66</a>&nbsp;&nbsp;<a target="_blank" href="http://blog.17173.com/">\u535a\u5ba2</a>&nbsp;&nbsp;<a target="_blank" href="http://t.sohu.com/17173">\u5fae\u535a</a><br><a target="_blank" href="http://mail.17173.com/">\u90ae\u7bb1</a>');str.push('	  </div>');str.push('	<div class="g-topnav-nav-cnt-5">');str.push('	  <a class="global-c5" target="_blank" href="http://newgame.17173.com/">\u7f51\u7edc\u6e38\u620f</a><br>');str.push('	  <a target="_blank" href="http://web.17173.com/">\u7f51\u9875\u6e38\u620f</a><br><a target="_blank" href="http://flash.17173.com/">flash\u5c0f\u6e38\u620f</a><br><a target="_blank" href="http://iphone.17173.com/">iPhone/iPad</a><br/><a target="_blank" href="http://esports.17173.com/">\u7535\u7ade</a>&nbsp;&nbsp;<a target="_blank" href="http://game.17173.com/">\u5355\u673a</a><br><a target="_blank" href="http://www.37wanwan.com/">\u4e0a\u53bb\u73a9\u73a9</a></div>');str.push('	 <div class="g-topnav-nav-cnt-8">');str.push('	  <h3><a class="global-c1" target="_blank" href="http://newgame.17173.com/">\u65b0\u7f51\u6e38</a></h3>');str.push('	  <a target="_blank" href="http://newgame.17173.com/gametest.shtml">\u6d4b\u8bd5\u8868</a>&nbsp;<a target="_blank" href="http://newgame.17173.com/hao/index.php">\u6fc0\u6d3b\u7801</a>&nbsp;<a target="_blank" href="http://newgame.17173.com/xw/test.shtml">\u8bc4\u6d4b</a><br><a target="_blank" href="http://newgame.17173.com/top50.shtml">\u671f\u5f85\u699c</a>&nbsp;<a target="_blank" href="http://newgame.17173.com/corp/">\u5382\u5546\u9ec4\u9875</a></div>');str.push('	<div class="g-topnav-nav-cnt-6"><a target="_blank" href="http://shendeng.17173.com/">17173\u6e38\u620f\u795e\u706f</a>\uff1a<br>');str.push('	  <a target="_blank" href="http://shendeng.17173.com/lol/">LOL</a> / <a target="_blank" href="http://shendeng.17173.com/dnf/">DNF</a> / <a target="_blank" href="http://xyq.17173.com/madown/madow08.htm">\u68a6\u5e7b</a> / <a target="_blank" href="http://shendeng.17173.com/cf/">CF</a> </div>');str.push('	<div class="g-topnav-nav-cnt-7"><a target="_blank" href="http://db.17173.com/">\u6e38\u620f\u6570\u636e\u5e93</a><br>');str.push('	  <a target="_blank" href="http://wow.db.17173.com/">WOW</a> / <a target="_blank" href="http://dnf.db.17173.com/">DNF</a> / <a target="_blank" href="http://lol.db.17173.com/">LOL</a> / <a target="_blank" href="http://ldj.db.17173.com/">\u9e7f\u9f0e\u8bb0</a> </div>');str.push('	  <div class="g-topnav-nav-cnt-9"><a target="_blank" href="http://download.17173.com/">\u6e38\u620f\u4e0b\u8f7d</a><br>');str.push('	  <a target="_blank" href="http://help.17173.com/">\u5e2e\u52a9\u4e2d\u5fc3</a></div>');str.push('	</div>');str.push('	<div class="g-topnav-news">');str.push('	  <div class="g-topnav-news-cnt" id="js-global-newsscroll"></div>');str.push('	</div>');str.push('	<div class="g-topnav-login" id="js-global-topnav-login"></div>');str.push('	<div id="js-global-topnav-login-tip" style="width:100%;position:relative;"></div>');str.push('	<div id="ppcontid"></div>');str.push('  </div>');str.push('</div>');$this.html(str.join(''))}function initEvent(){var hasfocus=false,hasfocus_timer;$('#js-global-submit3').click(function(){$(this).hide();$('#js-global-nav').val('').focus();hasfocus=true;setTimeout(function(){$('#js-global-nav-cnt').show()},100)});$('#js-global-nav').hover(function(){if(hasfocus||$(this).val()!='\u5168\u7ad9\u5bfc\u822a')return;$(this).addClass('g-topnav-txt1-hover');$('#js-global-nav-cnt').show()},function(){if(hasfocus||$(this).val()!='\u5168\u7ad9\u5bfc\u822a')return;$(this).removeClass('g-topnav-txt1-hover');hasfocus_timer=setTimeout(function(){$('#js-global-nav-cnt').hide()},300)}).click(function(){hasfocus=true;if($(this).val()=='\u5168\u7ad9\u5bfc\u822a'||$(this).val()==''){$('#js-global-submit2').hide();$(this).val('')}else{$(this).select();$('#js-global-submit3').show();$('.g-topnav-ac_results').show()}$('#js-global-search').show();$('#js-global-submit2').show();flag=false}).blur(function(){hasfocus=false;if($(this).val()==''||$(this).val()=='\u5168\u7ad9\u5bfc\u822a'){$('#js-global-submit2').hide();$('#js-global-submit3').hide();$(this).val('\u5168\u7ad9\u5bfc\u822a')}flag=true}).keyup(function(event){$('#js-global-submit3').show();$('#js-global-nav-cnt').hide();if($(this).val()==''){$('#js-global-nav-cnt').show();$('#js-global-submit3').hide()}if(event.keyCode==13){window.location='http://log1.17173.com/click?category=topnav&redirect=search.17173.com/jsp/news.jsp?charset=utf-8&keyword='+encodeURIComponent($(this).val())}}).global_autocomplete('http://search.17173.com/web/suggest.do',{width:150,minLength:2,selectFirst:false,autoFill:false,extraParams:{topN:8,'index-name':'SUGGEST'},formatItem:function(row,i,max){return'<a href="'+row.kindUrl+'">'+row.kindName+'</a>'},formatMatch:function(row,i,max){return row.kindName+" "+row.kindUrl},formatResult:function(row){return row.kindName}});$('#js-global-submit2').click(function(){window.location='http://log1.17173.com/click?category=topnav&redirect=search.17173.com/jsp/news.jsp?charset=utf-8&keyword='+encodeURIComponent($('#js-global-nav').val())});$('#js-global-nav-cnt').click(function(event){event.stopPropagation();$(this).show()}).hover(function(){flag=false;if(hasfocus)return;$('#js-global-nav').addClass('g-topnav-txt1-hover');if(hasfocus_timer)clearTimeout(hasfocus_timer);$(this).show()},function(){flag=true;if(hasfocus)return;$('#js-global-nav').removeClass('g-topnav-txt1-hover');$(this).hide()});$(document).click(function(){if(flag)$('#js-global-nav-cnt').hide()});var today=new Date();var tn_news=today.getFullYear()+''+(today.getMonth()+1)+''+today.getDate();$.ajax({type:"GET",url:'http://www.17173.com/topnav-news.js?'+tn_news,scriptCharset:'GBK',dataType:"script",success:function(data){var str=[];str.push('<ul>');for(var i=0;i<__GLOBAL_TOPNAV_NEWS.length;i++){if(typeof(__GLOBAL_TOPNAV_NEWS[i].url)!='undefined'&&typeof(__GLOBAL_TOPNAV_NEWS[i].title)!='undefined')str.push('<li><a href="'+__GLOBAL_TOPNAV_NEWS[i].url+'" target="_blank">'+__GLOBAL_TOPNAV_NEWS[i].title+'</a></li>')}str.push('</ul>');$('#js-global-newsscroll').html(str.join('')).newsscroll({time:3000});tongji('#js-global-newsscroll')}});$('#js-global-topnav-login').loginForTopbar({passportSC:opts.passportSC,tip:$('#js-global-topnav-login-tip')})}return this.each(function(){start();initEvent();tongji('#js-global-topnav')})};
	
$.fn.extend({global_autocomplete:function(urlOrData,options){var isUrl=typeof urlOrData=="string";options=$.extend({},$.global_Autocompleter.defaults,{url:isUrl?urlOrData:null,data:isUrl?null:urlOrData,delay:isUrl?$.global_Autocompleter.defaults.delay:10,max:options&&!options.scroll?10:150},options);options.highlight=options.highlight||function(value){return value};options.formatMatch=options.formatMatch||options.formatItem;return this.each(function(){new $.global_Autocompleter(this,options)})},result:function(handler){return this.bind("result",handler)},search:function(handler){return this.trigger("search",[handler])},flushCache:function(){return this.trigger("flushCache")},setOptions:function(options){return this.trigger("setOptions",[options])},unautocomplete:function(){return this.trigger("unautocomplete")}});

$.global_Autocompleter=function(input,options){var KEY={UP:38,DOWN:40,DEL:46,TAB:9,RETURN:13,ESC:27,COMMA:188,PAGEUP:33,PAGEDOWN:34,BACKSPACE:8};var $input=$(input).attr("autocomplete","off").addClass(options.inputClass);var timeout;var previousValue="";var cache=$.global_Autocompleter.Cache(options);var hasFocus=0;var lastKeyPressCode;var config={mouseDownOnSelect:false};var select=$.global_Autocompleter.Select(options,input,selectCurrent,config);var blockSubmit;$.browser.opera&&$(input.form).bind("submit.autocomplete",function(){if(blockSubmit){blockSubmit=false;return false}});$input.bind(($.browser.opera?"keypress":"keydown")+".autocomplete",function(event){hasFocus=1;lastKeyPressCode=event.keyCode;switch(event.keyCode){case KEY.UP:event.preventDefault();if(select.visible()){select.prev()}else{onChange(0,true)}break;case KEY.DOWN:event.preventDefault();if(select.visible()){select.next()}else{onChange(0,true)}break;case KEY.PAGEUP:event.preventDefault();if(select.visible()){select.pageUp()}else{onChange(0,true)}break;case KEY.PAGEDOWN:event.preventDefault();if(select.visible()){select.pageDown()}else{onChange(0,true)}break;case options.multiple&&$.trim(options.multipleSeparator)==","&&KEY.COMMA:case KEY.TAB:case KEY.RETURN:if(selectCurrent()){event.preventDefault();blockSubmit=true;window.location='http://log1.17173.com/click?category=topnav&redirect='+$('.g-topnav-ac_results a:contains("'+$('#js-global-nav').val()+'")').attr('href').split('//')[1];return false}break;case KEY.ESC:select.hide();break;default:clearTimeout(timeout);timeout=setTimeout(onChange,options.delay);break}}).focus(function(){hasFocus++}).blur(function(){hasFocus=0;if(!config.mouseDownOnSelect){hideResults()}}).click(function(){if(hasFocus++>1&&!select.visible()){onChange(0,true)}}).bind("search",function(){var fn=(arguments.length>1)?arguments[1]:null;function findValueCallback(q,data){var result;if(data&&data.length){for(var i=0;i<data.length;i++){if(data[i].result.toLowerCase()==q.toLowerCase()){result=data[i];break}}}if(typeof fn=="function")fn(result);else $input.trigger("result",result&&[result.data,result.value])}$.each(trimWords($input.val()),function(i,value){request(value,findValueCallback,findValueCallback)})}).bind("flushCache",function(){cache.flush()}).bind("setOptions",function(){$.extend(options,arguments[1]);if("data"in arguments[1])cache.populate()}).bind("unautocomplete",function(){select.unbind();$input.unbind();$(input.form).unbind(".autocomplete")});function selectCurrent(){var selected=select.selected();if(!selected)return false;var v=selected.result;previousValue=v;if(options.multiple){var words=trimWords($input.val());if(words.length>1){var seperator=options.multipleSeparator.length;var cursorAt=$(input).selection().start;var wordAt,progress=0;$.each(words,function(i,word){progress+=word.length;if(cursorAt<=progress){wordAt=i;return false}progress+=seperator});words[wordAt]=v;v=words.join(options.multipleSeparator)}v+=options.multipleSeparator}$input.val(v);hideResultsNow();$input.trigger("result",[selected.data,selected.value]);return true}function onChange(crap,skipPrevCheck){if(lastKeyPressCode==KEY.DEL){select.hide();return}var currentValue=$input.val();if(!skipPrevCheck&&currentValue==previousValue)return;previousValue=currentValue;currentValue=lastWord(currentValue);if(currentValue.length>=options.minChars){$input.addClass(options.loadingClass);if(!options.matchCase)currentValue=currentValue.toLowerCase();request(currentValue,receiveData,hideResultsNow)}else{stopLoading();select.hide()}};function trimWords(value){if(!value)return[""];if(!options.multiple)return[$.trim(value)];return $.map(value.split(options.multipleSeparator),function(word){return $.trim(value).length?$.trim(word):null})}function lastWord(value){if(!options.multiple)return value;var words=trimWords(value);if(words.length==1)return words[0];var cursorAt=$(input).selection().start;if(cursorAt==value.length){words=trimWords(value)}else{words=trimWords(value.replace(value.substring(cursorAt),""))}return words[words.length-1]}function autoFill(q,sValue){if(options.autoFill&&(lastWord($input.val()).toLowerCase()==q.toLowerCase())&&lastKeyPressCode!=KEY.BACKSPACE){$input.val($input.val()+sValue.substring(lastWord(previousValue).length));$(input).selection(previousValue.length,previousValue.length+sValue.length)}};function hideResults(){clearTimeout(timeout);timeout=setTimeout(hideResultsNow,200)};function hideResultsNow(){var wasVisible=select.visible();select.hide();clearTimeout(timeout);stopLoading();if(options.mustMatch){$input.search(function(result){if(!result){if(options.multiple){var words=trimWords($input.val()).slice(0,-1);$input.val(words.join(options.multipleSeparator)+(words.length?options.multipleSeparator:""))}else{$input.val("");$input.trigger("result",null)}}})}};function receiveData(q,data){if(data&&data.length&&hasFocus){stopLoading();select.display(data,q);autoFill(q,data[0].value);select.show()}else{hideResultsNow()}};function request(term,success,failure){if(!options.matchCase)term=term.toLowerCase();var data=cache.load(term);if(data&&data.length){success(term,data)}else if((typeof options.url=="string")&&(options.url.length>0)){var extraParams={timestamp:+new Date()};$.each(options.extraParams,function(key,param){extraParams[key]=typeof param=="function"?param():param});$.ajax({mode:"abort",port:"autocomplete"+input.name,type:"GET",dataType:'jsonp',url:options.url,scriptCharset:'UTF-8',data:$.extend({q:lastWord(term),limit:options.max},extraParams),success:function(data){var parsed=parse(data);success(term,parsed)}})}else{select.emptyList();failure(term)}};function parse(data){var parsed=[];var rows=data;for(var i=0;i<rows.length;i++){var row=rows[i];if(row){parsed.push({data:row,value:row.kindName,result:options.formatResult&&options.formatResult(row,row.kindName)||row.kindName})}}return parsed};function stopLoading(){$input.removeClass(options.loadingClass)}};

$.global_Autocompleter.defaults={inputClass:"ac_input",resultsClass:"g-topnav-ac_results",loadingClass:"ac_loading",minChars:1,delay:400,matchCase:false,matchSubset:true,matchContains:false,cacheLength:10,max:100,mustMatch:false,extraParams:{},selectFirst:true,formatItem:function(row){return row[0]},formatMatch:null,autoFill:false,width:0,multiple:false,multipleSeparator:", ",highlight:function(value,term){return value.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)("+term.replace(/([\^\$\(\)\[\]\{\}\*\.\+\?\|\\])/gi,"\\$1")+")(?![^<>]*>)(?![^&;]+;)","gi"),"<strong>$1</strong>");},scroll:true,scrollHeight:180};$.global_Autocompleter.Cache=function(options){var data={};var length=0;function matchSubset(s,sub){if(!options.matchCase)s=s.toLowerCase();var i=s.indexOf(sub);if(options.matchContains=="word"){i=s.toLowerCase().search("\\b"+sub.toLowerCase());}if(i==-1)return false;return i==0||options.matchContains;};function add(q,value){if(length>options.cacheLength){flush();}if(!data[q]){length++;}data[q]=value;}function populate(){if(!options.data)return false;var stMatchSets={},nullData=0;if(!options.url)options.cacheLength=1;stMatchSets[""]=[];for(var i=0,ol=options.data.length;i<ol;i++){var rawValue=options.data[i];rawValue=(typeof rawValue=="string")?[rawValue]:rawValue;var value=options.formatMatch(rawValue,i+1,options.data.length);if(value===false)continue;var firstChar=value.charAt(0).toLowerCase();if(!stMatchSets[firstChar])stMatchSets[firstChar]=[];var row={value:value,data:rawValue,result:options.formatResult&&options.formatResult(rawValue)||value};stMatchSets[firstChar].push(row);if(nullData++<options.max){stMatchSets[""].push(row);}};$.each(stMatchSets,function(i,value){options.cacheLength++;add(i,value);});}setTimeout(populate,25);function flush(){data={};length=0;}return{flush:flush,add:add,populate:populate,load:function(q){if(!options.cacheLength||!length)return null;if(!options.url&&options.matchContains){var csub=[];for(var k in data){if(k.length>0){var c=data[k];$.each(c,function(i,x){if(matchSubset(x.value,q)){csub.push(x);}});}}return csub;}else if(data[q]){return data[q];}else if(options.matchSubset){for(var i=q.length-1;i>=options.minChars;i--){var c=data[q.substr(0,i)];if(c){var csub=[];$.each(c,function(i,x){if(matchSubset(x.value,q)){csub[csub.length]=x;}});return csub;}}}return null;}};};$.global_Autocompleter.Select=function(options,input,select,config){var CLASSES={ACTIVE:"g-topnav-ac_over"};var listItems,active=-1,data,term="",needsInit=true,element,list;function init(){if(!needsInit)return;element=$("<div/>").hide().addClass(options.resultsClass).css("position","absolute").appendTo(document.body);list=$("<ul/>").appendTo(element).mouseover(function(event){if(target(event).nodeName&&target(event).nodeName.toUpperCase()=='LI'){active=$("li",list).removeClass(CLASSES.ACTIVE).index(target(event));$(target(event)).addClass(CLASSES.ACTIVE);$(target(event)).find('a').each(function(){if($(this).attr('href').indexOf('http://log1.17173.com/click?category=topnav&redirect=')==-1)$(this).attr("href",'http://log1.17173.com/click?category=topnav&redirect='+$(this).attr('href').split('//')[1]);});}}).click(function(event){$(target(event)).addClass(CLASSES.ACTIVE);select();input.focus();}).mousedown(function(){config.mouseDownOnSelect=true;}).mouseup(function(){config.mouseDownOnSelect=false;});if(options.width>0)element.css("width",options.width);needsInit=false;}function target(event){var element=event.target;while(element&&element.tagName!="LI")element=element.parentNode;if(!element)return[];return element;}function moveSelect(step){listItems.slice(active,active+1).removeClass(CLASSES.ACTIVE);movePosition(step);var activeItem=listItems.slice(active,active+1).addClass(CLASSES.ACTIVE);if(options.scroll){var offset=0;listItems.slice(0,active).each(function(){offset+=this.offsetHeight;});if(typeof(activeItem[0])!='undefined'){if((offset+activeItem[0].offsetHeight-list.scrollTop())>list[0].clientHeight){list.scrollTop(offset+activeItem[0].offsetHeight-list.innerHeight());}else if(offset<list.scrollTop()){list.scrollTop(offset);}}else{list.scrollTop(0);}}};function movePosition(step){active+=step;if(active<0){active=-1;}else if(active>=listItems.size()){active=-1;}}function limitNumberOfItems(available){return options.max&&options.max<available?options.max:available;}function fillList(){list.empty();var max=limitNumberOfItems(data.length);for(var i=0;i<max;i++){if(!data[i])continue;var formatted=options.formatItem(data[i].data,i+1,max,data[i].value,term);if(formatted===false)continue;var li=$("<li/>").html(options.highlight(formatted,term)).addClass(i%2==0?"g-topnav-ac_even":"g-topnav-ac_odd").appendTo(list)[0];$.data(li,"ac_data",data[i]);}listItems=list.find("li");if(options.selectFirst){listItems.slice(0,1).addClass(CLASSES.ACTIVE);active=0;}if($.fn.bgiframe)list.bgiframe();}return{display:function(d,q){init();data=d;term=q;fillList();},next:function(){moveSelect(1);},prev:function(){moveSelect(-1);},pageUp:function(){if(active!=0&&active-8<0){moveSelect(-active);}else{moveSelect(-8);}},pageDown:function(){if(active!=listItems.size()-1&&active+8>listItems.size()){moveSelect(listItems.size()-1-active);}else{moveSelect(8);}},hide:function(){element&&element.hide();listItems&&listItems.removeClass(CLASSES.ACTIVE);active=-1;},visible:function(){return element&&element.is(":visible");},current:function(){return this.visible()&&(listItems.filter("."+CLASSES.ACTIVE)[0]||options.selectFirst&&listItems[0]);},show:function(){var offset=$(input).offset();element.css({width:typeof options.width=="string"||options.width>0?options.width:$(input).width(),top:offset.top+input.offsetHeight,left:offset.left}).show();if(options.scroll){list.scrollTop(0);list.css({maxHeight:options.scrollHeight,overflow:'auto'});if($.browser.msie&&typeof document.body.style.maxHeight==="undefined"){var listHeight=0;listItems.each(function(){listHeight+=this.offsetHeight;});var scrollbarsVisible=listHeight>options.scrollHeight;list.css('height',scrollbarsVisible?options.scrollHeight:listHeight);if(!scrollbarsVisible){listItems.width(list.width()-parseInt(listItems.css("padding-left"))-parseInt(listItems.css("padding-right")));}}}},selected:function(){var selected=listItems&&listItems.filter("."+CLASSES.ACTIVE).removeClass(CLASSES.ACTIVE);return selected&&selected.length&&$.data(selected[0],"ac_data");},emptyList:function(){list&&list.empty();},unbind:function(){element&&element.remove();}};};$.fn.selection=function(start,end){if(start!==undefined){return this.each(function(){if(this.createTextRange){var selRange=this.createTextRange();if(end===undefined||start==end){selRange.move("character",start);selRange.select();}else{selRange.collapse(true);selRange.moveStart("character",start);selRange.moveEnd("character",end);selRange.select();}}else if(this.setSelectionRange){this.setSelectionRange(start,end);}else if(this.selectionStart){this.selectionStart=start;this.selectionEnd=end;}});}var field=this[0];if(field.createTextRange){var range=document.selection.createRange(),orig=field.value,teststring="<->",textLength=range.text.length;range.text=teststring;var caretAt=field.value.indexOf(teststring);field.value=orig;this.selection(caretAt,caretAt+textLength);return{start:caretAt,end:caretAt+textLength}}else if(field.selectionStart!==undefined){return{start:field.selectionStart,end:field.selectionEnd}}};
	
	$( '#js-global-topnav' ).main( {passportSC:$.extend(true, {}, global.PassportSC)} ); 
};

function doShowTopnav(){
	if( !global.jQuery || !global.PassportSC ) return;
	if( global.jQuery( '#js-global-topnav' ).length == 0 )
		global.jQuery( 'body' ).prepend( '<div id="js-global-topnav"></div>' );

	global_topnav_main( global.jQuery );	
}

if( !document.getElementById('css-gtp') ){
		LazyLoad.css(['http://ue8.17173.itc.cn/cache/lib/v1/topnav-1.0/global-topbar.css?20120615'], function(){});
	}

if( typeof(global.jQuery) == 'undefined' ){
	LazyLoad.js(['http://ue8.17173.itc.cn/cache/lib/v1/jquery-1.4.min.js'], function(){doShowTopnav();});
}

if( typeof(global.PassportSC) == 'undefined' ){
	LazyLoad.js(['http://ue1.17173.itc.cn/spp/spp_core.js[charset=gbk]'], function(){doShowTopnav();});
}

doShowTopnav();

})(this);