<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once ($path);
$dataTechnology = GlobalCrud::getData ( 'technologySelect' );
$dataTrainer = GlobalCrud::getData ( 'trainerSelect' );
$constants = explode ( ',', GlobalCrud::getConstants ( "timeConstants" ) );
$statusconstants = explode ( ',', GlobalCrud::getConstants ( "statusConstants" ) );

if (! empty ( $_POST )) {
	$technologyid = $_POST ['technologyid'];
	$trainerid = $_POST ['trainerid'];
	$startdate = $_POST ['startdate'];
	$enddate = $_POST ['enddate'];
	$duration = $_POST ['duration'];
	$status = $_POST ['status'];
	$createdDate = date ( "Y/m/d" );
	// $updatedDate = $_POST['updatedDate'];
	$description = $_POST ['description'];
	$time = $_POST ['time'];

	// validate input
	$valid = true;

	if (empty ( $technologyid )) {
		$valid = false;
	}
	if (empty ( $trainerid )) {
		$valid = false;
	}
	if (empty ( $startdate )) {
		$valid = false;
	}
	if (empty ( $enddate )) {
		$valid = false;
	}
	if (empty ( $duration )) {
		$valid = false;
	}
	if (empty ( $status )) {
		$valid = false;
	}
	if (empty ( $time )) {
		$valid = false;
	}

	// insert data
	if ($valid) {
		$sql = "batchInsert";
		$sqlValues = array (
				$technologyid,
				$trainerid,
				$startdate,
				$enddate,
				$duration,
				$status,
				$createdDate,
				$description,
				$time
		);
		GlobalCrud::setData ( $sql, $sqlValues );
		header ( "Location:../?content=10" );
	} else {

		header ( "Location:../?content=11" );
	}
}

/*
 * if ( !empty($_GET)) {
* echo "<script type='text/javascript'>alert('get');</script>";
* }
*/
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
				<h3>Create a Batch</h3>
			</div>

			<form class="form-horizontal" action="./batch/create.php"
				method="post">

				<!-- <div class="control-group ">
					    <label class="control-label">ID</label>
					  <div class="controls">
					      	<input name="id" type="text"  placeholder="id" value="<?php echo !empty($id)?$id:'';?>" required>
					    </div>
					  </div>  -->

				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Technology Name</label>
						<div class="controls">
							<select name="technologyid" type="text">
								<option value="0">Select</option>
								<?php foreach ($dataTechnology as $row): ?>
								<option value="<?=$row['id']?>">
									<?php	echo $row ['name'];?>
									<?php endforeach ?>
								</option>
							</select>
						</div>
					</div>
				</div>

				<!-- <div class="control-group ">
					    <label class="control-label">Trainer Name</label>
					  <div class="controls">
					      	<input name="trainerid" type="text"  placeholder="Trainer" value="<?php echo !empty($trainerid)?$trainername:'';?>" required>
					    </div>
					  </div> -->

				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Trainer Name</label>
						<div class="controls">
							<select name="trainerid" type="text">
								<option value="0">Select</option>
								<?php foreach ($dataTrainer as $row): ?>
								<option value="<?=$row['id']?>">
									<?php	echo $row ['name'];?>
									<?php endforeach ?>
								</option>
							</select>
						</div>
					</div>
				</div>
				<div class="control-group ">
					<div class="form-group required">
						<label class="control-label">Start Date</label>
						<div class="controls">
							<input name="startdate" type="date" placeholder="start date"
								value="<?php echo !empty($startdate)?$startdate:'';?>" required>
						</div>
					</div>
				</div>

				<div class="control-group ">
					<label class="control-label">End Date</label>
					<div class="controls">
						<input name="enddate" type="date" placeholder="end date"
							value="<?php echo !empty($enddate)?$enddate:'';?>" required>
					</div>
				</div>

				<div class="control-group ">
					<label class="control-label">Duration</label>
					<div class="controls">
						<input name="duration" type="text" placeholder="duration"
							value="<?php echo !empty($duration)?$duration:'';?>" required>
					</div>
				</div>

				<!--  <div class="control-group ">
					    <label class="control-label">Status</label>
					    <div class="controls">
					      	<input name="status" type="text"  placeholder="Status" value="<?php echo !empty($status)?$status:'';?>" required>
					    </div>
					  </div> -->

				<div class="control-group ">
					<label class="control-label">Status</label>
					<div class="controls">
						<select name="status">
							<option value="">Select</option>
							<?php foreach ($statusconstants as $constant): ?>
							<option value="<?=$constant?>">
								<?php	echo $constant;?>
								<?php endforeach ?>
						
						</select>
					</div>
				</div>

				<!--  <div class="control-group ">
					    <label class="control-label">Time</label>
					   <div class="controls">
					      	<input name="time" type="time"  placeholder="Time" value="<?php echo !empty($time)?$time:'';?>" required>
					    </div>
					  </div> -->

				<div class="control-group ">
					<label class="control-label">Time</label>
					<div class="controls">
						<select name="time">
							<option value="">Select</option>
							<?php foreach ($constants as $constant): ?>
							<option value="<?=$constant?>">
								<?php	echo $constant;?>
								<?php endforeach ?>
						
						</select>
					</div>
				</div>


				<div class="control-group ">
					<label class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" type="text" placeholder="description"
							value="<?php echo !empty($description)?$description:'';?>">
					      	</textarea>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="index.php">Back</a>
				</div>
			</form>
		</div>

	</div>
	<!-- /container -->
</body>
</html>
