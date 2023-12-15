<?php

final class Downloadfiles{
	
	public static function getFile($file){
		
		if(!empty($file)){
			$fileName = basename($file);;
			$filePath = 'files/'.$fileName;
			if(!empty($fileNmae) && file_exists($filePath)){
				header("Cashe-Control:public");
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; file=$fileNmae");
				header("Content-Type: application/zip");
				header("Content-Transfer-Encoding: binary");
				
				readfile($filePath);
				exit();
			}
			
		}
	}
	
}

?>