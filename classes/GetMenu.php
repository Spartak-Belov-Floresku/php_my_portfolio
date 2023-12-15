<?php
class GetMenu{
	
		private function __construct(){
		
		}
	
		public static function getMenu($path, $page, $class){
			
			$menu = "";
			$reader = new XMLReader();
			
			
			if($reader->open(MENU_PATH.$path)) 
				$menu .= "\n<ul class='menu".$class."'>";
			while($reader->read()) {
				if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'building') {
						$address = $reader->getAttribute('address');
						$href = $reader->getAttribute('href');
						if($address == "ul"){
							$menu .= "</ul><ul class='".$href."'>";
							continue;
						}
					$active  ="";
					if(strtolower($page) == strtolower($href)){
						$active = "class='act'";
					} 
					$img = "";
					if(strpos($class,"mobile") !== false){
						$img = '<img src="images'. DS .''.strtolower($href).'.png" alt="'.strtolower($href).'" class="linkLogo">';
					}
					$menu .= "<li class='top'>".$img."<a href='". strtolower($href) ."' title='". ucwords($address) ."' ".$active.">". ucwords($address) ."</a></li>";
				}
			}
			$menu .= "</ul>\n";
			
			$reader->close();
			
			echo $menu;
		}
	}

?>