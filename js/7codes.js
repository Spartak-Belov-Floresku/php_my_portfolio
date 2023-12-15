
function drivecode(){
	
	if(getElemId("drivecode")){
		var divs = getElemId("code").getElementsByTagName("div");
		
		var ids = new Array();
		
		for(var i = 0; i < divs.length; i++){
			var id = divs[i].getAttribute("id");
			if(id != "drivecode")
				ids.push(id);
		}
		
		var drivecodediv = getElemId("drivecode");
		
		var p = "";
		
		for(var i = 0; i < ids.length; i++){
			
				p += "<p data-id='"+ ids[i] +"' class='scrollToDiv' onclick='slidetocode(this); scrolltodiv(this)'><img src='images/"+ ids[i] +".png' alt='"+ ids[i] +"'/></p>";
		}
		
		drivecodediv.innerHTML = p;
	}
	
}

function positiondrivecode(){
	var drivecodediv = getElemId("drivecode");
	var header = getElemId("header");
	if(drivecodediv){
		drivecodediv.removeAttribute("style");
		var heightw = isNaN(window.innerHeight) ? window.clientHeight : window.innerHeight;
		var heightdrivecode = drivecodediv.clientHeight;
		var heightheader = header.clientHeight;
		var topdrivecode = (heightw/2)-(heightdrivecode/2)+(heightheader/2);
		drivecodediv.style.top = topdrivecode+"px";
		setTimeout(function (){drivecodediv.setAttribute("class","drivecodeopasity");},300);
	}
}

function padingtopcode(){
	var code = getElemId("code");
	if(code){
		var header = getElemId("header");
		var heightheader = header.clientHeight;
		code.style.paddingTop = heightheader+"px";
	}
}


function scrolltodiv(el){
	if(getElemId(el.getAttribute("data-id"))){
		var classes = getElemClass(el.getAttribute("class"));
		for(var i = 0; i < classes.length; i++){
			classes[i].removeAttribute("data-class");
		}
		el.setAttribute("data-class","active");
		el.removeAttribute("onclick");
	}
}

function removeclickscroll(){
	if(getElemClass("scrollToDiv")){
		
		var classes = getElemClass("scrollToDiv");
		for(var i = 0; i < classes.length; i++){
			classes[i].removeAttribute("data-class");
			classes[i].setAttribute("onclick","slidetocode(this); scrolltodiv(this)");
		}
		upcheck = false;
			downcheck = false;
				checkpoint = 0;
		clearTimeout(animatorscroll);
		firstparonfirstload();
		
	}
}

function firstparonfirstload(){
	if(getElemClass("scrollToDiv")[0]){
			getElemClass("scrollToDiv")[0].setAttribute("data-class","active");
			getElemClass("scrollToDiv")[0].removeAttribute("onclick");
	}
}


var scrollY = 0;
var distances = 20;
var speed = 8;
var checkpoint = 0;
var upcheck = false;
var downcheck = false;
var animatorscroll = "";

function slidetocode(el){
	
	if(getElemId(el.getAttribute("data-id"))){
		var currentY = window.pageYOffset;
			var scrollDoc = (document.scrollingElement || document.documentElement).scrollTop;
				var rect = getElemId(el.getAttribute("data-id")).getBoundingClientRect();
					var bodyHeight = document.body.offsetHeight;
				var yPos = currentY + window.innerHeight;
			var heightheader = getElemId("header").clientHeight;
		animatorscroll = setTimeout(function(){slidetocode(el);}, speed);
		
		var classes = getElemClass(el.getAttribute("class"));
		
		if(scrollDoc == bodyHeight){
			console.log("first");
			for(var i = 0; i < classes.length; i++){
				classes[i].setAttribute("onclick","slidetocode(this); scrolltodiv(this)");
			}
			el.removeAttribute("onclick");
			upcheck = false;
				downcheck = false;
					checkpoint = 0;
			clearTimeout(animatorscroll);
			
		}else{
			
			if(heightheader < rect.top && !downcheck){
				
				scrollY = currentY + distances;
					window.scroll(0,scrollY);
				upcheck = true;
				
			}
			
			if(heightheader > rect.top && upcheck){
				
				scrollY--;
					window.scroll(0,scrollY);
					downcheck = true;
				return;
				
			}
			
			if(heightheader > rect.top && !upcheck){
				
				scrollY = currentY - distances;
					window.scroll(0,scrollY);
				downcheck = true;
				
			}
			
			if(heightheader > rect.top && downcheck){
				
				scrollY++;
					window.scroll(0,scrollY);
				return;
				
			}
			
			if(heightheader == rect.top){
				
				for(var i = 0; i < classes.length; i++){
					classes[i].setAttribute("onclick","slidetocode(this); scrolltodiv(this)");
				}
				el.removeAttribute("onclick");
				upcheck = false;
					downcheck = false;
						checkpoint = 0;
				clearTimeout(animatorscroll);
				
			}
			
			if(checkpoint == rect.top){
				
				for(var i = 0; i < classes.length; i++){
					classes[i].setAttribute("onclick","slidetocode(this); scrolltodiv(this)");
				}
				el.removeAttribute("onclick");
					upcheck = false;
						downcheck = false;
					checkpoint = 0;
				clearTimeout(animatorscroll);
				
			}
			
			checkpoint = rect.top;
			
		}
	}
}


