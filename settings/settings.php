<?php
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$query = mysql_fetch_array(mysql_query('select * from settings'));
extract($query);
?>


<div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Settings</h1>
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
                                    <form action="process.php?action=update" method="POST">
									
                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">School Year</span>
												<select  name="sy" class="form-control" required>
														<option><?=$sy;?></option>
														<option>2017-2018</option>
														<option>2018-2019</option>
														<option>2019-2020</option>
														<option>2020-2021</option>
														<option>2021-2022</option>
												</select>
                                        </div>
										
                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Semester</span>
												<select  name="sem" class="form-control" required>
														<option><?=$sem?></option>
														<option>First Semester</option>
														<option>Second Semester</option>
														<option>Summer Class</option>
												</select>
                                        </div>
										
                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Term</span>
												<select  name="term" class="form-control" required>
														<option><?=$term?></option>
														<option>Prelim</option>
														<option>Midterm</option>
														<option>Endterm</option>
												</select>
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