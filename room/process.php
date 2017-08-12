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
	$room = $_POST['room'];
	
	if(mysql_num_rows(mysql_query("select * from room where room='$room'"))>0){
		
		header('Location: index.php?view=add&error=Room already exist.');
	}
	else{
		
		mysql_query("insert into room set room='$room'");
	
		header('Location: index.php?view=add&success=You have successfully registered a new user');
	}
}

function delete()
{
	$Id = $_GET['id'];
	
		mysql_query("delete from room where Id=$Id");
		
		header('Location: index.php?success=You have successfully deleted a room.');
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
			
			$room = $filesop[0];
			
			if(mysql_num_rows(mysql_query("select * from room where room='$room'")) > 0){
					
				  $fail += 1;
			}
			else{
				  mysql_query("insert into room set room='$room'");
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

	$filename = "roomList.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='db_scheduling' AND TABLE_NAME='room'";
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
	$query = "SELECT room FROM room";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=list');
}

?>