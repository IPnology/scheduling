<?php
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

$query = mysql_query("select * from exam_tmp where Id=$id");
$row = mysql_fetch_array($query);
extract($row);
?>


<div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Update an exam schedule request</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<?php if ($success !=""){?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?=$success;?>
					</div>
					<?php }?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Fill in the forms completely
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="process.php?action=updateConflict" method="POST">
									<input type="hidden" name="id" value="<?=$Id?>">
									
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Subject</span>
											<select  name="subject_code" class="form-control" required>
													<?=buildSubjectOptions($subject_code);?>
											</select>
                                        </div>
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Date</span>
                                            <input type="date" name="date" value="<?=$date?>" class="form-control" placeholder="Type User's ID number" required>
                                        </div>
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Time</span>
												<select  name="time" class="form-control" required>
														<option value="730">7:30 AM-9:30 AM</option>
														<option value="10">10:00 AM-12:00 NN </option>
														<option value="1">1:00 PM-3:00 PM</opton>
														<option value="330">3:30 PM-5:30 PM</option>
														<option value="6">6:00 PM-8:00 PM</option>
												</select>
                                        </div>
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Room</span>
                                            <input type="text" name="room" value="<?=$room?>" class="form-control" placeholder="" required>
                                        </div>
                                       
										<div class="form-group">
											<label>Proctor</label>
											<select  name="proctor" class="form-control" required>
													<?=buildProctorOptions($proctor);?>
											</select>
											
											<input type="hidden" name="password" value="temppassword">
										</div>
                                       
										<div class="form-group">
											<label>Mentor</label>
											<select  name="mentor" class="form-control" required>
													<?=buildMentorOptions($mentor);?>
											</select>
											
											<input type="hidden" name="password" value="temppassword">
										</div>
                                       
										<div class="form-group">
										
											<div class="col-xs-3">
											
												<label>Course</label>
												<select  name="course" class="form-control" required>
														<option>BSBA</option>
														<option>BSIT</option>
														<option>BSHM</option>
														<option>BSTM</option>
												</select>
											</div>
											
										
											<div class="col-xs-3">
											
												<label>Year</label>
												<select  name="year" class="form-control" required>
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
												</select>
											</div>
											
										
											<div class="col-xs-3">
											
												<label>Section</label>
												<select  name="section" class="form-control" required>
														<option>A</option>
														<option>B</option>
														<option>C</option>
														<option>D</option>
												</select>
											</div>
											
											<input type="hidden" name="password" value="temppassword">
										</div>
										
										<br>
										<br>
										<br>
										<br>
										
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">School Year</span>
                                            <input type="text" name="sy" value="<?=$sy?>" class="form-control" placeholder="" required>
											
                                        </div>
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Semester</span>
                                            <input type="text" name="sem" value="<?=$sem?>" class="form-control" placeholder="" required>
											
                                        </div>
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Term</span>
                                            <input type="text" name="term" value="<?=$term?>" class="form-control" placeholder="" required>
											
                                        </div>
										
										<div class="form-group col-xs-12">
											<button type="submit" class="btn btn-primary">Submit Request</button>
										</div>
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