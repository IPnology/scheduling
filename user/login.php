<?php
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
?>

<form action="process.php?action=login" method="POST">
<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
			<h3 class="panel-title">Please Sign In</h3>
        </div>
		<br>
		<center>
			<img src="../include/images/csab_logo.png">
		</center>
		
		<?php if ($error!=""){?>
		<div class="list-group-item list-group-item-danger"><?=$error?></div>
		<?php }?>
		
        <div class="panel-body">
			<fieldset>
				<div class="form-group">
					<input class="form-control" placeholder="ID number" name="idnumber" required>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
				
            </fieldset>
        </div>
	</div>
</div>
</form>