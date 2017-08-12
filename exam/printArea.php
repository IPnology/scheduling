<?php
$user = $_SESSION['user_session'];
$area = mysql_fetch_array(mysql_query("select * from area_head where idnumber='$user'"));
$course = $area['area'];
$query = mysql_query("select * from exam where is_approved=1 and course like '$course%'");
?>

<div class="panel-heading">
	Exam Schedule <?=$course;?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>Subject Code</th>
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
			<tr class="odd gradeX <?=facultyConflict($Id, $user)?>">
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
window.print();
window.history.back();
</script>
			

