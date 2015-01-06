<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once ($path);

$selecteddataTechnology = GlobalCrud::getData ( 'technologySelect' );
$selecteddataTrainer = GlobalCrud::getData ( 'trainerSelect' );
$constants = explode ( ',', GlobalCrud::getConstants ( "timeConstants" ) );
$supportConstants = explode ( ',', GlobalCrud::getConstants ( "supportConstants" ) );
$id = null;
if (! empty ( $_GET ['id'] )) {
	$id = $_REQUEST ['id'];
}

if (null == $id) {
	header ( "Location: index.php?content=10" );
}

if (! empty ( $_POST )) {
	$technologyid = $_POST ['technologyid'];
	$trainerid = $_POST ['trainerid'];
	$startdate = $_POST ['startdate'];
	$enddate = $_POST ['enddate'];
	$duration = $_POST ['duration'];
	$status = $_POST ['status'];
	$updatedDate = date ( "Y/m/d" );
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

	// update data
	if ($valid) {
		$sql = "batchUpdate";
		$sqlValuesForUpdate = array (
				$technologyid,
				$trainerid,
				$startdate,
				$enddate,
				$duration,
				$status,
				$updatedDate,
				$description,
				$time,
				$id
		);
		GlobalCrud::update ( $sql, $sqlValuesForUpdate );

		header ( "Location:../?content=10" );
	}
}

else {
	$sql = "batchSelectById";
	$sqlValues = array (
			$id
	);
	$data = GlobalCrud::selectById ( $sql, $sqlValues );
	$technologyid = $data ['technology_id'];
	$trainerid = $data ['trainer_id'];
	$startdate = $data ['start_date'];
	$enddate = $data ['end_date'];
	$duration = $data ['duration'];
	$status = $data ['status'];
	$updatedDate = $data ['updated_date'];
	$description = $data ['description'];
	$time = $data ['time'];
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
				<h3>Update a Batch</h3>
			</div>

			<form class="form-horizontal"
				action="./batch/update.php?id=<?php echo $id?>" method="post">


				<!--  <div class="control-group">
					<label class="control-label">ID</label>
					<div class="controls">
						<input name="id" type="text" placeholder="ID"
							value="<?php echo !empty($id)?$id:'';?>"
							required>

					</div>
				</div>  -->

				<div class="control-group">
					<label class="control-label">Technology</label>
					<div class="controls">
						<select name="technologyid" type="text">
							<option value="0">Select</option>
							<?php foreach ($selecteddataTechnology as $row): ?>
							<option <?php if($row['id'] == $technologyid) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php
}
else {
								?>
								value="
								<?=$row['id']?>
								" >
								<?php
							}
							echo $row ['name'];
							?>
							</option>

							<?php endforeach ?>
						</select>
					</div>
				</div>


				<!-- <div class="control-group">
					<label class="control-label">TrainerName</label>
					<div class="controls">
						<input name="trainerid" type="text" placeholder="Trainerid"
							value="<?php echo !empty($trainerid)?$trainerid:'';?>" required>

					</div>
				</div> -->

				<div class="control-group">
					<label class="control-label">Trainer Name</label>
					<div class="controls">
						<select name="trainerid" type="text">
							<option value="0">Select</option>
							<?php foreach ($selecteddataTrainer as $row): ?>
							<option <?php if($row['id'] == $trainerid) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php
}
else {
								?>
								value="
								<?=$row['id']?>
								" >
								<?php
							}
							echo $row ['name'];
							?>
							</option>

							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Start Date</label>
					<div class="controls">
						<input name="startdate" type="date" placeholder="start date"
							value="<?php echo !empty($startdate)?$startdate:'';?>" required>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label">End Date</label>
					<div class="controls">
						<input name="enddate" type="date" placeholder="end date"
							value="<?php echo !empty($enddate)?$enddate:'';?>" required>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Duration</label>
					<div class="controls">
						<input name="duration" type="text" placeholder="duration"
							value="<?php echo !empty($duration)?$duration:'';?>" required>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Status</label>
					<div class="controls">
						<select name="status" type="text">
							<option value="0">Select</option>

							<?php foreach ($statusConstants as $constant): ?>
							<option <?php if($constant == $status) {  ?> selected="selected"
								value="<?=$constant?>">
								<?php
}
else {
								?>
								value="
								<?=$constant?>
								" >
								<?php
                          foreach ($supportConstants as $supportConstant): ?>
							
							<option <?php if($supportConstant == $status) {  ?>
								selected="selected" value="<?=$supportConstant?>">
								<?php
							}
							else {
								?>
								value="
								<?=$supportConstant?>
								" >
								<?php
							}
							echo $supportConstant;
							?>
							</option>

							<?php endforeach ?>
						</select>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label">Time</label>
					<div class="controls">
						<select name="time" type="text">
							<option value="0">Select</option>
							<?php foreach ($constants as $constant): ?>
							<option <?php if($constant == $time) {  ?> selected="selected"
								value="<?=$constant?>">
								<?php
}
else {
								?>
								value="
								<?=$constant?>
								" >
								<?php
							}
							echo $constant;
							?>
							</option>

							<?php endforeach ?>
						</select>
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



