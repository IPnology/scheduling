<?php
include_once("../config/database.php");
include_once("../config/function.php");

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	
	case 'register' :
		$content 	= 'register.php';
		$template	= '../include/template.php';
		break;
			
	default :
		$content 	= 'home.php';
		$template	= '../include/template.php';
}

require_once $template;

?>





