<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);
$technologyData = GlobalCrud::getData('technologySelect');
$id = null;
if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ( null==$id ) {
	header("Location: index.php?content=4");
}

if ( !empty($_POST)) {
	$name = $_POST['name'];
	$technologyid = $_POST['supportedby'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	//$createdDate = $_POST['createdDate'];
	$updatedDate = date("Y/m/d");
	$description = $_POST['description'];

	// validate input
	$valid = true;
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




	// update data
	if ($valid) {
		$sql = "trainerUpdate";
		$sqlValuesForUpdate = array($name,$technologyid,$phone,$email,$updatedDate,$description,$id);
		GlobalCrud::update($sql,$sqlValuesForUpdate);

		header("Location:../?content=4");
	}
}

else {
	$sql = "trainerSelectById";
	$sqlValues = array($id);
	$data = GlobalCrud::selectById($sql,$sqlValues);
	$name = $data['name'];
	$technologyid = $data['technology_id'];
	$phone = $data['phone'];
	$email = $data['email'];
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
				<h3>Update a Trainer</h3>
			</div>

			<form class="form-horizontal"
				action="./trainer/update.php?id=<?php echo $id?>" method="post">
				<div class="control-group">
					<label class="control-label"> Trainer Name</label>
					<div class="controls">
						<input name="name" type="text" placeholder="Name"
							value="<?php echo !empty($name)?$name:'';?>" required>

					</div>
				</div>



				<div class="control-group">
					<label class="control-label">Technology Name</label>
					<div class="controls">
						<select name="supportedby" type="text">
							<option value="0">Select a technology</option>
							<?php foreach ($technologyData as $row): ?>
							<option <?php if($row['id'] == $technologyid) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php }else {?>
								value="
								<?=$row['id']?>
								">
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
					<label class="control-label">Phone</label>
					<div class="controls">
						<input name="phone" type="tel" placeholder="Phone" maxlength="10"
							value="<?php echo !empty($phone)?$phone:'';?>" required>

					</div>
				</div>


				<div class="control-group">
					<label class="control-label">Email</label>
					<div class="controls">
						<input name="email" type="email" placeholder="Email"
							value="<?php echo !empty($email)?$email:'';?>" required>

					</div>
				</div>


				<!--  <div class="control-group">
					    <label class="control-label">Created Date</label>
					    <div class="controls">
					      	<input name="createdDate" type="date" placeholder="Created Date" value="<?php echo !empty($createdDate)?$createdDate:'';?>" required>
					      	
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Updated Date</label>
					    <div class="controls">
					      	<input name="updatedDate" type="date"  placeholder="Updated Date" value="<?php echo !empty($updatedDate)?$updatedDate:'';?>" required>
					      
					    </div>
					  </div>  -->

				<div class="control-group">
					<label class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" type="text">
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
