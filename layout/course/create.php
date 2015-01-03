<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);

$data = GlobalCrud::getData('technologySelect');
if ( !empty($_POST)) {

	// keep track post values
	$technologyid = $_POST['technologyid'];
	$name = $_POST['name'];
	$esthrs = $_POST['esthrs'];
	$createdDate = date("Y/m/d");
	$description = $_POST['description'];

	// validate input
	$valid = true;
	if (empty($technologyid)) {
		$valid = false;
	}
	if (empty($name)) {
		$valid = false;
	}
	if (empty($esthrs)) {
		$valid = false;
	}




	// insert data
	if ($valid) {
		$sql = "courseInsert";
		$sqlValues = array($technologyid,$name,$esthrs,$createdDate,$description);
		GlobalCrud::setData($sql,$sqlValues);
		header("Location:../?content=25");
	}
	else{

		header("Location:../?content=26");
	}

}

/*if ( !empty($_GET)) {
 echo "<script type='text/javascript'>alert('get');</script>";
}*/
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
				<h3>Create A Course</h3>
			</div>

			<form class="form-horizontal" action="./course/create.php"
				method="post">
				<!--<div class="control-group">
					    <label class="control-label">Technology</label>
					    <div class="controls">
					      	<input name="technologyid" type="text"  placeholder="Technology" value="<?php echo !empty($technologyid)?$technologyid:'';?>" required>
					      	
					    </div>
					  </div>-->

				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Technology</label>
						<div class="controls">
							<select name="technologyid" type="text" required>
								<option value="0">Select</option>
								<?php foreach ($data as $row): ?>
								<option value="<?=$row['id']?>">
									<?php	echo $row ['name'];?>
									<?php endforeach ?>
								</option>

							</select>
						</div>
					</div>
				</div>
				<div class="control-group ">
					<label class="control-label">Name</label>
					<div class="controls">
						<input name="name" type="text" placeholder="name"
							value="<?php echo !empty($name)?$name:'';?>" required>

					</div>
				</div>


				<div class="control-group ">
					<label class="control-label">Estimated Hours </label>
					<div class="controls">
						<input name="esthrs" type="text" placeholder="estimated hours"
							value="<?php echo !empty($esthrs)?$esthrs:'';?>" required>

					</div>
				</div>

				<!-- <div class="control-group ">
					    <label class="control-label">Created Date</label>
					    <div class="controls">
					      	<input name="createdDate" type="date" placeholder="Created Date" value="<?php echo !empty($createdDate)?$createdDate:'';?>" required>
					      	
					    </div>
					  </div>
					  <div class="control-group ">
					    <label class="control-label">Updated Date</label>
					    <div class="controls">
					      	<input name="updatedDate" type="date"  placeholder="Updated Date" value="<?php echo !empty($updatedDate)?$updatedDate:'';?>" required>
					      
					    </div>
					  </div> -->

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
