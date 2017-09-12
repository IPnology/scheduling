<?php
if (editableFaculty($idnumber, $date, $timeFrom) == 'vacant'){
?>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal_<?=$dialogId?>">
	<i class="fa fa-plus"></i>
</button>
<?php
}else if (editableFaculty($idnumber, $date, $timeFrom) == 'pending'){
?>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#confirmation_<?=$dialogId?>">
	<i class="fa fa-trash"></i>
</button>

<?php
}
?>
          

<div class="modal fade" id="myModal_<?=$dialogId?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add an exam</h4>
      </div>
      <div class="modal-body">
		<form action="process.php?action=quickCreateFaculty" method="POST">
		<input type="hidden" value="<?=$idnumber?>" name="proctor">
		<input type="hidden" value="<?=$timeFrom?>" name="timeFrom">
		<input type="hidden" value="<?=$timeTo?>" name="timeTo">
		<input type="hidden" value="<?=$date?>" name="date">
	
		<div class="form-group input-group">
			<span class="input-group-addon">Subject</span>
			<select  name="subject_code" class="form-control" required>
					<?=buildSubjectOptions();?>
			</select>
		</div>
		
		
		<div class="form-group input-group">
			<span class="input-group-addon">Room</span>
			<select  name="room" class="form-control" required>
					<?=buildRoomOptions();?>
			</select>
			
		</div>
		
		
		<div class="form-group input-group">
			<span class="input-group-addon">Mentor</span>
			<select  name="mentor" class="form-control" required>
					<?=buildProctorOptions();?>
			</select>
			
		</div>
		
		
		<div class="form-group input-group">
									
			<div class="col-xs-3">
			
				<label>Course</label>
				<select  name="course" class="form-control" required>
						<option>BSBA</option>
						<option>BSIT</option>
						<option>BSHM</option>
						<option>BSTM</option>
				</select>
			</div>
			
		
			<div class="col-xs-3">
			
				<label>Year</label>
				<select  name="year" class="form-control" required>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
				</select>
			</div>
			
		
			<div class="col-xs-3">
			
				<label>Section</label>
				<select  name="section" class="form-control" required>
						<option>A</option>
						<option>B</option>
						<option>C</option>
						<option>D</option>
				</select>
			</div>
			
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">OK</button>
      </div>
	</form>
    </div>
  </div>
</div>



<div class="modal fade" id="confirmation_<?=$dialogId?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		<div style="text-align: center; color: #DB1717;">
			Are you sure you want to delete this?
		</div>
		<div style="text-align: center; color: #BB2929; font-size: 50px;">
			<i class="fa fa-trash"></i>
		</div>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-danger"
				onclick="location.href='process.php?action=removeExamFaculty&date=<?=$date?>&id=<?=getExamFacultyId($idnumber, $date, $timeFrom)?>'">
				Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>