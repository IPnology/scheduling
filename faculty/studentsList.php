<?php

$subject = (isset($_GET['subject']) && $_GET['subject'] != '') ? $_GET['subject'] : '';
$query = mysql_query("select * from my_subjects s, exam e where s.facultyId='$user' and s.code='$subject' and s.code = e.subject_code order by s.Id desc");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?=$subject?> Students</h1>
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
                            List of Students for <?=$subject?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Conflict With</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while($row=mysql_fetch_array($query)){
									extract($row);
								?>
                                    <tr class="odd gradeX">
                                        <td><?=fullname($row['idnumber']);?></td>
                                        <td><?=studentSubjectConflictWith($row['idnumber'], $row['subject_code'], $row['date'], $row['time_from'], $row['time_to'])?></td>
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
			
