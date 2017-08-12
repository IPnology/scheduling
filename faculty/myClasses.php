<?php
$query = mysql_query("select * from my_subjects where idnumber='$user'");

$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
?>

<ul class="nav nav-second-level">

	<?php
	if(mysql_num_rows($query)>0){
		while($row=mysql_fetch_array($query)){
			extract($row);
		?>
		<li>
			<a href="#"><?=$code?></a> 
		</li>
	<?php
	}
	}
	else {?>
		<li>
			<a href="#">No Subjects Yet</a> 
		</li>
	<?php
	}
	?>
		
</ul>
