<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);

if ( !empty($_POST)) {

	// keep track post values
	$name = $_POST['name'];
	$address = $_POST['address'];
	$createdDate = date("Y/m/d");
	//$updatedDate = $_POST['updatedDate'];
	$description = $_POST['description'];

	// validate input
	$valid = true;
	if (empty($name)) {
		$valid = false;
	}

	if (empty($address)) {
		$valid = false;
	}



		
	// insert data
	if ($valid) {
		$sql = "clientInsert";
		$sqlValues = array($name,$address,$createdDate,$description);
		GlobalCrud::setData($sql,$sqlValues);
		header("Location:../?content=7");
	}
	else{

		header("Location:../?content=8");
	}

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

</head>

<body>
	<div class="container">

		<div class="span10 offset1">
			<div class="row">
				<h3>Create a Client</h3>
			</div>

			<form class="form-horizontal" action="./client/create.php"
				method="post">
				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Name</label>
						<div class="controls">
							<input name="name" type="text" placeholder="name"
								value="<?php echo !empty($name)?$name:'';?>" required>
						</div>
					</div>
				</div>


				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Address</label>
						<div class="controls">
							<input name="address" type="text" placeholder="address"
								value="<?php echo !empty($address)?$address:'';?>" required>
						</div>
					</div>
				</div>





				<!--  <div class="control-group">
					    <label class="control-label">Created Date</label>
					    <div class="controls">*
					      	<input name="createdDate" type="date" placeholder="Created Date" value="<?php echo !empty($createdDate)?$createdDate:'';?>" required>
					      	
					    </div>
					  </div>
					<div class="control-group">
					    <label class="control-label">Updated Date</label>
					    <div class="controls">*
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
