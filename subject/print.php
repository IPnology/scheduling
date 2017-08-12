<?php
$query = mysql_query("select * from subject order by Id desc");
?>

<div class="panel-heading">
	List of Subjects
</div>

<div class="panel-body">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>Code</th>
				<th>Name</th>
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
				</td>
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