<?php
$query = mysql_query("select * from exam_tmp");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data ready to be imported</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>

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
					
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Please double check the exam schedule. Data highted in red is conflict and will not be uploaded. If you are sure click
							
											<button class="btn btn-primary" onClick="location.href='process.php?action=upload_now'"><i class="fa fa-upload"></i>&nbsp; Upload</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Mentor</th>
                                        <th>Proctor</th>
                                        <th>Date and Time</th>
                                        <th>Room</th>
                                        <th>Course</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while($row=mysql_fetch_array($query)){
									extract($row);
								?>
                                    <tr class="odd gradeX <?=tempConflict($Id)?>">
                                        <td><?=$subject_code;?></td>
                                        <td><?=fullname($mentor);?></td>
                                        <td><?=fullname($proctor);?></td>
                                        <td><?=$date;?></br><?=date("h:i A", strtotime($time_from));?>-<?=date("h:i A", strtotime($time_to));?></td>
                                        <td><?=$room;?></td>
                                        <td><?=$course;?></td>
                                        <td>
											<button class="btn btn-danger" onClick="location.href='process.php?action=remove&id=<?=$Id?>'"><i class="fa fa-trash"></i></button>
											
										</td>
                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
