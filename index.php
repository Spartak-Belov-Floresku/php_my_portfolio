<?php

	/*error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);*/

	require_once('inc/autoload.php');
	
	$t = new Go();
	$t->run(Geturl::getLast());

?>