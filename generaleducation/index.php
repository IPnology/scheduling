<?php
include_once("../config/database.php");
include_once("../config/function.php");

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	
	case 'temp_exam' :
		$content 	= 'tempList.php';
		$template	= '../include/template.php';
		break;
		
	case 'print':
		$content 	= 'print.php';
		$template	= '../include/template_login.php';
		break;
			
	default :
		$content 	= 'genEdList.php';
		$template	= '../include/template.php';
}

require_once $template;

?>





