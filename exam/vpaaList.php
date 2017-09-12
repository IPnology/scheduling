<?php
$query = mysql_query("select * from exam where is_approved=0");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Exam Schedule</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
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
                            Check exam schedules.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Date and Time</th>
                                        <th>Room</th>
                                        <th>Course</th>
                                        <th>Proctor</th>
                                        <th>Mentor</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while($row=mysql_fetch_array($query)){
									extract($row);
								?>
                                    <tr class="odd gradeX <?=conflict($Id)?>">
                                        <td><?=$subject_code;?> <br>
										<?=conflictWith($Id)?>
											
										</td>
                                        <td><?=$date;?></br><?=date("h:i A", strtotime($time_from));?>-<?=date("h:i A", strtotime($time_to));?></td>
                                        <td><?=$room;?></td>
                                        <td><?=$course;?></td>
                                        <td><?=fullname($proctor);?></td>
                                        <td><?=fullname($mentor);?></td>
                                        <td width="150">
										<button class="btn btn-info" onClick="location.href='process.php?action=approve&id=<?=$Id?>'"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger" onClick="location.href='process.php?action=deny&id=<?=$Id?>'"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
										<button class="btn btn-" onClick="location.href='?view=update&id=<?=$Id?>'"><i class="fa fa-pencil" aria-hidden="true"></i></button>
										</td>
                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>
							<button onclick="location.href='?view=printVpaa'">Print</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
