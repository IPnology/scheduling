<?php

require_once '../config/database.php';
include_once("../config/function.php");

$action = $_GET['action'];	
	
switch ($action) {
    
		
	case 'deny_reason' :
		deny_reason();
		break;
		
	case 'exportApproved' :
		exportApproved();
		break;
		
	case 'exportDenied' :
		exportDenied();
		break;
		

	default :
}


function deny_reason(){
	$id = $_POST['id'];
	$reason = $_POST['reason'];
	
	mysql_query("insert into denied_reason where exam_id=$id and reason='$reason'");
												
	header('Location: ../exam/?view=vpaaList&id='.$id.'&success=Successfully Denied.');
	
}

function exportApproved()
{
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "approvedList.csv";
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
	$query = "SELECT subject_code,date,time_from,time_to,room,proctor,mentor,course,sy,sem,term FROM exam WHERE is_approved=1";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=approvedList');
}

function exportDenied()
{
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "deniedList.csv";
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
	$query = "SELECT subject_code,date,time_from,time_to,room,proctor,mentor,course,sy,sem,term FROM exam WHERE is_approved=-1";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=deniedList');
}

?>