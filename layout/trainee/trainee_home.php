<!DOCTYPE html>
<html lang="en">
<body>

	<div class="container-fluid">
		<div class="row">
			<h3>Trainee</h3>
		</div>
		<div class="row">
			<p>
				<a href="?content=38" class="btn btn-default"><i
					class="fa fa-plus-square"></i>&nbsp;Add</a>
					<a href="./Excels/traineeexcel.php" class="btn btn-default btn-lg " role="button" ><i class="fa fa-file-excel-o"></i></a>
			</p>


			<!--  <div class="input-group"> <span class="input-group-addon">Search</span>

               <input id="example" type="text" class="form-control" placeholder="Type here..."> -->

			Search:<input id="filter" type="text" />
			<table data-filter="#filter" class="footable">

				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Alternate Phone</th>
						<th>Technology</th>
						<th>Batch</th>
						<th>Client</th>
						<th>Skype Id</th>
						<th>Timezone</th>
						<!-- <th>Description</th> -->
						<th data-sort-ignore="true">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .= "/layout/connection/GlobalCrud.php";
					include_once($path);
					$data = GlobalCrud::getData('traineeSelect');
					foreach ($data as $row) {
						echo '<tr>';
						//echo '<td>'. $row['name'] . '</td>';
						echo '<td>'. '<a href="./trainee/read.php">'. $row['name'] .'</a>' . '</td>';
						echo '<td>'. $row['email'] . '</td>';
						echo '<td>'. $row['phone'] . '</td>';
						echo '<td>'. $row['alternate_phone'] . '</td>';
						echo '<td>'. $row['technology_name'] . '</td>';
						echo '<td>'. $row['batch_id'] . '</td>';
						echo '<td>'. $row['client_name'] . '</td>';
						echo '<td>'. $row['skype_id'] . '</td>';
						echo '<td>'. $row['timezone'] . '</td>';
						//echo '<td>'. $row['description'] . '</td>';
						echo '<td>';
						echo '<a href="#" data-toggle="tooltip" title="'. $row['description'] . '"><i class="fa fa-info-circle"></i></a>';
						echo '<a href="?content=39&id='.$row['id'].'"><i class="icon-edit"></i></a>';
						echo '<a href="?content=37&id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete?\')" ><i class="icon-trash"></i></a>';//'?content=16&id='.$row['id'].'
						echo '</td>';
						echo '</tr>';
					}

					function deleteRecord($idValue) {
									$sql = "traineeDelete";
									$sqlValues = $idValue;
									GlobalCrud::delete($sql,$sqlValues);
									header("Location:./?content=37");
								}

						  if (isset($_GET['id'])) {
						    deleteRecord($_GET['id']);
						  }
						  ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /container -->
</body>
</html>
