<?php

function getExamFaculty($faculty, $date, $timeFrom){
	$query = mysql_query("select * from exam where proctor='$faculty' and date='$date' and time_from='$timeFrom'");
	
	if(mysql_num_rows($query)>0){
		$get = mysql_fetch_array($query);
		
		if ($get['is_approved']==1){
		return $get['subject_code'] . "<br>" . $get['course'] . "<br>" . $get['room'] ;
		}
		else if ($get['is_approved']==-1){
		return $get['subject_code'] . "<br>" . $get['course'] . "<br>" . $get['room'] . "<br> <font color='red'>Denied</a>";
		}
		else{
		return $get['subject_code'] . "<br>" . $get['course'] . "<br>" . $get['room']  . "<br> <font color='green'>Pending</a>";
		}
		
	}
	else{
		return "<font color='blue'>Vacant</a>";
	}
}

function getExam($room,$date, $timeFrom){
	$query = mysql_query("select * from exam where room='$room' and date='$date' and time_from='$timeFrom'");
	
	if(mysql_num_rows($query)>0){
		$get = mysql_fetch_array($query);
		
		if ($get['is_approved']==1){
		return $get['subject_code'] . "<br>" . $get['course'] . "<br>" . $get['proctor'] ;
		}
		else if ($get['is_approved']==-1){
		return $get['subject_code'] . "<br>" . $get['course'] . "<br>" . $get['proctor']  . "<br> <font color='red'>Denied</a>";
		}
		else{
		return $get['subject_code'] . "<br>" . $get['course'] . "<br>" . $get['proctor']  . "<br> <font color='green'>Pending</a>";
		}
		
	}
	else{
		return "<font color='blue'>Vacant</a>";
	}
}

function editableFaculty($faculty,$date, $timeFrom){
	$query = mysql_query("select * from exam where proctor='$faculty' and date='$date' and time_from='$timeFrom'");
	
	if(mysql_num_rows($query)>0){
		$get = mysql_fetch_array($query);
		
		if ($get['is_approved']==1){
		return false;
		}
		else{
		//pending
		return "pending";
		}
		
	}
	else{
		//vacant
		return "vacant";
	}
}

function editable($room,$date, $timeFrom){
	$query = mysql_query("select * from exam where room='$room' and date='$date' and time_from='$timeFrom'");
	
	if(mysql_num_rows($query)>0){
		$get = mysql_fetch_array($query);
		
		if ($get['is_approved']==1){
		return false;
		}
		else{
		//pending
		return "pending";
		}
		
	}
	else{
		//vacant
		return "vacant";
	}
}

function getExamFacultyId($faculty,$date, $timeFrom){
	$query = mysql_query("select * from exam where mentor='$faculty' and date='$date' and time_from='$timeFrom'");
	
	$get = mysql_fetch_array($query);
		return $get['Id'];
}

function getExamId($room,$date, $timeFrom){
	$query = mysql_query("select * from exam where room='$room' and date='$date' and time_from='$timeFrom'");
	
	$get = mysql_fetch_array($query);
		return $get['Id'];
}

function getUserPosition($username){
	$query = mysql_query("select * from user where idnumber='$username'");
	
	$get = mysql_fetch_array($query);
		return $get['auth'];
}


function deniedReason($Id){
	$query = mysql_query("select * from denied_reason where exam_id=$Id");
	
	$get = mysql_fetch_array($query);
	return $get['reason'];
}

function user_exist($idnumber){
	$query = mysql_query("select * from user where idnumber='$idnumber'");
	if (mysql_num_rows($query)>0){
		return true;
	}else{
		return false;
	}
}


function fullname($user){
	
	$query = mysql_query("select * from user where idnumber='$user'");
	if (mysql_num_rows($query)>0){
		$get = mysql_fetch_array($query);
		return $get['first_name'] . ' ' . $get['last_name'];
	}
	else{
		return "<font color='red'>".$user." Not Found</font>";
	}
}

function approve_status($id){
	
	$get = mysql_fetch_array(mysql_query("select * from exam where Id='$id'"));
		if ($get['is_approved'] == -1){
			return 'Denied';
		}
		else if ($get['is_approved'] == 1){
			return 'Approved';
		}
		else{
			return 'Pending';
		}
}

