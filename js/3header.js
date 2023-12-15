function popUpMenu(){
	var drivemenu = getElemId("drivemenu");
	
	if(drivemenu.hasAttribute("class")){
		drivemenu.removeAttribute("class");
		showMobMenu();
	}else{
		drivemenu.className = "openMobMenu";
		showMobMenu();
	}
	
}

function showMobMenu(){
	var menumobile = getElemClass("menumobile")[0];
	
	if(menumobile.hasAttribute("id")){
		menumobile.removeAttribute("id");
	}else{
		menumobile.setAttribute("id","menumobile");
	}
}