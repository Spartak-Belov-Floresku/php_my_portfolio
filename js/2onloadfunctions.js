	window.onload = function (){

		// body opacity------------------------------------------------------------------------------------------------

			var container = getElemId("container");
			container.style.transition = ".2s linear";
			container.style.webkitTransition = ".2s linear";
			container.style.mozTransition = ".2s linear";
			container.style.msTransition = ".2s linear";
			container.style.oTransition = ".2s linear";
			setTimeout(function(){container.style.opacity = 1;getElemId("startloader").style.display = "none";},230);
		
		// header -----------------------------------------------------------------------------------------------------
			
			//antibot function
			setTimeout(function (){antibot();},20000);
			
			
			//heightContainer("container");
		
		//about page---------------------------------------------------------------------------------------------------
			
			heightAbout();
				putCenterHeight();
			
			if(getElemId("about"))
				setTimeout(function (){runtext()},1000);
			
		//portfolio -----------------------------------------------------------------------------------------------------
		
		heightPortfolio();
		
		//codes----------------------------------------------------------------------------------------------------------
		
			
				drivecode();
				setTimeout(function(){
					positiondrivecode();
					padingtopcode();
					excodeheight();
				},150);
				setTimeout(function(){;
					firstparonfirstload();
					if(getElemClass("scrollToDiv")){
						window.scroll(0,0);
					}
				},180);
				
			
		//contact page---------------------------------------------------------------------------------------------------
			
			putForm();
			
			if(getElemId("contactcontent")){
				var p = getElemId("contactcontent").getElementsByTagName("form")[0].getElementsByTagName("p");
				for(i = 0; i<p.length; i++){
					p[i].setAttribute("onclick","reliseTag(this)");
				}
			}
			if(getElemId("textarea")){
				getElemId("textarea").addEventListener('keyup', function(){lengthMessage(500);},false);
			}
			if(getElemId("textarea")){
				getElemId("textarea").addEventListener('focus', function(){addClassSpan()},false);
			}
			if(getElemId("textarea")){
				getElemId("textarea").addEventListener('blur', function(){addClassSpan()},false);
			}
		
		//footer-------------------------------------------------------------------------------------------------------
		
			putgoup(10);
				getElemId("goUp").addEventListener('click',function(){goUP();},false);
		
	}