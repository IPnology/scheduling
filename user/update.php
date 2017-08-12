<?php
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

$query = mysql_query("select * from user where Id = $id");

$row=mysql_fetch_array($query)
?>

<form action="process.php?action=update&id=<?=$id?>" method="POST">
	USERNAME *</br>
	<input type="text" name="username" value="<?=$row['username']?>" placeholder="your username" required>
	</br></br>
	
	FIRST NAME *</br>
	<input type="text" name="firstname" value="<?=$row['first_name']?>" placeholder="your first name" required>
	</br></br>
	
	LAST NAME *</br>
	<input type="text" name="lastname" value="<?=$row['last_name']?>" placeholder="your last name" required>
	</br></br>
	
	PASSWORD *</br>
	<input type="password" name="password" placeholder="enter password" required>
	</br></br>
	
	REPEAT PASSWORD *</br>
	<input type="password" name="repeatpassword" placeholder="enter password" required>
	</br></br>
	
	<input type="submit" class="registerbtn" value="Update Profile">
	</br></br>
</form>
</div>