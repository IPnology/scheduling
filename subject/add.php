<?php
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
?>

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
                            Add Subject
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="process.php?action=add" method="POST">
									
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Code</span>
                                            <input type="text" name="code" class="form-control" required>
                                        </div>
										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Name</span>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
										
                                        <div class="form-group input-group">
										<button type="submit" class="btn btn-primary">Add Subject</button>
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