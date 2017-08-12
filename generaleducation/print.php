<?php
$query = mysql_query("select * from exam where is_general=1");
?>

<div class="panel-heading">
	Exam Schedule for General Education
</div>

<div class="panel-body">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>Subject</th>
				<th>Mentor</th>
				<th>Proctor</th>
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
				<td><?=fullname($mentor);?></td>
				<td><?=fullname($proctor);?></td>
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
window.print()
</script>