function buildProctorOptions($catId = 0)
{
	$sql = "SELECT Id, idnumber, first_name, last_name
			FROM user
			WHERE auth='Faculty'
			ORDER BY Id";
	$result = mysql_query($sql);
	
	$categories = array();
	while($row = mysql_fetch_array($result)) {
		list($id, $idnumber, $first_name, $last_name) = $row;
		
			// we create a new array for each top level categories
			$categories[$id] = array('first_name' => $first_name,'last_name' => $last_name,'idnumber' => $idnumber);
			

	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$name     = $value['first_name'] .' '.$value['last_name'];
		$idnumber = $value['idnumber'];
		
		$list .= "<option value=\"$idnumber\"";
		if ($idnumber == $catId) {
			$list.= " selected";
		}
			
		$list .= ">$name</option>\r\n";
	}
	
	return $list;
}

function buildMentorOptions($catId = 0)
{
	$sql = "SELECT Id, idnumber, first_name, last_name
			FROM user
			WHERE auth='Faculty'
			ORDER BY Id";
	$result = mysql_query($sql);
	
	$categories = array();
	while($row = mysql_fetch_array($result)) {
		list($id, $idnumber, $first_name, $last_name) = $row;
		
			// we create a new array for each top level categories
			$categories[$id] = array('first_name' => $first_name,'last_name' => $last_name,'idnumber' => $idnumber);

	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$name     = $value['first_name'] .' '.$value['last_name'];
		$idnumber = $value['idnumber'];
		
		$list .= "<option value=\"$idnumber\"";
		if ($idnumber == $catId) {
			$list.= " selected";
		}
			
		$list .= ">$name</option>\r\n";
	}
	
	return $list;
}

function buildRoomOptions($catId = 0)
{
	$sql = "SELECT Id, room
			FROM room
			ORDER BY Id";
	$result = mysql_query($sql);
	
	$categories = array();
	while($row = mysql_fetch_array($result)) {
		list($id, $room) = $row;
		
			// we create a new array for each top level categories
			$categories[$id] = array('room' => $room);
			

	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$room     = $value['room'];
		
		$list .= "<option value=\"$room\"";
		if ($room == $catId) {
			$list.= " selected";
		}
			
		$list .= ">$room</option>\r\n";
	}
	
	return $list;
}

function buildSubjectOptions($catId = 0)
{
	$sql = "SELECT Id, code, name
			FROM subject
			ORDER BY Id";
	$result = mysql_query($sql);
	
	$categories = array();
	while($row = mysql_fetch_array($result)) {
		list($id, $code, $name) = $row;
		
			// we create a new array for each top level categories
			$categories[$id] = array('code' => $code, 'name' => $name);
			

	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$code     = $value['code'];
		$name     = $value['name'];
		
		$list .= "<option value=\"$code\"";
		if ($code == $catId) {
			$list.= " selected";
		}
			
		$list .= ">$code: $name</option>\r\n";
	}
	
	return $list;
}

function conflict($Id)
{
	$get = mysql_fetch_array(mysql_query("select * from exam where Id='$Id'"));
	$room = $get['room'];
	$proctor = $get['proctor'];
	$date = $get['date'];
	$time_from = $get['time_from'];
	$proctor = $get['proctor'];
	
	$query = mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1 and Id!=$Id) or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1  and Id!=$Id)");
	$check_conflict = mysql_num_rows($query);
	//$check_conflict = mysql_num_rows(mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1 and Id!='$Id') or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1 and Id!='$Id')"));
	if($check_conflict > 0){
		return "danger";
	}
	else{
		return "";
	}
}

function conflictWith($Id)
{
	$get = mysql_fetch_array(mysql_query("select * from exam where Id='$Id'"));
	$room = $get['room'];
	$date = $get['date'];
	$proctor = $get['proctor'];
	$time_from = $get['time_from'];
	
	$query = mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1 and Id!=$Id) or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1 and Id!=$Id)");
	$check_conflict = mysql_num_rows($query);
	$get2 = mysql_fetch_array($query);
	if($check_conflict > 0){
		return "<font size='0.5px' color='red'>Conflict with:<br>" . $get2['subject_code']. ", ". $get2['time_from']. "-". $get2['time_to']. ", ". $get2['room']. ", ". $get2['proctor']. "</font>";
	}
	else{
		return "";
	}
}


