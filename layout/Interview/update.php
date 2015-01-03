<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);
$traineeData = GlobalCrud::getData('traineeSelect');
$employeeData = GlobalCrud::getData('employeeSelect');
$clientData = GlobalCrud::getData('clientSelect');
$timeConstants = explode(',', GlobalCrud::getConstants("timeConstants"));
$statusConstants = explode(',', GlobalCrud::getConstants("statusConstants"));

$id = null;
if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ( null==$id ) {
	header("Location: index.php?content=22");
}

if ( !empty($_POST)) {
	//traineeid assistedby clientid interviewer time status date description
	$traineeid = $_POST['traineeid'];
	$assistedby = $_POST['assistedby'];
	$clientid=$_POST['clientid'];
	$interviewer=$_POST['interviewer'];
	$time=$_POST['time'];
	$status=$_POST['status'];
	//$created_date = $_POST['created_date'];
	$updatedDate = date("Y/m/d");
	$description = $_POST['description'];
	$date= $_POST['date'];


	// validate input
	$valid = true;
	
	if (empty($traineeid)) {
		$valid = false;
	}
	if (empty($assistedby)) {
		$valid = false;
	}
	if (empty($clientid)) {
		$valid = false;
	}
	if (empty($interviewer)) {
		$valid = false;
	}
	if (empty($time)) {
		$valid = false;
	} 
	if (empty($status)) {
		$valid = false;
	}
	 if (empty($date)) {
		$valid = false;
	} 

	// update data
	if ($valid) {
		$sql = "interviewUpdate";
		$sqlValuesForUpdate = array($traineeid,$assistedby,$clientid,$interviewer,$time,$status,$updatedDate,$description,$date,$id);
		GlobalCrud::update($sql,$sqlValuesForUpdate);
		header("Location:../?content=22");
	}

}

else {
	$sql = "interviewSelectById";
	$sqlValues = array($id);
	$data = GlobalCrud::selectById($sql,$sqlValues);
	$traineeid = $data['trainee_id'];
	$assistedby = $data['assisted_by'];
	$clientid=$data['client_id'];
	$interviewer=$data['interviewer'];
	$time=$data['time'];
	$status=$data['status'];
	//$created_date = $data['created_date'];
	//$updated_date = $data['updated_date'];
	$description = $data['description'];
	$date=$data['date'];

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">

		<div class="span10 offset1">
			<div class="row">
				<h3>Update A Interview</h3>
			</div>

			<form class="form-horizontal"
				action="./interview/update.php?id=<?php echo $id?>" method="post">

				<div class="control-group">
					<label class="control-label">Trainee Name</label>
					<div class="controls">
						<select name="traineeid" type="text">
							<option value="0">Select</option>
							<?php foreach ($traineeData as $row): ?>
							<option <?php if($row['id'] == $traineeid) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php }else {?>	value="<?=$row['id']?>" >
								<?php
							}
							echo $row ['name'];
							?>
							</option>

							<?php endforeach ?>
							</option>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Assisted By</label>
					<div class="controls">
						<select name="assistedby" type="text">
							<option value="0">Select</option>
							<?php foreach ($employeeData as $row): ?>
							<option <?php if($row['id'] == $assistedby) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php
}
else {
								?>
								value="<?=$row['id']?>" >
								<?php
							}
							echo $row ['name'];
							?>
							</option>

							<?php endforeach ?>
							</option>
						</select>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label">Client Name</label>
					<div class="controls">
						<select name="clientid" type="text">
							<option value="0">Select</option>

							<?php foreach ($clientData as $row): ?>
							<option <?php if($row['id'] == $clientid) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php }else {?>	value="<?=$row['id']?>">
								<?php }	echo $row ['name'];	?></option>

							<?php endforeach ?>
						</select>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label">End Client</label>
					<div class="controls">
						<input name="interviewer" type="text" placeholder="end client"
							value="<?php echo !empty($interviewer)?$interviewer:'';?>"
							required>

					</div>
				</div>



				<div class="control-group">
					<label class="control-label">Time</label>
					<div class="controls">
						<select name="time" type="time">
							<option value="0">Select</option>
							<?php foreach ($timeConstants as $timeConstant): ?>
							<option <?php if($timeConstant == $time) {?> selected="selected"
								value=" <?=$timeConstant?>"><?php }else {?>	value="<?=$timeConstant?>">
								<?php }echo $timeConstant;?>
							</option>

							<?php endforeach ?>
							</option>
						</select>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label">Status</label>
					<div class="controls">
						<select name="status" type="text">
							<option value="0">Select</option>
							<?php foreach ($statusConstants as $constant): ?>

							<option <?php if($constant == $status) {  ?> selected="selected"
								value="<?=$constant?>">	<?php } else {?>
								value="<?=$constant?>">
								<?php
							}
							echo  $constant;
							?>
								<?php endforeach ?>
							</option>
						</select>

					</div>
				</div>

				<!--  <div class="control-group"> 
					    <label class="control-label">Created Date</label>
					    <div class="controls">
					      	<input name="createdDate" type="date" placeholder="Created Date" value="<?php echo !empty($createddate)?$createddate:'';?>" required>
					      	
					    </div>
					  </div>
					  <div class="control-group"> 
					    <label class="control-label">Updated Date</label>
					    <div class="controls">
					      	<input name="updatedDate" type="date"  placeholder="Updated Date" value="<?php echo !empty($updateddate)?$updateddate:'';?>" required>
					      
					    </div>
					  </div> -->


				<div class="control-group">
					<label class="control-label">Interview Date</label>
					<div class="controls">
						<input name="date" type="date" placeholder="date"
							value="<?php echo !empty($date)?$date:'';?>" required>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" type="text" placeholder="description">
					      	<?php echo !empty($description)?$description:'';?>
					      	</textarea>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn" href="index.php">Back</a>
				</div>
			</form>
		</div>

	</div>
	<!-- /container -->
</body>
</html>
