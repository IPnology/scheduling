<?php

require_once '../config/database.php';
include_once("../config/function.php");

$action = $_GET['action'];	
	
switch ($action) {
    
	case 'remove' :
		remove();
		break;
		
	case 'removeExam' :
		removeExam();
		break;
		
	case 'removeExamFaculty' :
		removeExamFaculty();
		break;
    
	case 'create_exam' :
		create_exam();
		break;
    
	case 'upload_now' :
		upload_now();
		break;
    
	case 'create' :
		create();
		break;
		
	case 'update' :
		update();
		break;
		
	case 'updateConflict' :
		updateConflict();
		break;
	
	case 'approve' :
		approve();
		break;
		
	case 'deny' :
		deny();
		break;
		
	case 'upload' :
		upload();
		break;
		
	case 'export' :
		export();
		break;
		
	case 'exportFacultyExam' :
		exportFacultyExam();
		break;
		
	case 'exportAreaExam' :
		exportAreaExam();
		break;
    
	case 'quickCreate' :
		quickCreate();
		break;
    
	case 'quickCreateFaculty' :
		quickCreateFaculty();
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

function removeExam(){
	$id = $_GET['id'];
	$date = $_GET['date'];
	

	mysql_query("delete from exam where Id = '".$id."'");
												
	header('Location: index.php?view=adminGridList&date='.$date);
	
}

function removeExamFaculty(){
	$id = $_GET['id'];
	$date = $_GET['date'];
	

	mysql_query("delete from exam where Id = '".$id."'");
												
	header('Location: index.php?view=adminGridListFaculty&date='.$date);
	
}

function create()
{
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
		$time_to  = date("H:i", strtotime("9:30 AM"));
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
	
	
	if(checkConflict($room, $date, $time_from, $proctor)){
		
		
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
		
		header('Location: index.php?view=create.');
	}else{
		
	
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
														term='$term'
														");
		
		header('Location: index.php?view=create&success=You have successfully created an exam schedule.');
	}
	
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
		else if ($subject_code=='' || $date=='0000-00-00' || $time_from=='' || $time_to==''){
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
														term='$term'
														");
			
			$success += 1;
		}
		
	}
	
	mysql_query("delete from exam_tmp");
	
	if ($fail > 0 and $success > 0){
	header('Location: index.php?success='.$success.' has successfully uploaded and '.$fail.' failed. Conflicts and incomplete data are not imported to the database');
	}
	else if ($fail > 0 and $success == 0){
	header('Location: index.php?error='.$fail.' failed. Conflicts and incomplete data are not imported to the database');
	}
	else if ($fail == 0 and $success > 0){
	header('Location: index.php?success='.$success.' has successfully uploaded');
	}
	else {
	header('Location: index.php?error=Nothing has been imported to the database');
	}
	
}

function update()
{
	$username = $_POST['username'];
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
	
	$userPosition = getUserPosition($username);
	
	
	if ($time == '730'){
		$time_from  = date("H:i", strtotime("7:30 AM"));
		$time_to  = date("H:i", strtotime("9:30 AM"));
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
	
	if(checkConflict($room, $date, $time_from, $proctor)){
		
		
		
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
		
		mysql_query("delete from exam where Id=$id");
		
		header('Location: index.php?view=create.');
	}else{
		
			
		if ($userPosition == 'VPAA'){
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
														is_approved='1'
														where Id=$id
														");
		}		
		else{
			
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
														is_approved=0,
														term='$term'
														where Id=$id
														");	
														
			mysql_query("delete from denied_reason where exam_id=$id");
		}
		
														
		header('Location: index.php?view=create&success=You have successfully updated an exam schedule.');
	}
}

function updateConflict()
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
		$time_to  = date("H:i", strtotime("9:30 AM"));
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
	
	if(checkConflict($room, $date, $time_from, $proctor)){
		
		
		mysql_query("update exam_tmp set subject_code='$subject_code',
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
														where Id=$id
														");
		
		header('Location: index.php?view=create.');
	}else{
		
		
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
														term='$term'
														");
		
		mysql_query("delete from exam_tmp");		
														
		
		header('Location: index.php?view=create&success=You have successfully created an exam schedule.');
	}
	
}

function approve()
{
	$id = $_GET['id'];	
	$get = mysql_fetch_array(mysql_query("select * from exam where Id=$id"));
	
	
	if(checkConflict($get['room'], $get['date'], $get['time_from'], $get['proctor'])){
		
		header('Location: ../exam/?view=vpaaList&id='.$id.'&error=Conflict can not be approved.');
	}
		else{
		mysql_query("update exam set is_approved='1' where Id = '".$id."'");
													
		header('Location: ../exam/?view=vpaaList&id='.$id.'&success=Successfully Approved.');
	}
}

function deny()
{
	$id = $_GET['id'];	
	
	mysql_query("update exam set is_approved='-1' where Id = '".$id."'");
												
	header('Location: ../vpaa/?view=deny_reason&id='.$id);
}

function export()
{
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "examList.csv";
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
	$query = "SELECT subject_code,date,time_from,time_to,room,proctor,mentor,course,sy,sem,term FROM exam";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=adminList');
}

function exportFacultyExam()
{
	$user = $_GET['user'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "facultyExamList.csv";
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
	$query = "SELECT subject_code,date,time_from,time_to,room,proctor,mentor,course,sy,sem,term FROM exam WHERE is_approved=1 and (mentor='$user' or proctor='$user')";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=facultyExamList');
}

function exportAreaExam()
{
	$course = $_GET['course'];
	
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "areaExamList.csv";
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
	$query = "SELECT subject_code,date,time_from,time_to,room,proctor,mentor,course,sy,sem,term FROM exam WHERE is_approved=1 and course like '$course%'";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=facultyExamList');
}

function quickCreate()
{
	$subject_code = $_POST['subject_code'];
	$date = $_POST['date'];
	$time_from = $_POST['timeFrom'];
	$time_to = $_POST['timeTo'];
	$room = $_POST['room'];
	$proctor = $_POST['proctor'];
	$mentor = $_POST['mentor'];
	$course = $_POST['course'] . $_POST['year'] . "-" . $_POST['section'];
	
	$get = mysql_fetch_array(mysql_query("select * from settings"));
	
	$sy = $get['sy'];
	$sem = $get['sem'];
	$term = $get['term'];
	
	
	if(checkConflict($room, $date, $time_from, $proctor)){
		
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
		
		header('Location: index.php?view=create.');
	}else{
	
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
														term='$term'
														");
		
		header('Location: index.php?view=adminGridList&date='.$date);
	}
	
}

function quickCreateFaculty()
{
	$subject_code = $_POST['subject_code'];
	$date = $_POST['date'];
	$time_from = $_POST['timeFrom'];
	$time_to = $_POST['timeTo'];
	$room = $_POST['room'];
	$proctor = $_POST['proctor'];
	$mentor = $_POST['mentor'];
	$course = $_POST['course'] . $_POST['year'] . "-" . $_POST['section'];
	
	$get = mysql_fetch_array(mysql_query("select * from settings"));
	
	$sy = $get['sy'];
	$sem = $get['sem'];
	$term = $get['term'];
	
	
	if(checkConflict($room, $date, $time_from, $proctor)){
		
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
		
		header('Location: index.php?view=create.');
	}else{
	
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
														term='$term'
														");
		
		header('Location: index.php?view=adminGridListFaculty&date='.$date);
	}
	
}

?>