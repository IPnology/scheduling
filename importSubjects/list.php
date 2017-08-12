<?php
$query = mysql_query("select * from my_subjects order by Id desc");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Import Subjects of Students</h1>
                </div>
                <!-- /.col-lg-12 -->
				
</div>

<?php
include 'import.php';
?>

<?php if ($success !=""){?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?=$success;?>
	</div>
<?php }?>


<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Subjects
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id Number</th>
                                        <th>Code</th>
                                        <th>Time</th>
                                        <th>Schedule</th>
                                        <th>Faculty;</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while($row=mysql_fetch_array($query)){
									extract($row);
								?>
                                    <tr class="odd gradeX">
                                        <td><?=$idnumber;?>
                                        <td><?=$code;?></td>
                                        <td><?=$time;?></td>
                                        <td><?=$sched;?></td>
                                        <td><?=$facultyId;?></td>
										</td>
                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>
							<button onclick="location.href='process.php?action=resetSubjects'">Reset Subjects</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
