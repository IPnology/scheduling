<?php
$query = mysql_query("select * from subject order by Id desc");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Subjects</h1>
                </div>
                <!-- /.col-lg-12 -->
				
</div>

<?php
include 'import.php';
include 'add.php';
?>


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
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while($row=mysql_fetch_array($query)){
									extract($row);
								?>
                                    <tr class="odd gradeX">
                                        <td><?=$code;?></td>
                                        <td><?=$name;?></td>
                                        <td> <button class="btn btn-danger" onclick="location.href='process.php?action=delete&id=<?=$Id?>'">Delete</button>
										</td>
                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>
							<button onclick="location.href='?view=print'">Print</button>
							<button onclick="location.href='process.php?action=export'">Export</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