function tempConflictWith($Id)
{
	$get = mysql_fetch_array(mysql_query("select * from exam_tmp where Id='$Id'"));
	$room = $get['room'];
	$date = $get['date'];
	$proctor = $get['proctor'];
	$time_from = $get['time_from'];
	
	$query = mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1) or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1)");
	$check_conflict = mysql_num_rows($query);
	$get2 = mysql_fetch_array($query);
	if($check_conflict > 0){
		return $get2['subject_code']. ", ". $get2['time_from']. "-". $get2['time_to']. ", ". $get2['room']. ", ". $get2['proctor'];
	}
	else{
		return "";
	}
}

function tempConflict($Id)
{
	$get = mysql_fetch_array(mysql_query("select * from exam_tmp where Id='$Id'"));
	$room = $get['room'];
	$date = $get['date'];
	$time_from = $get['time_from'];
	$proctor = $get['proctor'];
	
	$query = mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1) or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1)");
	
	$check_conflict = mysql_num_rows($query);
	if($check_conflict > 0){
		return "danger";
	}
	else{
		return "";
	}
}

function checkConflict($room, $date, $time_from, $proctor)
{
	$result = false;
	
	$query = mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1) or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1)");
	
	$check_conflict = mysql_num_rows($query);
	if($check_conflict > 0){
		$result = true;
	}
	
	return $result;

}



function checkTempConflict($room, $date, $time_from, $proctor)
{
	$result = false;
	
	$query = mysql_query("select * from exam where (room='$room' and date='$date' and time_from='$time_from' and is_approved!=-1) or (proctor='$proctor' and date='$date' and time_from='$time_from' and is_approved!=-1)");
	
	$check_conflict = mysql_num_rows($query);
	if($check_conflict > 0){
		$result = true;
	}


	return $result;

}

function studentConflict($Id, $user)
{
	$get = mysql_fetch_array(mysql_query("select * from exam where Id='$Id'"));
	$date = $get['date'];
	$time_from = $get['time_from'];
	
	$check_conflict = mysql_num_rows(mysql_query("select * from my_subjects s, exam e where s.code=e.subject_code and s.idnumber='$user' and e.is_approved!=-1 and e.date='$date' and e.time_from='$time_from' and e.Id!='$Id'"));
	if($check_conflict > 0){
		return "danger";
	}
	else{
		return "";
	}
}

function studentConflictWith($Id, $user)
{
	$get = mysql_fetch_array(mysql_query("select * from exam where Id='$Id'"));
	$date = $get['date'];
	$time_from = $get['time_from'];
	
	$query = mysql_query("select * from my_subjects s, exam e where s.code=e.subject_code and s.idnumber='$user' and e.is_approved=1 and e.date='$date' and e.time_from='$time_from' and e.Id!='$Id'");
	$check_conflict = mysql_num_rows($query);
	$get2 = mysql_fetch_array($query);
	if($check_conflict > 0){
		return "<font size='0.5px' color='red'>Conflict with:<br>" . $get2['subject_code']. ", ". $get2['time_from']. "-". $get2['time_to']. ", ". $get2['room']. "</font>";
	}
	else{
		return "";
	}
}

function studentSubjectConflictWith($idnumber, $subject, $date, $time_from, $time_to)
{
	
	$query = mysql_query("select * from my_subjects s, exam e where s.idnumber='$idnumber' and s.code = e.subject_code and e.subject_code!='$subject' and e.date = '$date' and e.time_from = '$time_from' and e.time_to = '$time_to' order by s.Id desc");
	$check_conflict = mysql_num_rows($query);
	$get2 = mysql_fetch_array($query);
	if($check_conflict > 0){
		return "<font color='red'>" . $get2['subject_code']. ", ". $get2['time_from']. "-". $get2['time_to']. ", ". $get2['room']. "</font>";
	}
	else{
		return "";
	}
}

?>