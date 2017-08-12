<?php
$query = mysql_query("select * from user");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Users List
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>ID Number</th>
							<th>Name</th>
							<th>Auth</th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row=mysql_fetch_array($query)){
						extract($row);
					?>
						<tr class="odd gradeX">
							<td><?=$idnumber;?></td>
							<td><?=$first_name;?> <?=$last_name?></td>
							<td><?=$auth;?></td>
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
			
