function _jc_g_kw(){if(_jcrf=="")return"?t?=";var e=0,t,n;if((e=_jcrf.indexOf("://"))<0)return"0?t?=0";t=_jcrf.substring(e+3,_jcrf.length),t.indexOf("/")>-1&&(t=t.substring(0,t.indexOf("/")));for(var r=0;r<_jcsr.length;r++)if(t.toLowerCase().indexOf(_jcsr[r].toLowerCase())>-1)if((e=_jcrf.indexOf("?"+_jckw[r]+"="))>-1||(e=_jcrf.indexOf("&"+_jckw[r]+"="))>-1)return n=_jcrf.substring(e+_jckw[r].length+2,_jcrf.length),(e=n.indexOf("&"))>-1&&(n=n.substring(0,e)),_jcsr[r]+"?t?="+_jc_f_cr(n);return"0?t?=0"}function _jc_f_cr(e){var t="";if(!e||e=="")return"";for(var n=0;n<e.length;n++)e.charAt(n)==" "?t+="+":t+=e.charAt(n);return t}function _jc_f_ie_t(){var e=navigator.userAgent.toLowerCase();return e.indexOf("qqbrowser")>-1||e.indexOf("tencenttraveler")>-1?"qq":e.indexOf("maxthon")>-1?"ma":e.indexOf("360se")>-1?"36":e.indexOf("theworld")>-1?"th":e.indexOf(" se ")>-1?"se":e.indexOf("msie")>-1?"ie":e.indexOf("firefox")>-1?"ff":e.indexOf("chrome")>-1?"ch":e.indexOf("opera")>-1?"op":e.indexOf("safari")>-1?"sa":"0"}function _jc_f_ie(){var e={},t=navigator.userAgent.toLowerCase(),n;return(n=t.match(/msie ([\d.]+)/))?e.ie=n[1]:(n=t.match(/firefox\/([\d.]+)/))?e.firefox=n[1]:(n=t.match(/chrome\/([\d.]+)/))?e.chrome=n[1]:(n=t.match(/opera\/([\d.]+)/))?e.opera=n[1]:(n=t.match(/version\/([\d.]+).*safari/))?e.safari=n[1]:0,e.ie?"IE: "+e.ie:e.firefox?"Firefox: "+e.firefox:e.chrome?"Chrome: "+e.chrome:e.opera?"Opera: "+e.opera:e.safari?"Safari: "+e.safari:"0"}function _jc_f_bw(){_jcbw[0]=navigator.appName,_jcbw[7]=navigator.language,_jcbw[0]=="Netscape"?_jcbw[7]=navigator.language:_jcbw[0]=="Microsoft Internet Explorer"&&(_jcbw[7]=navigator.userLanguage),_jcbw[1]=_jc_f_ie(),_jcbw[2]=navigator.javaEnabled()?1:0,_jcbw[3]=_jc_g_fl(),_jcbw[4]=_jc_g_os();if(self.screen)sr=screen.width+"x"+screen.height,sc=screen.colorDepth+"-bit";else if(self.java){var e=java.awt.Toolkit.getDefaultToolkit(),t=e.getScreenSize();sr=t.width+"x"+t.height}_jcbw[5]=sr,_jcbw[6]=sc,_jcbw[8]=navigator.cookieEnabled?1:0,_jcbw[10]=_jc_f_ie_t()}function _jc_g_fl(){var f="-1",n=navigator;if(n.plugins&&n.plugins.length){for(var ii=0;ii<n.plugins.length;ii++)if(n.plugins[ii].name.indexOf("Shockwave Flash")!=-1){f=n.plugins[ii].description.split("Shockwave Flash ")[1];break}}else if(window.ActiveXObject)for(var ii=20;ii>=2;ii--)try{var fl=eval("new ActiveXObject('ShockwaveFlash.ShockwaveFlash."+ii+"');");if(fl){f=ii+".0";break}}catch(e){}return f=="-1"?f:f.substring(0,f.indexOf(".")+2)}function _jc_g_os(){var e={},t=navigator.userAgent.toLowerCase(),n;return(n=t.match(/windows nt ([\d.]+)/))?e.nt=n[1]:(n=t.match(/mac os x ([\d.-_]+)/))?e.mac=n[1]:(n=t.match(/android ([\d.]+)/))?e.and=n[1]:(n=t.match(/iphone os ([\d_]+)/))?e.iph=n[1]:(n=t.match(/linux ([\w]+)/))?e.linux=n[1]:0,e.nt?"WindowsNT:"+e.nt:e.mac?"MacOSX:"+e.mac:e.and?"Android:"+e.and:e.iph?"Iphone:"+e.iph:e.linux?"Linux:"+e.linux:"0"}function _jc_f_rp(e,t,n){var r="",i="",s,o=t.length;s=e.indexOf(t);while(s!=-1)r=e.substr(0,s),e=e.substr(s+o),i=i+r+n,s=e.indexOf(".");return i+=e,i}function _jc_g_co(e){var t=e+"=",n,r,i=_jcd.cookie;return t=="="?i:(n=i.indexOf(t),n<0?"":(r=i.indexOf(";",n+e.length),r<0?i.substring(n+e.length+1):i.substring(n+e.length+1,r)))}function _jc_s_co(e,t,n){_jcd.cookie=e+"="+t+";path=/;"+n+"domain="+_jc_g_h()}function _jc_g_dm(e){return e=e.substr(7,e.length),e.indexOf("/")>0&&(e=e.substr(0,e.indexOf("/"))),e}function _jc_g_h(){var e=_jcda,t="",n="",r=!1;for(var i=0;i<_jcexl.length;i++){n=new RegExp(""+_jc_f_rp(_jcexl[i],".","\\.")+"$");if(n.test(e)){r=!0,t=_jcexl[i],e=e.substr(0,e.lastIndexOf(t)),e.lastIndexOf(".")>0&&(e=e.substr(e.lastIndexOf(".")+1));break}}return r?e+t:"auto"}function _jc_f_trim(e){return e.replace(/\s+/g,"")}function _jc_f_void(){return}function _jc_f_getads(){var e=_jcl.indexOf("ads="),t="",n="0";return e!=-1&&(t=_jc_f_trim(_jcl.substr(e+4,32)),t.length==32&&/^[a-f0-9]+$/gi.test(t)==1&&(n=t)),n}function _jc_f_init(){var e,t=escape(_jcin.getTime()*1e3+Math.round(Math.random()*2147483647)),n,r=new Image(0,0),i=new Image(0,0);_jcrf==""?(_jcrf="0",e="0"):e=_jc_g_dm(_jcrf);var s=_jc_g_co("ONLINE_TIME"),o=0;if(s=="")s=_jcin.getTime(),_jc_s_co("ONLINE_TIME",s,"");else{var u=_jcin.getTime();o=Math.round((parseInt(u)-parseInt(s))/1e3);if(isNaN(o)||o<0)o=0;_jc_s_co("ONLINE_TIME",u,"")}_ssid=_jc_g_co("sessionid"),_ssid2=_jc_g_co("sessionid2");var a=new Date;a.setTime(a.getTime()+18e5),_ssid==""||_ssid!=_ssid2||_ssid.indexOf("|")==-1?(_ssid=t,_svn=1,_jc_s_co("sessionid",_ssid+"|"+_svn,"expires="+a.toGMTString()+";"),_jc_s_co("sessionid2",_ssid+"|"+_svn,"")):(_svn=_ssid.split("|")[1],_svn=!isNaN(_svn)&&_svn!=""?parseInt(_svn)+1:1,_ssid=_ssid.split("|")[0],_jc_s_co("sessionid",_ssid+"|"+_svn,"expires="+a.toGMTString()+";"),_jc_s_co("sessionid2",_ssid+"|"+_svn,"")),_diff=_jc_g_co("DIFF"),_diff=!isNaN(_diff)&&_diff!=""?parseInt(_diff):0,a=new Date,_ssid2==""||_ssid2.indexOf("|")>0&&_ssid!=_ssid2.split("|")[0]?(_diff>0&&(_diff=a.getTime()-_diff),_jc_s_co("DIFF",a.getTime(),"expires=Sun, 29 July 2046 00:00:00 UTC;")):_diff=0,_diff=Math.ceil(_diff/36e5),_diff=_diff>0?_diff:0,_jc_uv=_jc_g_co("SUV"),_jc_uv==""&&(_jc_uv=t,_jc_s_co("SUV",_jc_uv,"expires=Sun, 29 July 2046 00:00:00 UTC;"),_jc_nuv=1),_jc_f_bw(),_jcbw[9]=0;try{top.location!=self.location&&e.indexOf(".17173.")==-1&&(e=3,_jcbw[9]=3)}catch(f){e=3}_jcrf.indexOf("#")>-1&&(_jcrf=_jcrf.substring(0,_jcrf.indexOf("#"))),r.src=_jcrqurl+"ping.gif?"+t+"?t?="+_jc_uv+"?t?="+_jc_nuv+"?t?="+e+"?t?="+_jcrf+"?t?="+_jcda+"?t?="+_jc_g_kw()+"?t?="+_jc_f_trim(_jcbw[1])+"?t?="+_jcbw[2]+"?t?="+_jcbw[3]+"?t?="+_jc_f_trim(_jcbw[4])+"?t?="+_jcbw[5]+"?t?="+_jcbw[6]+"?t?="+_jcbw[7]+"?t?="+_jcbw[8]+"?t?="+_jcbw[9]+"?t?="+_jcbw[10]+"?t?="+o+"?t?=",r.onload=function(){_jc_f_void()};var l=_jc_f_getads();i.src="http://log1.17173.com/ping.gif?"+t+"?t?="+_jc_uv+"?t?="+_jc_nuv+"?t?="+e+"?t?="+_jcrf+"?t?="+_jcda+"?t?="+_jc_g_kw()+"?t?="+_jc_f_trim(_jcbw[1])+"?t?="+_jcbw[2]+"?t?="+_jcbw[3]+"?t?="+_jc_f_trim(_jcbw[4])+"?t?="+_jcbw[5]+"?t?="+_jcbw[6]+"?t?="+_jcbw[7]+"?t?="+_jcbw[8]+"?t?="+_jcbw[9]+"?t?="+_jcbw[10]+"?t?="+o+"?t?="+l+"?t?="+_ssid+"?t?="+_svn+"?t?="+_diff+"?t?=",i.onload=function(){_jc_f_void()}}var _jcexl=new Array(".com.cn",".net.cn",".org.cn",".gov.cn",".com",".cn",".net",".org",".mobi",".biz",".cc",".us",".info",".name",".tv",".asia",".hk"),_jcsr=new Array,_jckw=new Array;_jcsr[0]="baidu",_jckw[0]="word",_jcsr[1]="baidu",_jckw[1]="wd",_jcsr[2]="google",_jckw[2]="q",_jcsr[3]="soso",_jckw[3]="w",_jcsr[4]="live",_jckw[4]="q",_jcsr[5]="yahoo",_jckw[5]="p",_jcsr[6]="qq",_jckw[6]="w",_jcsr[7]="sogou",_jckw[7]="query",_jcsr[8]="3721",_jckw[8]="name",_jcsr[9]="iask",_jckw[9]="k",_jcsr[10]="zhongsou",_jckw[10]="word",_jcsr[11]="alexa",_jckw[11]="q",_jcsr[12]="163",_jckw[12]="q",_jcsr[13]="msn",_jckw[13]="q",_jcsr[14]="aol",_jckw[14]="query",_jcsr[15]="aol",_jckw[15]="encquery",_jcsr[16]="lycos",_jckw[16]="query",_jcsr[17]="ask",_jckw[17]="q",_jcsr[18]="altavista",_jckw[18]="q",_jcsr[19]="netscape",_jckw[19]="query",_jcsr[20]="cnn",_jckw[20]="query",_jcsr[21]="about",_jckw[21]="terms",_jcsr[22]="mamma",_jckw[22]="query",_jcsr[23]="alltheweb",_jckw[23]="q",_jcsr[24]="gigablast",_jckw[24]="q",_jcsr[25]="virgilio",_jckw[25]="qs",_jcsr[26]="alice",_jckw[26]="qs",_jcsr[27]="aol",_jckw[27]="q",_jcsr[28]="mama",_jckw[28]="query",_jcsr[29]="search",_jckw[29]="q",_jcsr[30]="yam",_jckw[30]="k",_jcsr[31]="360",_jckw[31]="q";var _jcd=document,_jcl=_jcd.location.toString(),_jcrf=_jcd.referrer,_jcda=_jc_g_dm(_jcl),_jcur=_jcd.url,_jcin=new Date,_jcrqurl="http://logs.17173.com/",_jc_uv="",_jc_nuv=0,_jcbw=new Array,_ssid="",_ssid2="",_svn="",_diff="",_jc_spv_stat;_jc_spv_stat||_jc_f_init(),_jc_spv_stat=1,window._adref||(function(){function o(){return e.parse(window.location.href).query[t]||""}function u(){var t="";if(!document.referrer)return t;var n=e.parse(document.referrer);for(var r=0;r<s.length;r++){var i=s[r];if(i.hostname.test(n.hostname)){t=n.query[i.keyword];break}}return t}function a(e,t,n){n.raw||(t=encodeURIComponent(String(t)));var r=e+"="+t;n.expires&&(r+="; expires="+n.expires.toGMTString()),n.domain&&(r+="; domain="+n.domain),n.path&&(r+="; path="+n.path),document.cookie=r}function f(e,t){t=t||{},t.expires=new Date(0),a(e,"",t)}function l(){var e=o();if(!e)return;var t=u();if(/\.17173\.com$/.test(window.location.hostname))a(n,e,i),t?a(r,t,i):f(r,i);else{var s="http://passport.17173.com/adref_cross.php";s+="?"+n+"="+e,s+="&"+r+"="+t;var l=document.createElement("div");l.style.display="none",l.innerHTML='<iframe src="'+s+'" width="0" height="0" frameborder="0" border="0" scrolling="no"></iframe>',document.body.appendChild(l)}}var e=function(){function t(e){return Object.prototype.toString.apply(e)==="[object Array]"}var e=/^([^\:]+)\:\/\/([^\:\/\?]+)(\:\d+)?(\/[^\?]*)?(\?.*)?$/;return{parse:function(n){var r=n.match(e);if(!r)return null;var i=r[2],s={};if(r[5]){var o=r[5].substr(1).split("&");for(var u=0;u<o.length;u++){var a=o[u].split("="),f=a[0],l=a[1];s.hasOwnProperty(f)?t(s[f])?s[f].push(l):s[f]=[s[f],l]:s[f]=l}}return{hostname:i,query:s}}}}(),t="adref",n="ad_analysis_source",r="ad_analysis_keyword",i={domain:".17173.com",path:"/",expires:new Date((new Date).getTime()+216e5),raw:!0},s=[{hostname:/\.baidu\.com/,keyword:"wd"},{hostname:/\.sogou\.com/,keyword:"query"},{hostname:/\.360\.cn/,keyword:"q"},{hostname:/\.google\.com/,keyword:"q"},{hostname:/\.soso\.com/,keyword:"w"}];l()}(),window._adref=1)