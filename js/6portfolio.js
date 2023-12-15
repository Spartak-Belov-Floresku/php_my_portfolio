function heightPortfolio(){
		if(getElemId("portfolio")){
			
			var pdiv = getElemClass("pdiv");
			var totalheight = 0;
			
			for(var i = 0; i < pdiv.length; i++){
				
				if(pdiv[i].hasAttribute("style"))
					pdiv[i].removeAttribute("style");
				
				var rec = pdiv[i].getBoundingClientRect()
				
				totalheight += rec.height;
			}
				
				
			var heightBrowser  = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
				
			if(totalheight < heightBrowser){
				var def = ((heightBrowser - totalheight)/2)-100;
				
				for(var i = 0; i < pdiv.length; i++){
					
					pdiv[i].style.height = totalheight/2 + def + "px";
				}
				
			}
			
			
				for(var i = 0; i < pdiv.length; i++){
					
					//pdiv[i].style.paddingTop = 100+"px";
				}
				
			
			
		}
	}