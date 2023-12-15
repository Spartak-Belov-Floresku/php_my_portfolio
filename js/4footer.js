
	window.addEventListener("scroll", function() {
		
		var goup = getElemId("goUp");
			var floatcontentScroll = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
				var heightVideoHolder = 0;
			if(getElemClass("firstdiv")[0]){
				heightVideoHolder =  getElemClass("firstdiv")[0].clientHeight;
			}
			
		if(floatcontentScroll >= heightVideoHolder){
			goup.style.transition = "transform .1s linear 0s, opacity .15s linear 0s";
				goup.style.mozTransition = "-moz-transform .1s linear 0s, opacity .15s linear 0s";
					goup.style.webkitTransition = "-webkit-transform .1s linear 0s, opacity .15s linear 0s";
						goup.style.transform = ("scale(1)");
							goup.style.mozTransform = ("scale(1)");
						goup.style.webkitTransform = ("scale(1)");
					goup.style.msTransform = ("scale(1)");
				goup.style.OTransform = ("scale(1)");
			goup.style.opacity = 1;
		}else{
			goup.style.transform = ("scale(0)");
				goup.style.mozTransform = ("scale(0)");
					goup.style.webkitTransform = ("scale(0)");
					goup.style.msTransform = ("scale(0)");
				goup.style.OTransform = ("scale(0)");
			goup.style.opacity = 0;
		}
		
	});
	
	
	var dis = 0;
	
	var goUP = function(){
		removeclickscroll();
		dis++;
		var currentY = window.pageYOffset;
			var floatcontentScroll = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
				var animator = setTimeout('goUP()', 30);
		if(floatcontentScroll > 0){
			if(floatcontentScroll < currentY/1.5){
				dis--;
			}
				window.scroll(0,currentY - dis);
		}else{
			dis = 0;
			clearTimeout(animator);
		}
	}
	
	function putgoup(pic){
		getElemId("goUp").style.right = ((window.innerWidth - getElemId('container').offsetWidth)/2)+pic+"px";
	}