function excodeheight(){
	var excode = getElemClass("excode");
	var insideexcode = getElemClass("insideexcode");
	if(excode.length > 1){
		var infoexcode = excode[0].getBoundingClientRect();
		var wdexcode = infoexcode.width;
		for(var i = 0; i < excode.length; i++){
			excode[i].style.height = wdexcode*1.2 +"px";
			excode[i].setAttribute("onclick","ajaxgetanotherpage(this)");
		}
		
		setTimeout(function(){
			infoexcode = excode[0].style.height;
			for(var i = 0; i < insideexcode.length; i++){
				insideexcode[i].removeAttribute("style");
			}
		},100);
		setTimeout(function(){
			infoexcode = excode[0].style.height;
			for(var i = 0; i < insideexcode.length; i++){
				insideexcode[i].style.height = infoexcode;
			}
		},200);
		setTimeout(function(){
			for(var i = 0; i < insideexcode.length; i++){
				insideexcode[i].style.top = 0;
				var tops = excode[i].getElementsByTagName("p")[0].clientHeight;
				insideexcode[i].style.top = "-"+tops+"px";
			}
		},300);
	
	}	
}

var ref_elem ="";

function sizeDiv(div,topspace,leftspace,width,height){
			div.style.top = topspace+"px";
				div.style.left = leftspace+"px";
			div.style.width = width+"px";
		div.style.height = height+"px";
}

function requestpage(page, load){
	var hr = new XMLHttpRequest();
		hr.open("GET","agaxrequestpages/"+page+".php",true);
		hr.setRequestHeader('Content-type', 'text/html');
		hr.onreadystatechange = function(){
			if(hr.readyState == 4 && hr.status == 200){
				load.parentNode.removeChild(load);
				getElemId("loadDiv").innerHTML = hr.responseText;
			}
		}
		hr.send(null);
}
	
function ajaxgetanotherpage(elem){
	var contentpage = getElemId("contentpage");
	if(contentpage){
		disableScrolling();
		ref_elem = elem;
		contentpage.style.display = "block";
	var rect = elem.getBoundingClientRect();
		contentpage.style.top = rect.top + "px";
		contentpage.style.left = rect.left + "px";
			contentpage.style.width = elem.offsetWidth + "px";
			contentpage.style.height = elem.offsetHeight + "px";
				contentpage.style.transition = ".25s ease-in-out";
				contentpage.style.webkitTransition = ".25s ease-in-out";
				contentpage.style.mozTransition = ".25s ease-in-out";
				contentpage.style.opacity = .3;
				var loadDiv = document.createElement('div');
				loadDiv.setAttribute("class","loadDiv");
					setTimeout(function(){
						sizeDiv(contentpage, 0, 0, window.innerWidth, window.innerHeight);
						contentpage.style.opacity = 1;
					},100);
					setTimeout(function(){
						contentpage.appendChild(loadDiv);
						requestpage(elem.getAttribute("data-page"), loadDiv);
					},500);
	}
	
}

function closecontentpage(){
	var contentpage = getElemId("contentpage");
	var rect = ref_elem.getBoundingClientRect();
		contentpage.style.top = rect.top + "px";
		contentpage.style.left = rect.left + "px";
			contentpage.style.width = ref_elem.offsetWidth + "px";
			contentpage.style.height = ref_elem.offsetHeight + "px";
			contentpage.style.opacity = 0;
			setTimeout(function(){
				contentpage.removeAttribute("style");
				enableScrolling();
				getElemId("loadDiv").innerHTML = "";
			},300);
}

function disableScrolling(){
    var y = window.pageYOffset;
    window.onscroll=function(){window.scrollTo(0, y);};
}

function enableScrolling(){
    window.onscroll=function(){};
}

function browsercontentpage(){
	var contentpage = getElemId("contentpage");
	if(contentpage){
		setTimeout(function(){excodeheight();},100);
		sizeDiv(contentpage, 0, 0, window.innerWidth, window.innerHeight);
	}
}
