<?php
include_once("../config/database.php");
include_once("../config/function.php");

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	
	case 'userList' :
		$content 	= 'userList.php';
		$template	= '../include/template.php';
		break;
		
	case 'register' :
		$content 	= 'register.php';
		$template	= '../include/template.php';
		break;
	
	case 'changepassword' :
		$content 	= 'changepassword.php';
		$template	= '../include/template_login.php';
		break;
		
	case 'print':
		$content 	= 'print.php';
		$template	= '../include/template_login.php';
		break;
			
	default :
		$content 	= 'login.php';
		$template	= '../include/template_login.php';
}

require_once $template;

?>





