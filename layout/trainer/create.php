<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);
$technologyData = GlobalCrud::getData('technologySelect');
if ( !empty($_POST)) {

	// keep track post values
	$name = $_POST['name'];
	$technologyid = $_POST['technologyid'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$createdDate = date("Y/m/d");
	//$updatedDate = $_POST['updatedDate'];
	$description = $_POST['description'];

	// validate input
	$valid = true;
	if (empty($name)) {
		$valid = false;
	}

	if (empty($technologyid)) {
		$valid = false;
	}

	if (empty($phone)) {
		$valid = false;
	}

	if (empty($email)) {
		$valid = false;
	}





	// insert data
	if ($valid) {
		$sql = "trainerInsert";
		$sqlValues = array($name,$technologyid,$phone,$email,$createdDate,$description);
		GlobalCrud::setData($sql,$sqlValues);
		header("Location:../?content=4");
	}
	else{

		header("Location:../?content=5");
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
				<h3>Create A Trainer</h3>
			</div>

			<form class="form-horizontal" action="./trainer/create.php"
				method="post">
				<div class="form-group required">
					<div class="control-group">
						<label class="control-label">Trainer Name</label>
						<div class="controls">
							<input name="name" type="text" placeholder="name"
								value="<?php echo !empty($name)?$name:'';?>" required>

						</div>
					</div>
				</div>


				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Technology Name</label>
						<div class="controls">
							<select name="technologyid" type="text">
								<option value="0">Select</option>
								<?php foreach ($technologyData as $row): ?>
								<option value="<?=$row['id']?>">
									<?php	echo $row ['name'];?>
									<?php endforeach ?>
								</option>
							</select>
						</div>
					</div>
				</div>


				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Phone</label>
						<div class="controls">
							<input name="phone" type="tel" placeholder="phone" maxlength="10"
								value="<?php echo !empty($phone)?$phone:'';?>" required>
						</div>
					</div>
				</div>


				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Email</label>
						<div class="controls">
							<input name="email" type="email" placeholder="email"
								value="<?php echo !empty($email)?$email:'';?>" required>

						</div>
					</div>
				</div>


				<!--  <div class="control-group">
					    <label class="control-label">Created Date</label>
					    <div class="controls">
					      	<input name="createdDate" type="date"  placeholder="Created Date" value="<?php echo !empty($createdDate)?$createdDate:'';?>" required>
					    
					    </div>
					  </div>


					  <div class="control-group">
					    <label class="control-label">Updated Date</label>
					    <div class="controls">
					      	<input name="updatedDate" type="date"  placeholder="Updated Date" value="<?php echo !empty($updatedDate)?$updatedDate:'';?>" required>
					      
					    </div>
					  </div> -->

				<div class="control-group">
					<label class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" type="text" placeholder="Description"
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
