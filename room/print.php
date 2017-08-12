<?php
$query = mysql_query("select * from room order by Id desc");
?>

<div class="panel-heading">
	List of Rooms
</div>
<!-- /.panel-heading -->
<div class="panel-body">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
				<th>Room #</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row=mysql_fetch_array($query)){
			extract($row);
		?>
			<tr class="odd gradeX">
				<td><?=$room;?></td>
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