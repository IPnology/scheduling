<?php

require_once '../config/database.php';

$action = $_GET['action'];	
	
switch ($action) {
	
	case 'add' :
		add();
		break;	
		
	case 'remove' :
		remove();
		break;
	
	case 'upload' :
		upload();
		break;

	
	default :
}

function add()
{
	$idnumber = $_GET['idnumber'];
	$code = $_GET['code'];
	
	if(mysql_num_rows(mysql_query("select * from my_subjects where idnumber='$idnumber' and code='$code'"))>0)
	{
		header('Location: index.php?view=add&error=Subject already exists.');
	}
	else
	{
		mysql_query("insert into my_subjects set code='$code',
												idnumber='$idnumber'");
	
		header('Location: index.php?view=add&success=You have successfully added a subject.');
	}
}

function remove()
{
	$Id = $_GET['id'];
	
		mysql_query("delete from my_subjects where Id=$Id");
		
		header('Location: index.php?success=You have successfully deleted a subject.');
}

function upload(){
	
	$file = $_FILES['excel_file']['tmp_name'];
	$handle = fopen($file, "r");
	$info = pathinfo($file);
	
	$ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
	
	if ($file == NULL || $ext != "csv") {
		
		header('Location: index.php?error=File Invalid');
    }else {
		$row = 1;
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
			if($row == 1){ $row++; continue; }
			
			$code = $filesop[0];
			$name = $filesop[1];
			  
		  mysql_query("insert into subject set code='$code',
												name='$name'");
		  
		}
		
		
		header('Location: index.php?success=File Uploaded');
	}
}

?>