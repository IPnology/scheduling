<?php
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';

$query = mysql_fetch_array(mysql_query('select * from exam where Id='.$id));
extract($query);
?>


<div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Reason of denying this exam schedule request</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Date and Time</th>
                                        <th>Room</th>
                                        <th>Course</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td><?=$subject_code;?></td>
                                        <td><?=$date;?></br><?=date("h:i A", strtotime($time_from));?>-<?=date("h:i A", strtotime($time_to));?></td>
                                        <td><?=$room;?></td>
                                        <td><?=$course;?></td>
                                    </tr>
                                </tbody>
                            </table>
			
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
                            Please state the reason of denying this schedule.
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="process.php?action=deny_reason" method="POST">
										<input type="hidden" name="id" value="<?=$Id?>">
										
                                        <div class="form-group input-group">
											<textarea rows="4" cols="300" name="reason" class="form-control"></textarea>
                                        </div>
										
                                        
											
										<div class="form-group col-xs-12">
											<button type="submit" class="btn btn-primary">Submit</button>
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