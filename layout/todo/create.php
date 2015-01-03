<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);
$data = GlobalCrud::getData('employeeSelect');
$constants = explode(',', GlobalCrud::getConstants("todoConstants"));
if ( !empty($_POST)) {

	// keep track post values

	$category = $_POST['category'];
	$status = $_POST['status'];
	$assignedto=$_POST['assignedto'];
	$createdDate=date("Y/m/d");
	$description=$_POST['description'];


	// validate input
	$valid = true;
	if (empty($category)) {
		$valid = false;
	}
	if (empty($status)) {
		$valid = false;
	}
	if (empty($assignedto)) {
		$valid = false;
	}


	// insert data
	if ($valid) {
		$sql = "todoInsert";
		$sqlValues = array($category,$status,$assignedto,$createdDate,$description);
		GlobalCrud::setData($sql,$sqlValues);
		header("Location:../?content=19");
	}
	else{

		header("Location:../?content=20");
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
				<h3>Create a Tasks</h3>
			</div>

			<form class="form-horizontal" action="./todo/create.php"
				method="post">
				<div class="control-group">
					<label class="control-label">Category</label>
					<div class="controls">
						<input name="category" type="text" placeholder="category"
							value="<?php echo !empty($category)?$category:'';?>" required>

					</div>
				</div>

				<div class="control-group ">
					<label class="control-label">Status</label>

					<div class="controls">


						<select name="status" type="text">
							<option value="">Select</option>
							<?php foreach ($constants as $constant): ?>
							<option value="<?=$constant?>">
								<?php	echo $constant;?>
								<?php endforeach ?>
							</option>
						</select>
					</div>
				</div>



				<div class="control-group">
					<div class="form-group required">
						<label class="control-label">Employee Name</label>
						<div class="controls">
							<select name="assignedto" type="text">
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
					<label class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" type="text" placeholder="description"
							value="<?php echo !empty($description)?$description:'';?>"></textarea>

					</div>
				</div>



				<div>
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Create</button>
						<a class="btn" href="index.php">Back</a>
					</div>
				</div>
			</form>

		</div>

	</div>
	<!-- /container -->
</body>
</html>
