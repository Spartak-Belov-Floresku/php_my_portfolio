
	function heightAbout(){
		if(getElemId("about")){
			
			var about = getElemId("about");
				
			if(about.hasAttribute("style"))
				about.removeAttribute("style");
				
			var heightBrowser  = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
										
			about.style.height = heightBrowser+"px";
					
			var descriptiontext = getElemId("descriptiontext");
				
			if(descriptiontext.hasAttribute("style"))
				descriptiontext.removeAttribute("style");
				
			var subdescription = getElemClass("subdescription");
			
			for(var i = 0; i < subdescription.length; i++){
				if(subdescription[i].hasAttribute("style"))
					subdescription[i].removeAttribute("style");
			}
			
			var descriptiontextRect = descriptiontext.getBoundingClientRect();
			
			if(descriptiontextRect.height < heightBrowser){
				
				descriptiontext.style.height = heightBrowser+"px";
				
				var totalH = 0; 
				
				for(var i = 0; i < subdescription.length; i++){
					var rec = subdescription[i].getBoundingClientRect();
						totalH += rec.height;
				}
				
				descriptiontextRect = descriptiontext.getBoundingClientRect();
			
				if(descriptiontextRect.height > totalH){
					var marginsubdescription = (descriptiontextRect.height - totalH)/2;
						subdescription[0].style.paddingTop = marginsubdescription+"px";
				}
			}
			
		}
	}
	
	function putCenterHeight(){
		if(getElemId("about")){
			var face = getElemId("myface");
				var about =  getElemId("about");
					var heightf = face.offsetHeight;
						var heighta = about.offsetHeight;
					var margintop = (heighta/2) -  (heightf/2);
				face.style.top = margintop-20+"px";
			getElemClass("titlewho")[0].style.marginTop = margintop-15+"px";
		}
	}

	
	// running text-------------------------------------------------------------------------------------------------
	
	var words = new Array("Web developer...","Back-End development...", "PHP(OOP/MVC), LAMP...", "Java EE, Tomcat...", "Front-End development...", "JavaScript, jQuery, HTML5, CSS3...", "Responsive design...", "Cross-browser compatibility...");
		var letter = 0;
			var count = 0;
				var timerRunText = 100;
	
	var run;

	function runtext(){
		run = setInterval(function (){
			
						var word = words[count].split("");
							var displayword = getElemId("runningtext").innerHTML;
										var index = displayword.indexOf("<span");
										displayword = displayword.substring(0,index);
											displayword += word[letter];
												getElemId("runningtext").innerHTML = displayword+"<span id='st'>|</span>";
							letter++;
						if(letter == words[count].length){
							letter = 0;
							count++;
							aboutinueruntext();
						}
					},timerRunText);
	}

	function aboutinueruntext(){
		
		clearInterval(run);
		
		var st = getElemId("st");
		
		setTimeout(function (){st.style.opacity = 0;},300);
			setTimeout(function (){st.style.opacity = 1;},600);
				setTimeout(function (){st.style.opacity = 0;},900);
					setTimeout(function (){st.style.opacity = 1;},1200);
			
		
		
			setTimeout(function (){
				run = setInterval(function (){
					if(letter == 0){
						getElemId("runningtext").innerHTML = "";
					}
					if(count == words.length){
						count = 0;
					}
					var word = words[count].split("");
						var displayword = getElemId("runningtext").innerHTML;
							var index = displayword.indexOf("<span");
							displayword = displayword.substring(0,index);
								displayword += word[letter];
									getElemId("runningtext").innerHTML = displayword+"<span id='st'>|</span>";
						letter++;
					if(letter == words[count].length){
						letter = 0;
						count++;
						aboutinueruntext();
					}
				},timerRunText);
				
			}, 1500);
			
	}
	
	
	
	
	//scroll down----------------------------------------------------------------------------------------------------
	
	var distance = 0;
	var oo = 0;
	function scrollupabout(){
		var about = getElemId("about");
			var abouth = about.offsetHeight;
				var currentY = window.pageYOffset;
			var floataboutentScroll = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
		var animator = setTimeout('scrollupabout()', 30);
		
		if(floataboutentScroll != abouth){ 
		
			if((floataboutentScroll > abouth)){
				currentY--;
					window.scroll(0,currentY);
					return;
			}
			
			if(floataboutentScroll > abouth/1.5){
				distance--;
			}
				currentY = currentY + distance;
					window.scroll(0,currentY);
			
		}else{
			distance = 0;
				clearTimeout(animator);
		}
		
		distance++;
	}


	