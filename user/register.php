<?php
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
?>

<div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Register a New User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
<?php
include 'import.php';
?>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<?php if ($success !=""){?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?=$success;?>
					</div>
					<?php }?>
					<?php if ($error !=""){?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?=$error;?>
					</div>
					<?php }?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="process.php?action=register" method="POST">
									
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">ID number</span>
                                            <input type="text" name="idnumber" class="form-control" placeholder="Type User's ID number" required>
                                        </div>
									
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">First Name</span>
                                            <input type="text" name="firstname" class="form-control" placeholder="Type User's First Name" required>
                                        </div>
									
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Last Name</span>
                                            <input type="text" name="lastname" class="form-control" placeholder="Type User' Last Name" required>
                                        </div>
                                       
										<div class="form-group">
											<label>User Authorization</label>
											<select id="auth" name="auth" class="form-control" required>
												<option value="">--Select Auth--</option>
												<option>Admin</option>
												<option>VPAA</option>
												<option>Area Head</option>
												<option>Faculty</option>
												<option>Student</option>
											</select>
											
                                            <p class="help-block">User's temporary password is <b>temppassword</b></p>
											
											<input type="hidden" name="password" value="temppassword">
										</div>
										
										
											<!--area head-->
										
                                       
										<div class="form-group" id="area" style='display:none;'>
											<label>Area</label>
											
                                            <p class="help-block">Please choose an area of this chosen user</p>
											<select  name="area" class="form-control">
												<option value="">--Select Area--</option>
														<option value="BSBA">Business Administration</option>
														<option value="BSIT">Information Technology</option>
														<option value="BSHM">Hospitality Management</option>
														<option value="BSTM">Tourism Management</option>
											</select>
										
										</div>
											
											
											<!--student-->
											
										<div class="form-group" id="course" style='display:none;'>
										
                                            <p class="help-block">Please choose students course, year and section</p>
										
											<div class="col-xs-3">
											
												<label>Course</label>
												<select  name="course" class="form-control">
														<option>BSBA</option>
														<option>BSIT</option>
														<option>BSHM</option>
														<option>BSTM</option>
												</select>
											</div>
											
										
											<div class="col-xs-3"  id="year" style='display:none;'>
											
												<label>Year</label>
												<select  name="year" class="form-control">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
												</select>
											</div>
											
										
											<div class="col-xs-3"  id="section" style='display:none;'>
											
												<label>Section</label>
												<select  name="section" class="form-control">
														<option>A</option>
														<option>B</option>
														<option>C</option>
														<option>D</option>
												</select>
											</div>
											<br>
										<br>
										<br>
										<br>
										
										</div>
										
										
										<button type="submit" class="btn btn-primary">Register</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>		
			<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
