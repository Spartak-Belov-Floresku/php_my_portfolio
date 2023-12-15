<?php
require_once('PHPMailer_v5.1/PHPMailer.php');

class GmailEmail{
	
	private $objMailer;
	private $_myemail = "spartakkuzminus@gmail.com" ;
	
	public function __construct(){
		
		$this->objMailer = new PHPMailer();
		$this->objMailer->SMTPDebug = 2;
		$this->objMailer->IsSMTP();
		$this->objMailer->SMTPAuth = true;
		$this->objMailer->SMTPKeepAlive = true;
		$this->objMailer->SMTPSecure = "ssl";
		$this->objMailer->Host = "smtp.gmail.com";
		$this->objMailer->Port = 465;
		$this->objMailer->Username = "spartakkuzminus@gmail.com";
		$this->objMailer->Password = "436ExpTN20";
		$this->objMailer->SetFrom("spartakkuzminus@gmail.com","Spartak Kuzmin");
		$this->objMailer->AddReplyTo("spartakkuzminus@gmail.com","Spartak Kuzmin");
		
	}
	
	public function process($case = null, $array = null){
		if(!empty($case)){
			
			switch($case){
				
				case 1:
				//add url to the array
				$link  = "<a href=\"".SITE_URL."?page=activate&code=";
				$link .= $array['hash'];
				$link .= "\">";
				$link .= SITE_URL."/?page=activate&code=";
				$link .= $array['hash'];
				$link .= "</a>";
				$array['link'] = $link;

				$this->objMailer->Subject = "Activate your account";
				$this->objMailer->MsgHTML($this->fetchEmail($case, $array));
				$this->objMailer->AddAddress(
					$array['email'],
					$array['first_name'].' '.$array['last_name']
				);
				break;
				
				case 2:
				
				//add url to the array
				$link  = "<a href=\"".SITE_URL."/?page=login\">";
				$link .= "Login Page";
				$link .= "</a>";
				$array['link'] = $link;
				
				$this->objMailer->Subject = "Recover Password";
				$this->objMailer->MsgHTML($this->fetchEmail($case, $array));
				$this->objMailer->AddAddress(
					$array['email'],
					$array['first_name'].' '.$array['last_name']
				);
				
				break;
				case 3:

					$this->objMailer->Subject = 'New order # '. $array['orderId'] .' via website';
					$this->objMailer->MsgHTML($this->fetchEmail($case, $array));	
					$this->objMailer->AddAddress($array['email'],'Business');
				
				break;
				case 4:
				
					/*
					$objBusiness = new Business();
					$business = $objBusiness->getBusiness();
					*/
					
					$this->objMailer->Subject = 'Request via site.';
						$this->objMailer->MsgHTML($this->fetchEmail($case, $array));
							$this->objMailer->AddAddress($this->_myemail,'My site');
				
				break;

			}
			
			//send email
			if($this->objMailer->Send()){
				$this->objMailer->ClearAddresses();
				return true;
			}
			die($this->objMailer->ErrorInfo);
			return false;
		}
	}
	
	public function fetchEmail($case = null , $array = null){
		if(!empty($case)){
			
			if(!empty($array)){
				
				foreach($array as $key => $value){
					${$key} = $value;
				}
			}
			ob_start();
			require_once(EMAILS_PATH.DS.$case.".php");
			$out = ob_get_clean();
			return $this->wrapEmail($out);
		}
	}
	
	public function wrapEmail($content = null){
			if(!empty($content)){
				return "<div style=\"font-family:Arial,Verdana,Sans-
				serif;font-size:12px;color:#333;line-height:21px;\">{$content}
				</div>";
			}
	}
}

?>