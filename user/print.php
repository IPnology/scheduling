<?php
$query = mysql_query("select * from user");
?>

<div class="panel-heading">
	Users List
</div>
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
</div>

<script>
window.print();
window.history.back();
</script>
