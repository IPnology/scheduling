<?php
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';

if (!$_SESSION['user_session'])
	{
		header("Location: ../user");	
	}
else{
	$user = $_SESSION['user_session'];
}
?>

<form action="process.php?action=changepassword" method="POST">
<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
			<h3 class="panel-title">Change password</h3>
        </div>
		<br>
		<center>
			Hi <?=fullname($user);?>.<br> 
			It seems that it is your first time to visit
			this site. We recommend you to create your own password
			before entering your home page. Thank you!
		</center>
		
		<?php if ($error!=""){?>
		<div class="list-group-item list-group-item-danger"><?=$error?></div>
		<?php }?>
		
        <div class="panel-body">
			<fieldset>
				<div class="form-group">
					<input type="hidden" name="idnumber" value="<?=$user?>">
                    <input class="form-control" placeholder="New Password" name="password" type="password" required>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Re-type New Password" name="password2" type="password" required>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
				
            </fieldset>
        </div>
	</div>
</div>
</form>