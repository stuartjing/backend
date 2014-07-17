//http://dota2.v2/item/item_clarity
//var $wowReg1 = $wowReg2 = /http:\/\/dota2\..+\/(hero|item|skill)\/([a-z_0-9]+)/;	//match

var $wowReg1 = $wowReg2 = /.+(hero|item|skill)\/([a-z_0-9]+)/;	//match
var $wowTipsLoaded = false;
var $wowbaseURL = host+'/';
var $ajaxtipsURL = $wowbaseURL+'tips';
var $wowPageCharset = "gb2312";
var $wowLinkTarget = "_blank";

	if (document.all) {
		window.attachEvent('onload', WowLoad);
	}else {
		window.addEventListener('load', WowLoad, false);
	}

	function WowLoad(){
		var AK=document.createElement("div");
		AK.id="WowTipInfoLayers";
		document.body.appendChild(AK);
		var A = document.body.getElementsByTagName("A");
		for(i=0;i<A.length;i++){
			var tipval = A[i].getAttribute('tipurl');
			if(tipval!=undefined){
				if($wowReg1.test(tipval)){
					var P = getitemid(tipval);
					Wowattaching(A[i],P[0],P[1],P[2]);
				}
			}
		}
		
		//var re = /<meta.*charset=([^"]+).*?>/i;
		var charset=document.characterSet?document.characterSet:document.charset;
		if (charset&&charset!=""){
			$wowPageCharset = charset;
		}
	}

function Wowcc(layerid,s){
	var obj = document.getElementById(layerid);
	if (obj){
		//
	}
	else{
		var AK=document.createElement("div");
		AK.id=layerid;
		AK.style.display="none";
		AK.innerHTML=s; 
		document.body.appendChild(AK);
		//instant show tooltip content
		$wowTipsLoaded = true;
		Tooltip.tooltipTd.innerHTML=s;
	}
}
function WoWoAE(obj,eventname,func){
	if(window.attachEvent){
		obj.attachEvent("on"+eventname,func)
	}
	else{
		obj.addEventListener(eventname,func,false)
	}
}
function Wowattaching(element,id,t,l){
	WoWoAE(element,"mouseover",function(event){WowKL(event,id,t,l)});
	WoWoAE(element,"mousemove",function(event){WowKU(event,id,t,l)});
	WoWoAE(element,"mouseout",function(event){Tooltip.hide();$wowTipsLoaded=false;});
}   
function WowKL(event,id,t,l){
	//event= window.event?window.event:arguments[0];
	if (ItemContainerNotExists(id,t,l)&&$wowTipsLoaded==false){
		var AK=document.createElement("script");
		AK.type = "text/javascript";
		//console.log($ajaxtipsURL+".html?c="+$wowPageCharset+"&t="+t+"&l="+l+"&id="+id);
		//AK.src = $ajaxtipsURL+"&c="+$wowPageCharset+"&t="+t+"&l="+l+"&id="+id;	//a call
		AK.src = $ajaxtipsURL+".html?c="+$wowPageCharset+"&t="+t+"&l="+l+"&id="+id;	//a call
		document.getElementsByTagName("head")[0].appendChild(AK);	//add head
	}
	Tooltip.showAtCursor(event,loadItemInfo(id,t,l),0,0,'');
}
function WowKU(event,id,t,l){
	if (ItemContainerNotExists(id,t,l)==false&&$wowTipsLoaded){
		Tooltip.cursorUpdate(event);
	}
	else{
		Tooltip.showAtCursor(event,loadItemInfo(id,t,l),0,0,'');
	}
}
function ItemContainerNotExists(id,itemtype,language){
	var obj = document.getElementById(itemtype+language+id+"c");
	if (obj){
		return false;
	}
	else{
		return true;
	}
}
function loadItemInfo(id,itemtype,language){
	var obj = document.getElementById(itemtype+language+id+"c");
	//alert(obj);
	if (obj){
		$wowTipsLoaded = true;
		return obj.innerHTML;
	}
	else{
		$wowTipsLoaded = false;
		return '<div class="i-hero-box i-f-mod-w" style="text-align: center;width:100px">Loading...</div>';
	}
}
function WowAA(e,n,v){
	var aa = document.createAttribute(n);
	aa.value = v;
	e.setAttributeNode(aa);
}
function getitemid(s){//http://www.wowdb.cn/item-34332.html
	if ($wowReg1.test(s)){
		L = s.match($wowReg1);
		if (L[1]&&L[2]){
			return [L[2],L[1],"zhCN"];
		}
		else{
			return [-1,"",""];
		}
	}
	else if ($wowReg2.test(s)){
		L = s.match($wowReg2);
		if (L[1]&&L[2]){
			return [L[2],L[1],"zhCN"];
		}
		else{
			return [-1,"",""];
		}
	}
	else{
		return [-1,"",""];
	}
}
function clang(s){
	s = s.toLowerCase();
	switch(s) 
   {
    case "en":
	case "enus":
	case "engb":
        return "enUS";
        break;
    case "cn":
	case "zhcn":
        return "zhCN";
        break;
    case "tw":
	case "zhtw":
        return "zhTW";
        break;
    case "kr":
    case "kokr":
        return "koKR";
        break;
    default:
        return "zhCN";
        break;
    }
}
function registerScripts(){
	var Q=document.getElementsByTagName("head")[0];	
	var AK=document.createElement("link");	
	AK.type = "text/css";
	AK.href = $wowbaseURL+"css/tips_out.css";
	AK.rel = "stylesheet";
	Q.appendChild(AK);	
	AK=document.createElement("script");	
	AK.type = "text/javascript";
	AK.src = $wowbaseURL+"js/global_out.js"
	Q.appendChild(AK);
}
registerScripts();
