<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);

$id = null;
if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ( null==$id ) {
	header("Location: index.php?content=7");
}

if ( !empty($_POST)) {

	$name = $_POST['name'];
	$address = $_POST['address'];
	//$createdDate = $_POST['createdDate'];
	$updatedDate = date("Y/m/d");
	$description = $_POST['description'];

	// validate input
	$valid = true;
	if (empty($name)) {
		$valid = false;
	}

	if (empty($address)) {
		$valid = false;
	}


	// update data
	if ($valid) {
		$sql = "clientUpdate";
		$sqlValuesForUpdate = array($name,$address,$updatedDate,$description,$id);
		GlobalCrud::update($sql,$sqlValuesForUpdate);

		header("Location:../?content=7");
	}
}

else {
	$sql = "clientSelectById";
	$sqlValues = array($id);
	$data = GlobalCrud::selectById($sql,$sqlValues);
	$name = $data['name'];
	$address = $data['address'];
	//$createdDate = $data['created_date'];
	//  $updatedDate = $data['updated_date'];
	$description = $data['description'];
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
				<h3>Update a Client</h3>
			</div>

			<form class="form-horizontal"
				action="./client/update.php?id=<?php echo $id?>" method="post">
				<div
					class="control-group <?php echo !empty($nameError)?'error':'';?>">
					<label class="control-label">Name</label>
					<div class="controls">
						 <input name="name" type="text" placeholder="name"
							value="<?php echo !empty($name)?$name:'';?>" required>

					</div>
				</div>



				<div class="control-group ">
					<label class="control-label">Address</label>
					<div class="controls">
						 <input name="address" type="text" placeholder="address"
							value="<?php echo !empty($address)?$address:'';?>" required>

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
						<textarea name="description" type="text" placeholder="Description">
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
