<?php

final class Geturl{
	
	private function __construct(){
		
	}
	
	public static function getLast(){
		
		$requestUri = $_SERVER['REQUEST_URI'];
		# Remove query string
		$requestUri = trim(str_replace("?", DS, $requestUri));
		
		$requestUri = str_split($requestUri);
		$arr = array();
		$string = "";
		foreach($requestUri as $str){
			
			if( strcmp($str, "/") == 0 || strcmp($str, "\\") == 0){
				$arr[] = $string;
				$string = "";
				continue;				
			}
			$string .= $str;
		}
		
		$arr[] = $string;	
		
		if(count($arr) > 2){
			header("Location: ".HomePageUrl::getHome()."");
				die();
		}
		
		return $arr[count($arr) - 1];
		
	}
	
}

?>