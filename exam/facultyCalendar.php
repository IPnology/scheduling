<?php
$query = mysql_query("select * from exam where is_approved=1 and (mentor='$user' or proctor='$user')");
?>

<link rel='stylesheet' type='text/css' href='../include/calendar/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='../include/calendar/fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='../include/calendar/jquery/jquery-1.8.1.min.js'></script>
<script type='text/javascript' src='../include/calendar/jquery/jquery-ui-1.8.23.custom.min.js'></script>
<script type='text/javascript' src='../include/calendar/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			events: [
			
			
				<?php
				while($row=mysql_fetch_array($query)){
					extract($row);
						$y = date('Y', strtotime($date));
						$m = (date('m', strtotime($date)))-1;
						$d = date('d', strtotime($date));
						
						$fromH = date('H', strtotime($time_from));
						$fromI = date('i', strtotime($time_from));
						
						$toH = date('H', strtotime($time_to));
						$toI = date('i', strtotime($time_to));
				?>
					{
						title: '<?=$subject_code?>',
						start: new Date(<?=$y;?>, <?=$m;?>, <?=$d;?>, <?=$fromH?>, <?=$fromI?>),
						end: new Date(<?=$y;?>, <?=$m;?>, <?=$d;?>, <?=$toH?>, <?=$toI?>),
						allDay: false
					},
					<?php
								}
								?>
			]
		});
		
	});

</script>

<div class="row">
<br>
<br>
	<div id='calendar'></div>
<br>
<br>
</div>
