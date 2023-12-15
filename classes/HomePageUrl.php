<?php

final class HomePageUrl{
	
	public static function getHome($subdir = null){
		
		return $subdir !== null ? SITE_URL . DS . $subdir . DS : SITE_URL . DS;
		
	}
}

?>