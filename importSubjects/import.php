<?php
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
?>

            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-body">
						
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="process.php?action=upload" method="POST"  enctype="multipart/form-data">
									
                                        <div class="form-group input-group">
                                            <input type="file" name="excel_file" required>
                                        </div>
										
                                        <div class="form-group input-group">
										<button type="submit" class="btn btn-primary">upload</button>
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