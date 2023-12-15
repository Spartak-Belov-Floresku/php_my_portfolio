<?php
	require_once('inc/autoload.php');
	
	if(Input::get('antibot1') == Input::getSession('antibot1') && !empty(Input::get('antibot1')) ){
		
		Input::unSetSession("antibot1");
		
		$subject = array("General request","E-commerce","Presentation site");
		
		$body = array();	
			$body['usermail'] = Input::get('usermail');
				$body['username'] = Input::get('username');
					!empty(Input::get('userphone'))? $body['userphone'] = Input::get('userphone'): $body['userphone'] = "<span style='color:red;'>empty</span>";
				$body['subject'] = $subject[Input::get('subject')-1];
			$body['textarea'] = Input::get('textarea');
			
		$objEmail = new ServerEmail();
		
		if($objEmail->process(4, $body)){
			echo "SH Thank you ". $body['username'] ." for request. I will answer as soon as possible.";
		}else{
			echo "SH Your email has not be sent. Try again please.";
		}
		
	}else{
		header('Location: .');
			die();
	}

?>