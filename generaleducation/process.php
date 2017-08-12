<?php

require_once '../config/database.php';
include_once("../config/function.php");

$action = $_GET['action'];	
	
switch ($action) {
		
	case 'upload' :
		upload();
		break;
		
	case 'remove' :
		remove();
		break;
		
	case 'create_exam' :
		create_exam();
		break;
		
	case 'upload_now' :
		upload_now();
		break;
		
	case 'export' :
		export();
		break;

	default :
}


function create_exam(){
	
	mysql_query("delete from exam_tmp");
												
	header('Location: index.php');
	
}

function remove(){
	$id = $_GET['id'];
	

	mysql_query("delete from exam_tmp where Id = '".$id."'");
												
	header('Location: index.php?view=temp_exam&success=Exam Schedule Successfully Removed.');
	
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
			
			$subject_code = $filesop[0];
			$date = $filesop[1];
			$time_from = date("H:i", strtotime($filesop[2]));
			$time_to = date("H:i", strtotime($filesop[3]));
			$room = $filesop[4];
			$proctor = $filesop[5];
			$mentor = $filesop[6];
			$course = $filesop[7];
			$sy = $filesop[8];
			$sem = $filesop[9];
			$term = $filesop[10];
			
			$date = DateTime::createFromFormat('m/d/Y', $date)->format('Y-m-d');
			  
		  mysql_query("insert into exam_tmp set subject_code='$subject_code',
														date='$date',
														time_from='$time_from',
														time_to='$time_to',
														room='$room',
														proctor='$proctor',
														mentor='$mentor',
														course='$course',
														sy='$sy',
														sem='$sem',
														term='$term'
														");
		  
		}
		
		
		header('Location: index.php?view=temp_exam');
	}
}

function upload_now(){
	
	$query = mysql_query("select * from exam_tmp");
	
	$success = 0;
	$fail = 0;
	while($row=mysql_fetch_array($query)){
		extract($row);
		if (checkTempConflict($room, $date, $time_from, $proctor)){
			$fail += 1;
		}
		else if ($subject_code=='' || $date=='' || $time_from=='' || $time_to==''){
			$fail += 1;
		}
		else{
			
			mysql_query("insert into exam set subject_code='$subject_code',
														date='$date',
														time_from='$time_from',
														time_to='$time_to',
														room='$room',
														proctor='$proctor',
														mentor='$mentor',
														course='$course',
														sy='$sy',
														sem='$sem',
														term='$term',
														is_approved=1,
														is_general=1
														");
			
			$success += 1;
		}
		
	}
	
	mysql_query("delete from exam_tmp");
	
	header('Location: index.php?success='.$success.' has successfully uploaded and '.$fail.' failed.');
	
}

function update()
{
	$id = $_POST['id'];
	$subject_code = $_POST['subject_code'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$room = $_POST['room'];
	$proctor = $_POST['proctor'];
	$mentor = $_POST['mentor'];
	$course = $_POST['course'] . $_POST['year'] . "-" . $_POST['section'];
	$sy = $_POST['sy'];
	$sem = $_POST['sem'];
	$term = $_POST['term'];
	
	
	if ($time == '730'){
		$time_from  = date("H:i", strtotime("7:30 AM"));
		$time_to  = date("H:i", strtotime("9:30 PM"));
	}
	else if ($time == '10'){
		$time_from  = date("H:i", strtotime("10:00 AM"));
		$time_to  = date("H:i", strtotime("12:00 PM"));
	}
	else if ($time == '1'){
		$time_from  = date("H:i", strtotime("1:00 PM"));
		$time_to  = date("H:i", strtotime("3:00 PM"));
	}
	else if ($time == '330'){
		$time_from  = date("H:i", strtotime("3:30 PM"));
		$time_to  = date("H:i", strtotime("5:30 PM"));
	}
	else if ($time == '6'){
		$time_from  = date("H:i", strtotime("6:00 PM"));
		$time_to  = date("H:i", strtotime("8:00 PM"));
	}
	
		
		mysql_query("update exam set subject_code='$subject_code',
														date='$date',
														time_from='$time_from',
														time_to='$time_to',
														room='$room',
														proctor='$proctor',
														mentor='$mentor',
														course='$course',
														sy='$sy',
														sem='$sem',
														term='$term',
														is_approved=0
														where Id=$id
														");
		
		header('Location: index.php?view=adminList&success=You have successfully updated an exam schedule.');
	
}

function approve()
{
	$id = $_GET['id'];	
	
	mysql_query("update exam set is_approved='1' where Id = '".$id."'");
												
	header('Location: ../exam/?view=vpaaList&id='.$id.'&success=Successfully Approved.');
}

function deny()
{
	$id = $_GET['id'];	
	
	mysql_query("update exam set is_approved='-1' where Id = '".$id."'");
												
	header('Location: ../exam/?view=vpaaList&id='.$id.'&success=Successfully Denied.');
}

function export()
{

	$filename = "genEdList.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='db_scheduling' AND TABLE_NAME='exam'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_row($result)) {
		if ($row[0] != "Id" && $row[0] != "is_approved" && $row[0] != "is_general"){
			$header[] = $row[0];
		}
	}	
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$num_column = count($header);		
	$query = "SELECT subject_code,date,time_from,time_to,room,proctor,mentor,course,sy,sem,term FROM exam WHERE is_general=1";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=genEdList');
}

?>