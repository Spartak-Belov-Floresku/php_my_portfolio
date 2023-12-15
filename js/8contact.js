	function sendEmail(e){
		
		var check = true;
		
		var stringvalue = "";
		
		var p = getElemId("contactcontent").getElementsByTagName("form")[0].getElementsByTagName("p");
		
		for(var i = 0; i < p.length; i++){

			if(p[i].getElementsByTagName("label").length !== 0){
				
				var label = p[i].getElementsByTagName("label")[0];
								
					var findInput = label.getAttribute("for").trim();	
						
					var input = getElemId(findInput.trim());
					
					var val = "";
					
					var idInput = "";
					
					if(input !== null)
						idInput = input.getAttribute("id").trim();
					
					//alert(idInput);
						// username input---------------------------------------------------------------------------------
						if(idInput == "username"){
								val = input.value.trim();
								val = val.replace(/[^a-zA-Z]+/g, '');
							input.value = val;
							
							if(val.length < 2){
								
									label.childNodes[0].nodeValue = "";
										label.getElementsByTagName("span")[0].innerHTML = "  Name is incorrect...";
										input.className = "wrong";
								check = false;
						
							}else{
								
								stringvalue += "username="+val+"&";
								
							}
							
							
						}
						// end input username--------------------------------------------------------------------------
						
						//email input----------------------------------------------------------------------------------
						if(idInput == "usermail"){
							
								val = input.value.trim();
								
								var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
								
								if(!re.test(val)){
									
									label.childNodes[0].nodeValue = "";
										label.getElementsByTagName("span")[0].innerHTML = "   E-mail address is incorrect...";
										input.className = "wrong";
									check = false;
									
								}else{
									
									stringvalue += "usermail="+val+"&";
									
								}
							
						}
						// end email input-----------------------------------------------------------------------------------
						
						//phone input----------------------------------------------------------------------------------------
						if(idInput == "userphone"){
							
								val = input.value.trim();
								
								if(val.length != 0){
								
									var re = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
									
									if(!re.test(val)){
										
										label.childNodes[0].nodeValue = "";
											label.innerHTML = "<span class='requiredadd'>  Phone is incorrect...</span>";
											input.className = "wrong";
										check = false;
										
									}else{
										
										stringvalue += "userphone="+val+"&";
										
									}
								}
							
						}
						//end phone input------------------------------------------------------------------------------------
					
						if(p[i].getElementsByTagName("textarea").length !== 0 ){
							
							var textArea = p[i].getElementsByTagName("textarea")[0];
							val = textArea.value.trim();
							val = val.replace(/<[^>]+>/g, '');
							
							if(val.length === 0){
								label.childNodes[0].nodeValue = "";
										label.getElementsByTagName("span")[0].innerHTML = "  Message cannot be empty...";
										textArea.className = "wrong";
								check = false;
							}else{
								stringvalue += "subject="+getElemId("subject").value+"&";
								stringvalue += "textarea="+val+"&";
										
							}
							
						}
				
				
			}
		
		}
		
		stringvalue += "antibot1="+getElemId("antibot1").value;
		
		if(!check){
			e.preventDefault();
		}else{
			var antibot1Value = getElemId("antibot1");
			
			if(!antibot1Value.value.length <= 0){
				antibot1Value.value = "";
					getElemId("contactcontent").setAttribute("class","disable");
						disableForm();
							sendMail(stringvalue);
								e.preventDefault();
			}else{
				
				alert("Sorry, but it allows to send only an one message every 2 minutes.");
				
			}
		}	
	}
	
	function disableForm(){
		var contactcontent = getElemId("contactcontent");
		
		if(contactcontent){
			if(contactcontent.className == "disable"){
				var widthheight = contactcontent.getBoundingClientRect();
					var sending = getElemId("sending");
					sending.style.height = widthheight.height+"px";
				sending.style.width = widthheight.width+"px";
			}
		}
	}
	
	function releaseForm(){
		var contactcontent = getElemId("contactcontent");
			var sending = getElemId("sending");
		if(contactcontent.className == "disable"){
			contactcontent.removeAttribute("class");
				sending.removeAttribute("style");
		}
	}
	
	function sendMail(param){
		
		var hr = new XMLHttpRequest();
			hr.open("POST","sendcontact.php",true);
				hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					hr.onreadystatechange = function(){
						if(hr.readyState == 4 && hr.status == 200){
							releaseForm();
							
								setTimeout(function (){antibot()},20000);
								
								var st = hr.responseText;
									var i = st.search('SH');
										st = st.slice(i+2);
								var txt = getElemId("textarea");
									
								if(st.indexOf("Thank") !== -1)
									txt.setAttribute("class","sent");
								else
									txt.setAttribute("class","wrong");
								
								txt.value = st;
								setTimeout(function (){antibot();},3000);
						}
		}
		hr.send(param);
	}
	
	function reliseTag(elem){
		
		var label = elem.getElementsByTagName("label")[0];
		
		if(elem.getElementsByTagName("input").length !== 0){
			var input = elem.getElementsByTagName("input")[0];
			
			if(input.className == "wrong"){
				
				input.removeAttribute("class");
					var attfor = label.getAttribute("data-type");
						var span = "";
				
				if(label.getElementsByTagName("span").length !== 0 && label.getElementsByTagName("span")[0].className == "required"){
					span = "<span class='required'>*</span>";
				}
				
					label.innerHTML = " "+attfor.charAt(0).toUpperCase()+attfor.substring(1)+span;
				return;
			}
		}else{
			
			var textArea = elem.getElementsByTagName("textarea")[0];
			
			if(textArea.className == "wrong" || textArea.className == "sent"){
				
				getElemId("counter").innerHTML = "500";
				
				textArea.removeAttribute("class");
					var attfor = label.getAttribute("data-type");
						var span = "";
				textArea.value = "";
					
				if(label.getElementsByTagName("span").length !== 0 && label.getElementsByTagName("span")[0].className == "required"){
					span = "<span class='required'>*</span>";
				}
				
					label.innerHTML = " "+attfor.charAt(0).toUpperCase()+attfor.substring(1)+span;
				return;
			}
			
		}
	}
	
	
	function lengthMessage(allow){
		
		var textArea = getElemId("textarea");
			var counter = getElemId("counter");
		var val = textArea.value;
		
		if(val.length > allow){
			val = val.substring(0,5);
		}
		
		var num = allow - val.length;
			counter.innerHTML = num;
		textArea.value = val;
		
	}
	
	function addClassSpan(){
		
		var counter = getElemId("counter");
		
		if(counter.className != "counter"){
			counter.setAttribute("class","counter");
		}else{
			counter.removeAttribute("class");
		}
	}
	
	function putForm(){
		
			if(getElemId("contact")){
				
				var contact = getElemId("contact");
				var contactcontent = getElemId("contactcontent");
				if(contact.hasAttribute("style"))
					contact.removeAttribute("style");
				
				var contactHeight = contact.getBoundingClientRect();
				
				var heightBrowser  = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
				
				
				
				if(contactHeight.height < heightBrowser){
					
					contact.style.height = heightBrowser+"px";
					var contactcontentheight = contactcontent.getBoundingClientRect();
					
					var def = (heightBrowser - contactcontentheight.height)/2;
					var x = 20;
					
					if(def+x < 60){
						contact.style.paddingTop = 65+"px";
							contact.style.height = contactcontent.getBoundingClientRect().height+5+"px";
								return;
					}
					
					contact.style.height = heightBrowser-def-x+"px";
						contact.style.paddingTop = def+x+"px";
					
				}else{
					contact.style.paddingTop = 60+"px";
				}
			
			}
	}