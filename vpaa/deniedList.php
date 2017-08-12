<?php
$query = mysql_query("select * from exam where is_approved=-1");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
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
                                        <th>Mentor</th>
                                        <th>Proctor</th>
                                        <th>Course</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while($row=mysql_fetch_array($query)){
									extract($row);
								?>
                                    <tr class="odd gradeX <?=conflict($Id)?>">
                                        <td><?=$subject_code;?></td>
                                        <td><?=$date;?></br><?=date("h:i A", strtotime($time_from));?>-<?=date("h:i A", strtotime($time_to));?></td>
                                        <td><?=$room;?></td>
                                        <td><?=fullname($mentor);?></td>
                                        <td><?=fullname($proctor);?></td>
                                        <td><?=$course;?></td>
                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>
							<button onclick="location.href='?view=printDenied'">Print</button>
							<button onclick="location.href='process.php?action=exportDenied'">Export</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
