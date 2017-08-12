<?php

require_once '../config/database.php';

$action = $_GET['action'];	
	
switch ($action) {
    
		
	case 'update' :
		update();
		break;

	default :
}


function update()
{
	$sy = $_POST['sy'];
	$sem = $_POST['sem'];
	$term = $_POST['term'];
	
	
	
		mysql_query("update settings set sy='$sy',
														sem='$sem',
														term='$term'
														");
		
		header('Location: index.php?success=You have updated the settings');
	
}

?>