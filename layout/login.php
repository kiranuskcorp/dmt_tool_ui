<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once ($path);

if (! empty ( $_POST )) {
	$username = $_POST ["username"];
	$password = $_POST ["password"];
	
	$valid = true;
	
	if (empty ( $username )) {
		$valid = false;
	}
	
	if (empty ( $password )) {
		$valid = false;
	}
	
	if ($valid) {
		$sql = "usercredsselect";
		$sqlValues = array (
				$username,
				$password 
		);
		$data = GlobalCrud::selectById ( $sql, $sqlValues );
		
		if ($data ['username'] == $username) {
			header ( "Location:./index.php" );
		} else {
			header ( "Location:./login.php" );
		}
	}
}
?>
<html>
<body>
	<div class="container">

		<form class="form-horizontal" action="./login.php" method="post">
			<div class="control-group">
				<div class="form-group required">
					<label class="control-label">User Name</label>
					<div class="controls">
						<input name="username" type="text" placeholder="username"
							value="<?php echo !empty($username)?$username:'';?>" required>
					</div>
				</div>
			</div>


			<div class="control-group">
				<div class="form-group required">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="password"
							value="<?php echo !empty($password)?$password:'';?>" required>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>

</body>
</html>
