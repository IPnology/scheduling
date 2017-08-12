<?php

require_once '../config/database.php';
require_once '../config/function.php';

$action = $_GET['action'];	
	
switch ($action) {
    
	case 'login' :
		login();
		break;

	case 'register' :
		register();
		break;
		
	case 'upload':
		upload();
		break;
		
	case 'export':
		export();
		break;
	
	case 'changepassword' :
		changepassword();
		break;
		
	case 'logout' :
		logout();
		break;
	
	default :
}


function login()
{
	// if we found an error save the error message in this variable
	
	$idnumber = $_POST['idnumber'];
	$password = $_POST['password'];
	
	$query = mysql_query("select * from user where idnumber = '".$idnumber."' and password = '".md5($password)."'");
	
	if (mysql_num_rows($query) != 0)
	{

		$_SESSION['user_session'] = $idnumber;
		if (md5($password) == md5('temppassword')){
			header('Location: index.php?view=changepassword');
		}
		else{
			header('Location: ../home/');
		}

			
	}
	else
	{
		header('Location: index.php?error=User not found in the Database');
	}
	
}


function logout()

{
	if (isset($_SESSION['user_session'])) {
		unset($_SESSION['user_session']);
	}
	header('Location: index.php');
	exit;
}


function register()
{
	$idnumber = $_POST['idnumber'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$auth = $_POST['auth'];
	$password = $_POST['password'];
	
	$area = $_POST['area'];
	$course = $_POST['course'];
	$year = $_POST['year'];
	$section = $_POST['section'];
	
		if (user_exist($idnumber)!=true){
			mysql_query("insert into user set idnumber='$idnumber',
															first_name='$firstname',
															last_name='$lastname',
															password=md5('$password'),
															auth='$auth'");
			
			if ($auth == 'Area Head'){		
				mysql_query("insert into area_head set idnumber='$idnumber',
															area='$area'");
			}
			else if($auth == 'Student'){												
				mysql_query("insert into student set idnumber='$idnumber',
															course='$course',
															year='$year',
															section='$section'");
			}
			
			header('Location: index.php?view=register&success=You have successfully registered a new user');
		}else{
			header('Location: index.php?view=register&error=Id Number already exists.');
		}
}

function upload(){
	
	$file = $_FILES['excel_file']['tmp_name'];
	$handle = fopen($file, "r");
	$info = pathinfo($file);
	
	$ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
	
	$success = 0;
	$fail = 0;
	
	if ($file == NULL || $ext != "csv") {
		
		header('Location: index.php?error=File Invalid');
    }else {
		$row = 1;
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
			if($row == 1){ $row++; continue; }
			
			$idnumber = $filesop[0];
			$first_name = $filesop[1];
			$last_name = $filesop[2];
			$auth = $filesop[3];
			
			$area = $filesop[4];
			$course = $filesop[5];
			$year = $filesop[6];
			$section = $filesop[7];

			if (user_exist($idnumber)!=true){
				
				if ($auth == "Area Head"){
					if ($area == ""){
						$fail += 1;
					}
					else{
						
					mysql_query("insert into user set idnumber='$idnumber',
														password=md5('temppassword'),
														first_name='$first_name',
														last_name='$last_name',
														auth='$auth'
														");
					mysql_query("insert into area_head set idnumber='$idnumber',
														area='$area'");
						
						$success +=1;
					}
				}
				else if ($auth=='Student'){
					if ($course == "" || $year == "" || $section == ""){
						$fail += 1;
					}
					else{
						mysql_query("insert into user set idnumber='$idnumber',
														password=md5('temppassword'),
														first_name='$first_name',
														last_name='$last_name',
														auth='$auth'
														");
								
						mysql_query("insert into student set idnumber='$idnumber',
														course='$course',
														year='$year',
														section='$section'");
						
						$success +=1;
					}
				}
				
				else if ($auth == "VPAA" || $auth == "Admin" || $auth =="Faculty"){
					
					mysql_query("insert into user set idnumber='$idnumber',
														password=md5('temppassword'),
														first_name='$first_name',
														last_name='$last_name',
														auth='$auth'
														");
						$success += 1;
				}
				else{}										
				
			}else{
				$fail += 1;
			}
			
		}
		header('Location: index.php?view=register&success='.$success.' has successfully uploaded and '.$fail.' failed.');	
	}
}

function changepassword()
{
	$idnumber = $_POST['idnumber'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];


	if ($password == $password2){
		
		if (md5($password) != md5('temppassword')){
			mysql_query("update user set	password=md5($password)
											where idnumber = '$idnumber'");
													
			header('Location: ../home');
		}
		else{
			header('Location: index.php?view=changepassword&error=Invalid Password');
		}
	}
	else
	{
		header('Location: index.php?view=changepassword&error=Password not matched');}
	
}

function delete()
{
	$id = $_GET['id'];	
	
	mysql_query("delete from user where Id = '".$id."'");
	
	header('Location: ../user/?view=list&message=Successfully Deleted.');
	
}

function update()
{
	$id = $_GET['id'];	
	
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];


	
	mysql_query("update user set username='".$username."',
												first_name='".$firstname."',
												last_name='".$lastname."',											
												password='".md5($password)."',
												auth='admin'
												where Id = '".$id."'");
												
	header('Location: ../user/?view=detail&message=Successfully Updated.');
	
}

function export()
{
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("db_scheduling",$conn);

	$filename = "userList.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='db_scheduling' AND TABLE_NAME='user'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_row($result)) {
		if ($row[0] != "Id" && $row[0] != "password"){
			$header[] = $row[0];
		}
	}	
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$num_column = count($header);		
	$query = "SELECT idnumber, first_name, last_name,auth FROM user";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
	
	
	header('Location: index.php?view=userList');
}

?>