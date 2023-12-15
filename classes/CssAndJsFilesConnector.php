<?php
final class CssAndJsFilesConnector{
	
	private function __construct(){}
	
	public static function writepath($dir){
		
		$check = false;
		$start = "";
		$end = 	"";
		
		switch ($dir){
			case "css":
				$check = true;
				$start = '<link href="';
				$end = '" rel="stylesheet" type="text/css" />';
				break;
			case "js":
				$check = false;
				$start = '<script src="';
				$end = '" type="text/javascript"></script>';
				break;
		}
		
		if(!$check){
			self::getpath($dir, $start, $end);
		}else{
			self::getpath($dir, $start, $end);
		}
		
	}
	
	private static function getpath($dir, $start, $end){
		
		$arrayfiles =  array();
		
		if(is_dir($dir)){
			if($dh = opendir($dir)){
				while(($file = readdir($dh)) !== false){
					if(preg_match('/\./',substr($file,0,1)) == 0){
						$index = substr($file,0,1);
						$arrayfiles[$index-1] = $file;
					}
				}
				closedir($dh);
				
				for($i = 0; $i < sizeof($arrayfiles); $i++){
					echo trim($start). trim($dir) . DS . trim($arrayfiles[$i]). trim($end)."\n";
				}
			}
		}
	}
	
}

?>