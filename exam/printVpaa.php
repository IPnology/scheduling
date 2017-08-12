<?php
$query = mysql_query("select * from exam where is_approved=0");
?>

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
				<td><?=$course;?></td>
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
			
