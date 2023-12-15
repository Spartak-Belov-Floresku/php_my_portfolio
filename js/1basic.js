	function getElemId(id) {
		if (document.getElementById) {
			return document.getElementById(id);
		}

		else if (document.all) {
			return window.document.all[id];
		}

		else if (document.layers) {
			return window.document.layers[id];
		}
	} 
	
	function getElemClass(matchClass){
		if (!document.getElementsByClassName){
			var elements = document.getElementsByTagName('*'),
				i=0,
				nodeList = [],
				reg = new RegExp('(^|\\s)' + matchClass + '(\\s|$)')
		   
			for (i=0; i < elements.length;i++)
			{
				if(elements[i].className.match(reg) !== null){
					 nodeList.push(elements[i]);
				}
			}
			return nodeList;
		}else{
			return document.getElementsByClassName(matchClass);
		}
	}

	/*function heightContainer(id){
		
		var cont = getElemId(id);
			
			if(cont.hasAttribute("style"))
				cont.removeAttribute("style");
			
			var heightCont = cont.offsetHeight;
				var heightBrowser = window.innerHeight
										|| document.documentElement.clientHeight
										|| document.body.clientHeight;
										
					if(heightCont < heightBrowser)
						cont.style.height = heightBrowser+"px";
	}*/

	// protect from bots----------------------------------------------------------------------------------------------------------
	
	function antibot(){
		var hr = new XMLHttpRequest();
		hr.open("POST","antibot.php",true);
		hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function(){
				if(hr.readyState == 4 && hr.status == 200){
					if(hr.responseText.length !== 0){
						//alert(hr.responseText);
						var d = JSON.parse(hr.responseText);
						///alert(JSON.stringify(d));
							for(var o in d){
								if(o == "antibot1"){
									if(getElemId("antibot1")){
										getElemId("antibot1").value = d[o];
									}
								}
							}
					}
				}
		
		}
		hr.send("need=id");
	}
