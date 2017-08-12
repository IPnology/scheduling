<?php

require_once '../config/database.php';

$action = $_GET['action'];	
	
switch ($action) {
	
	case 'upload' :
		upload();
		break;
	
	case 'resetSubjects' :
		resetSubjects();
		break;
	
	case 'export' :
		export();
		break;

	
	default :
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
			
			$idnumber = $filesop[0];
			$code = $filesop[1];
			$time = $filesop[2];
			$sched = $filesop[3];
			$facultyId = $filesop[4];
			  
	
		  mysql_query("insert into my_subjects set idnumber='$idnumber',
												code='$code',
												time='$time',
												sched='$sched',
												facultyId='$facultyId'");
			$success +=1;
												
		  
		}
		
		
		header('Location: index.php?success='.$success.' data successfully uploaded and '.$fail.' failed');
	}
}

function resetSubjects()
{
	
	mysql_query("delete from my_subjects");
	
	header('Location: index.php?success=You have successfully reset students subjects.');
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