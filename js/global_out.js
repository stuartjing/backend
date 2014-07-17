function wOw(_1){
	if(arguments.length>1){
		var _2=[];
		for(var i=0,len=arguments.length;i<len;++i){
			_2.push(wOw(arguments[i]));
			
		}return _2;
		
	}if(typeof _1=="string"){
		_1=ge(_1);
		
	}return _1;
	
}

function wOwE(e){
	if(!e){
		e=event;
	}
	e._button=e.which?e.which:e.button;			//dom
	e._target=e.target?e.target:e.srcElement;	//dom
	return e;
}
function wOwA(a){
	var r=[];
	for(var i=0,len=a.length;i<len;++i){
		r.push(a[i]);
		
	}return r;
	
}Function.prototype.bind=function (){
	var _8=this,args=wOwA(arguments),object=args.shift();
	return function (){
		return _8.apply(object,args.concat(wOwA(arguments)));
		
	};
	
};
function strcmp(a,b){
	if(a==b){
		return 0;
		
	}if(a==null){
		return -1;
		
	}if(b==null){
		return 1;
		
	}return a<b?-1:1;
	
}function trim(_b){
	return _b.replace(/(^\s*|\s*$)/g,"");
	
}function rtrim(z,y){
	var a=z.length;
	while(--a>0&&z.charAt(a)==y){
		
	}z=z.substring(0,a+1);
	if(z==y){
		z="";
		
	}return z;
	
}function sprintf(z){
	for(var i=1,len=arguments.length;i<len;++i){
		z=z.replace("$"+i,arguments[i]);
		
	}return z;
	
}function str_replace(z,a,b){
	while(z.indexOf(a)!=-1){
		z=z.replace(a,b);
		
	}return z;
	
}function urlencode(z){
	z=encodeURIComponent(z);
	z=str_replace(z,"+","%2B");
	return z;
	
}function number_format(z){
	z=""+parseInt(z);
	if(z.length<=3){
		return z;
		
	}return number_format(z.substr(0,z.length-3))+","+z.substr(z.length-3);
	
}function in_array(a,r,f){
	if(a==null){
		return -1;
		
	}if(f){
		return in_arrayf(a,r,f);
		
	}for(var i=0,len=a.length;i<len;++i){
		if(a[i]==r){
			return i;
			
		}
	}return -1;
	
}function in_arrayf(a,r,f){
	for(var i=0,len=a.length;i<len;++i){
		if(f(a[i])==r){
			return i;
			
		}
	}return -1;
	
}function array_walk(a,f,ud){
	var res;
	for(var i=0,len=a.length;i<len;++i){
		res=f(a[i],ud,a,i);
		if(res!=null){
			a[i]=res;
			
		}
	}
}
function ge(z){
	return document.getElementById(z);
}
function gE(z,y){
	return z.getElementsByTagName(y);
	
}
function ce(z){
	return document.createElement(z);
	
}function de(z){
	z.parentNode.removeChild(z);
	
}function ae(z,y){
	return z.appendChild(y);
	
}function ct(z){
	return document.createTextNode(z);
	
}function rf(){
	return false;
	
}function tb(){
	this.blur();
	
}
function ac(z){
	var a=0,b=0;
	while(z){
		a+=z.offsetLeft;
		b+=z.offsetTop;
		z=z.offsetParent;
		
	}return [a,b];
	
}function aE(z,y,x){
	if(Browser.ie){
		z.attachEvent("on"+y,x);
		
	}else {
		z.addEventListener(y,x,false);
		
	}
}function sp(z){
	if(!z){
		z=event;
		
	}if(Browser.ie){
		z.cancelBubble=true;
		
	}else {
		z.stopPropagation();
		
	}
}function sc(z,y,x,w,v){
	var a=new Date();
	var b=z+"="+escape(x)+"; ";
	a.setDate(a.getDate()+y);
	b+="expires="+a.toUTCString()+"; ";
	if(w){
		b+="path="+w+"; ";
		
	}if(v){
		b+="domain="+v+"; ";
		
	}document.cookie=b;
	
}function dc(z){
	sc(z,-1);
	
}function gc(z){
	var b,c;
	if(!z){
		var a=[];
		c=document.cookie.split("; ");
		for(var i=0;i<c.length;++i){
			b=c[i].split("=");
			a[b[0]]=unescape(b[1]);
			
		}return a;
		
	}else {
		b=document.cookie.indexOf(z+"=");
		if(b!=-1){
			if(b==0||document.cookie.substring(b-2,b)=="; "){
				b+=z.length+1;
				c=document.cookie.indexOf("; ",b);
				if(c==-1){
					c=document.cookie.length;
					
				}return unescape(document.cookie.substring(b,c));
				
			}
		}
	}return null;
	
}function ns(n){
	n.onmousedown=n.onselectstart=n.ondragstart=rf;
	if(Browser.ie){
		n.onfocus=tb;
		
	}
}function cO(d,s){
	for(var p in s){
		d[p]=s[p];
		
	}
}var Browser={
	ie:!!(window.attachEvent&&!window.opera),opera:!!window.opera,safari:navigator.userAgent.indexOf("Safari")!=-1,gecko:navigator.userAgent.indexOf("Gecko")!=-1&&navigator.userAgent.indexOf("KHTML")==-1
};
Browser.ie7=Browser.ie&&navigator.userAgent.indexOf("MSIE 7.0")!=-1;
Browser.ie6=Browser.ie&&navigator.userAgent.indexOf("MSIE 6.0")!=-1&&!Browser.ie7;
navigator.userAgent.match(/Gecko\/([0-9]+)/);
Browser.geckoVersion=parseInt(RegExp.$1)|0;
function g_getWindowSize(){
	var _41=0,height=0;
	if(typeof window.innerWidth=="number"){
		_41=window.innerWidth;
		height=window.innerHeight;
		
	}else {
		if(document.documentElement&&(document.documentElement.clientWidth||document.documentElement.clientHeight)){
			_41=document.documentElement.clientWidth;
			height=document.documentElement.clientHeight;
			
		}else {
			if(document.body&&(document.body.clientWidth||document.body.clientHeight)){
				_41=document.body.clientWidth;
				height=document.body.clientHeight;
				
			}
		}
	}
	return [_41-380,height];
	
}
function g_getScroll(){
	var x=0,y=0;
	if(typeof (window.pageYOffset)=="number"){
		x=window.pageXOffset;
		y=window.pageYOffset;
		
	}else {
		if(document.body&&(document.body.scrollLeft||document.body.scrollTop)){
			x=document.body.scrollLeft;
			y=document.body.scrollTop;
			
		}else {
			if(document.documentElement&&(document.documentElement.scrollLeft||document.documentElement.scrollTop)){
				x=document.documentElement.scrollLeft;
				y=document.documentElement.scrollTop;
				
			}
		}
	}return [x,y];
	
}function g_scrollTo(n,p){
	var _,windowSize=g_getWindowSize(),scroll=g_getScroll(),bcw=windowSize[0],bch=windowSize[1],bsl=scroll[0],bst=scroll[1];
	n=wOw(n);
	if(p==null){
		p=[];
		
	}else {
		if(typeof p=="number"){
			p=[p];
			
		}
	}_=p.length;
	if(_==0){
		p[0]=p[1]=p[2]=p[3]=0;
		
	}else {
		if(_==1){
			p[1]=p[2]=p[3]=p[0];
			
		}else {
			if(_==2){
				p[2]=p[0];
				p[3]=p[1];
				
			}else {
				if(_==3){
					p[3]=p[1];
					
				}
			}
		}
	}_=ac(n);
	var nl=_[0]-p[3];
	var nt=_[1]-p[0];
	var nr=_[0]+n.offsetWidth+p[1];
	var nb=_[1]+n.offsetHeight+p[2];
	if(nr-nl>bcw||nl<bsl){
		bsl=nl;
		
	}else {
		if(nr-bcw>bsl){
			bsl=nr-bcw;
			
		}
	}if(nb-nt>bch||nt<bst){
		bst=nt;
		
	}else {
		if(nb-bch>bst){
			bst=nb-bch;
			
		}
	}scrollTo(bsl,bst);
	
}function g_setTextNodes(n,_4b){
	if(n.nodeType==3){
		n.nodeValue=_4b;
		
	}else {
		for(var i=0;i<n.childNodes.length;++i){
			g_setTextNodes(n.childNodes[i],_4b);
			
		}
	}
}function g_setSelectedLink(n,_4e){
	if(!g_setSelectedLink.groups){
		g_setSelectedLink.groups=[];
		
	}var _=g_setSelectedLink.groups;
	if(_[_4e]){
		_[_4e].className="";
		
	}n.className="selected";
	_[_4e]=n;
	
}function g_toggleDisplay(el){
	if(el.style.display=="none"){
		el.style.display="";
		return true;
		
	}else {
		el.style.display="none";
		return false;
		
	}
}
function g_createGlow(txt,cn){
	var s=ce("span");
	for(var i=-1;i<=1;++i){
		for(var j=-1;j<=1;++j){
			var d=ce("div");
			d.style.position="absolute";
			d.style.whiteSpace="nowrap";
			d.style.left=i+"px";
			d.style.top=j+"px";
			if(i==0&&j==0){
				d.style.zIndex=4;
				
			}else {
				d.style.color="black";
				d.style.zIndex=2;
				
			}ae(d,ct(txt));
			ae(s,d);
			
		}
	}s.style.position="relative";
	s.className="glow"+(cn!=null?" "+cn:"");
	var ph=ce("span");
	ph.style.visibility="hidden";
	ae(ph,ct(txt));
	ae(s,ph);
	return s;
	
}
function g_appendReputation(d,_7d,_7e,_7f){
	d=wOw(d);
	var a=ce("a");
	a.href="javascript:;";
	a.onmousedown=rf;
	a.className="reputation";
	var div=ce("div");
	div.className="reputation-text";
	var del=ce("del");
	ae(del,ct(g_reputation_standings[_7d]));
	ae(div,del);
	var ins=ce("ins");
	ae(ins,ct(_7f));
	ae(div,ins);
	ae(a,div);
	div=ce("div");
	div.className="reputation-bar"+_7d;
	if(_7e<=0||_7e>100){
		div.style.visibility="hidden";
		
	}div.style.width=_7e+"%";
	ae(div,ct(String.fromCharCode(160)));
	ae(a,div);
	ae(d,a);
}
var Icon={
	sizes:["small","medium","large"],create:function (_fb,_fc,_fd,_fe,num,qty){
		var _;
		var icon=ce("div"),tile=ce("div"),hover=ce("div");
		icon.className="icon"+Icon.sizes[_fc];
		if(_fb!=null){
			icon.style.backgroundImage="url(/icons/"+Icon.sizes[_fc]+"/"+_fb.toLowerCase()+".jpg)";
			
		}tile.className="tile";
		hover.className="hover";
		if(_fd){
			hover.tooltip=(_fd.length?_fd:null);
			hover.onmouseover=Icon.over;
			hover.onmouseout=Icon.out;
			
		}if(typeof (_fe)=="string"){
			var a=ce("a");
			a.href=_fe;
			ae(hover,a);
			
		}else {
			if(_fc==2){
				hover.ondblclick=function (){
					prompt("",_fb);
					
				};
				
			}
		}if(num!=null&&(num>1||num.length)){
			_=g_createGlow(num,"q1");
			_.style.right="0";
			_.style.bottom="0";
			_.style.position="absolute";
			ae(tile,_);
			
		}if(qty!=null&&qty>0){
			_=g_createGlow("("+qty+")","q");
			_.style.left="0";
			_.style.top="0";
			_.style.position="absolute";
			ae(tile,_);
			
		}ae(tile,hover);
		ae(icon,tile);
		return icon;
		
	},over:function (){
		if(!Icon.hilite){
			var _=ce("div");
			_.className="hilite";
			Icon.hilite=_;
			
		}this.parentNode.insertBefore(Icon.hilite,this.parentNode.lastChild.nextSibling);
		Icon.hilite.style.display="";
		if(this.tooltip!=null){
			Tooltip.show(this,this.tooltip,0,0);
			
		}
	},out:function (){
		if(Icon.hilite){
			Icon.hilite.style.display="none";
			
		}Tooltip.hide();
		
	}
};
var Tooltip={
	clip:"main-contents",create:function (_105){
		var d=ce("div"),t=ce("table"),tb=ce("tbody"),tr1=ce("tr"),tr2=ce("tr"),td=ce("td"),th1=ce("th"),th2=ce("th"),th3=ce("th");
		d.className="tooltip";
		th1.style.backgroundPosition="top right";
		th2.style.backgroundPosition="bottom left";
		th3.style.backgroundPosition="bottom right";
		if(_105){
			td.innerHTML=_105;
		}
		ae(tr1,td);
		ae(tr1,th1);
		ae(tb,tr1);
		ae(tr2,th2);
		ae(tr2,th3);
		ae(tb,tr2);
		ae(t,tb);
		ae(d,t);
		return d;
	},
	// 
	fix:function (_107,_108,_109){
		var _10a=gE(_107,"table")[0],td=gE(_10a,"td")[0],c=td.childNodes;
		if(c.length>=2&&c[0].nodeName=="TABLE"&&c[1].nodeName=="TABLE"){
			var m;
			if(c[1].offsetWidth>300){
				m=Math.max(300,c[0].offsetWidth)+20;
			}else {
				m=Math.max(c[0].offsetWidth,c[1].offsetWidth)+20;
			}
			if(m>20){
				_107.style.width=m+"px";
				c[0].style.width=c[1].style.width="100%";
				if(!_108&&_107.offsetHeight>document.body.clientHeight){
					_10a.className="shrink";
				}
			}
		}if(_109){
			_107.style.visibility="visible";
		}
	}
	,fixSafe:function (p1,p2,p3){
		if(Browser.ie){
			setTimeout(Tooltip.fix.bind(this,p1,p2,p3),1);
			
		}else {
			Tooltip.fix(p1,p2,p3);
			
		}
	},append:function (el,_110){
		var el=wOw(el);
		var _112=Tooltip.create(_110);
		ae(el,_112);
		Tooltip.fixSafe(_112,1,1);
		
	},
	
	prepare:function (){
		if(!Tooltip.tooltip){
			var _=Tooltip.create();
			_.style.position="absolute";
			_.style.zIndex="400";
			_.style.left=_.style.top="-2323px";
			var lay=ge("WowTipInfoLayers");
			ae(lay,_);
			Tooltip.tooltip=_;
			Tooltip.tooltipTable=gE(_,"table")[0];
			Tooltip.tooltipTd=gE(_,"td")[0];
			if(Browser.ie6){
				_=ce("iframe");
				//_.src="javascript:0;";
				_.frameBorder=0;
				ae(lay,_);
				Tooltip.iframe=_;
			}
		}
	},
	move:function (x,y,w1,h1,_119,_11a,clip,_11c,tow,toh){
		
		var _,left=x,top=y,minx=0,miny=0,windowSize=g_getWindowSize(),scroll=g_getScroll(),bcw=windowSize[0],bch=windowSize[1],bsl=scroll[0],bst=scroll[1];
		if(clip==null){
			clip=Tooltip.clip;
		}if(_11c==null){
			_11c=Tooltip.tooltip;
			tow=Tooltip.tooltipTable.offsetWidth;
			toh=Tooltip.tooltipTable.offsetHeight;
		}
		_11c.style.width=tow+"px";
		if(clip){
			_=ge(clip);	
			if(_){
				c=ac(_);
				minx=c[0];
				miny=c[1];
				if(_.offsetWidth+minx<=bsl+bcw){
					bcw=_.offsetWidth+minx-bsl-100;
				}if(_.offsetHeight+miny<=bst+bch){
					bch=_.offsetHeight+miny-bst-100;
				}
			}
		}
		
		//if(left+w1+tow>bcw){
		//	left=Math.max(left-tow,minx)-_119;
		//}else {
			left+=w1+_119;
		//}
		if(left<minx){
			left=minx;
		}else {
			//alert(left+'+'+tow+'>'+bsl+'+'+bcw);
			if(left+tow>bsl+bcw){
				left=bsl+bcw-tow;
			}
		}

		if(top-toh>Math.max(bst,miny)){
			top-=toh+_11a;
		}else {
			top+=h1+_11a;
		}
		
		if(top<miny){
			top=miny;
		}else {
			if(top+toh>bst+bch){
				top=Math.max(bst,bst+bch-toh);
			}
		}
		
		_11c.style.left=left+"px";
		_11c.style.top=top+"px";
		_11c.style.visibility="visible";
		if(Browser.ie6&&Tooltip.iframe){
			_=Tooltip.iframe;
			_.style.filter="alpha(opacity=0)";
			_.style.opacity="0";
			_.style.position="absolute";
			_.style.zIndex="1";
			_.style.left=left+"px";
			_.style.top=top+"px";
			_.style.width=tow+"px";
			_.style.height=toh+"px";
			_.style.display="";
			_.style.visibility="visible";
			
		}
	},show:function (_120,text,x,y,_124){
		if(Tooltip.disabled){
			return ;
		}
		var _;
		Tooltip.prepare();
		if(typeof text=="object"){
			text=text[0];
		}if(_124){
			text="<span class=\""+_124+"\">"+text+"</span>";
		}_=Tooltip.tooltip;
		_.style.width="350px";
		_.style.left="-2323px";
		_.style.top="-2323px";
		Tooltip.tooltipTd.innerHTML=text;
		_.style.display="";
		var _126=ac(_120);
		Tooltip.fix(_,0,0);
		Tooltip.move(_126[0],_126[1],_120.offsetWidth,_120.offsetHeight,x,y);
		
	},
	showAtCursor:function (_127,text,x,y,_12b){
		if(Tooltip.disabled){
			return ;
		}
		if(!x||x<10){
			x=10;
		}
		if(!y||y<10){
			y=10;
			
		}
		_127=wOwE(_127);
		var _;
		Tooltip.prepare();
		if(typeof text=="object"){
			text=text[0];
		}
		
		if(_12b){
			text="<span class=\""+_12b+"\">"+text+"</span>";
		}
		
		_=Tooltip.tooltip;
		_.style.width="350px";
		_.style.left="-2323px";
		_.style.top="-2323px";
		Tooltip.tooltipTd.innerHTML=text;
		_.style.display="";

		var _12d=g_getScroll();
		Tooltip.fix(_,0,0);
		Tooltip.move(_127.clientX+_12d[0],_127.clientY+_12d[1],0,0,x,y);
		
	},cursorUpdate:function (_12e,x,y){
		if(Tooltip.disabled||!Tooltip.tooltip){
			return ;
			
		}_12e=wOwE(_12e);
		if(!x||x<10){
			x=10;
			
		}if(!y||y<10){
			y=10;
			
		}var _131=g_getScroll();
		Tooltip.move(_12e.clientX+_131[0],_12e.clientY+_131[1],0,0,x,y);
		
	},hide:function (){
		if(Tooltip.tooltip){
			Tooltip.tooltip.style.display="none";
			Tooltip.tooltip.style.visibility="hidden";
			Tooltip.tooltipTable.className="";
			if(Browser.ie6){
				Tooltip.iframe.style.display="none";
				Tooltip.iframe.style.visibility="hidden";
			}
		}
	}
};