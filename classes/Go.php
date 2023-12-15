<?php
class Go{
	public function run($page = ""){
		
		ob_start();
		
			$load = Url::getPage($page);
			
			//creat and send class name to wrapper div
			
			//creat and assing a class name to wrapper div
			
			$class = substr($load,0, strpos($load, "."));
			
			$arrayst = str_split($class);
			$arr = array();
			$string = "";
			foreach($arrayst as $str){
			
				if( strcmp($str, "/") == 0 || strcmp($str, "\\") == 0){
					$arr[] = $string;
					$string = "";
					continue;				
				}
				$string .= $str;
			}
			
			$arr[] = $string;
			
			$class = $arr[count($arr) - 1];
			
			// end------------------------------------------
			
		require_once($load);
		
		ob_get_flush();
		
	}
}
?>