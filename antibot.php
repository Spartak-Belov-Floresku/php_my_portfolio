<?php
	require_once('inc/autoload.php');
	
	if(Input::exists('post') && Input::get("need") == "id"){
			
			$out = array();
				
			$antibothash = HashMass::string2hash(microtime(true));
			
			Input::putSession("antibot1", $antibothash);
				$out['antibot1'] = $antibothash;
				
			echo json_encode($out);
	}else{
		
		header('Location: .');
			die();
		
	}

?>