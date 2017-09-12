

<?php
$date = (isset($_GET['date']) && $_GET['date'] != '') ? $_GET['date'] : date("Y-m-d");
$query = mysql_query("select * from room");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Exam Schedule</h1>
					<form value="../exam" method="GET">
						<input type="date" name="date" value="<?=$date?>">
						<input type="hidden" name="view" value="adminGridList">
						<button type="submit">Search</button>
					</form>
                </div>
                <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		
		
			<div class="panel panel-default">
                        <div class="panel-body">
						<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Room</th>
                                            <th>7:30-9:30am</th>
                                            <th>9:30-11:30am</th>
                                            <th>1:30-3:30pm</th>
                                            <th>3:30-5:30pm</th>
                                            <th>6:00-8:00pm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
							
					<?php
					while($row=mysql_fetch_array($query)){
						extract($row);
					?>
					
				
                                        <tr style="width:150px; height:150px;">
                                            <th><?=$room;?></th>
                                            <td>
												<?=getExam($room, $date, "07:30:00")?>
												<?php
												$dialogId = $room . "730";
												$timeFrom = "07:30:00";
												$timeTo= "09:30:00";
												include "snippetExamDialog.php";?>
												
											</td>
											
                                            <td>
												<?=getExam($room, $date, "09:30:00")?>
												<?php
												$dialogId = $room . "930";
												$timeFrom = "09:30:00";
												$timeTo= "11:30:00";
												include "snippetExamDialog.php";?>
												
											</td>
											
                                            <td>
												<?=getExam($room, $date, "13:30:00")?>
												
												<?php
												$dialogId = $room . "1330";
												$timeFrom = "13:30:00";
												$timeTo= "15:30:00";
												include "snippetExamDialog.php";?>
											</td>
											
                                            <td>
												<?=getExam($room, $date, "15:30:00")?>
												
												
												<?php
												$dialogId = $room . "1530";
												$timeFrom = "15:30:00";
												$timeTo= "17:30:00";
												include "snippetExamDialog.php";?>
											</td>
											
                                            <td>
												<?=getExam($room, $date, "18:00:00")?>
											
												<?php
												$dialogId = $room . "1830";
												$timeFrom = "18:00:00";
												$timeTo= "20:30:00";
												include "snippetExamDialog.php";?>
											</td>
                                        </tr>
                            
                           
			
			
					<?php
					}
					?>
					
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
				 
	</div>
	<!-- /.col-lg-12 -->
</div>


