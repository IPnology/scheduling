<?php

require_once '../config/database.php';

$action = $_GET['action'];	
	
switch ($action) {
	
	case 'add' :
		add();
		break;	
		
	case 'delete' :
		delete();
		break;
	
	case 'upload' :
		upload();
		break;
	
	case 'export' :
		export();
		break;

	
	default :
}

function add()
{
	$code = $_POST['code'];
	$name = $_POST['name'];
	
	if(mysql_num_rows(mysql_query("select * from subject where code='$code'"))>0)
	{
		header('Location: index.php?view=add&error=Subject already exists.');
	}
	else
	{
		mysql_query("insert into subject set code='$code',
												name='$name'");
	
		header('Location: index.php?view=add&success=You have successfully added a subject.');
	}
}

function delete()
{
	$Id = $_GET['id'];
	
		mysql_query("delete from subject where Id=$Id");
		
		header('Location: index.php?success=You have successfully deleted a subject.');
}

function upload(){
	
	$fail = 0;
	$success = 0;
	
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
			  
		if(mysql_num_rows(mysql_query("select * from subject where code='$code'")) > 0){
					
				  $fail += 1;
			}
			else{
		  mysql_query("insert into subject set code='$code',
												name='$name'");
			$success +=1;
												
			}
		  
		}
		
		
		header('Location: index.php?success='.$success.' data successfully uploaded and '.$fail.' failed');
	}
}

function export()
{
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "subjectList.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='db_scheduling' AND TABLE_NAME='subject'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_row($result)) {
		if ($row[0] != "Id"){
			$header[] = $row[0];
		}
	}	
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$num_column = count($header);		
	$query = "SELECT code, name FROM subject ";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=list');
}

?>