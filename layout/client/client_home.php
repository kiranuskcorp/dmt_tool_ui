<!DOCTYPE html>
<html lang="en">

<body>
	<div class="container-fluid">
		<div class="row">
			<h3>Client</h3>
		</div>
		<div class="row">
			<p>
				<a href="?content=8" class="btn btn-default"><i
					class="fa fa-plus-square"></i>&nbsp;Add</a><a href="./Excels/clientexcel.php" class="btn btn-default btn-lg " role="button" ><i class="fa fa-file-excel-o"></i></a>
			</p>
			Search:<input id="filter" type="text" />
			<table data-filter="#filter" class="footable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Address</th>
						<!-- <th>Created Date</th>
		                  <th>Updated Date</th>
		                    <th>Description</th>-->
						<th data-sort-ignore="true">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .= "/layout/connection/GlobalCrud.php";
					include_once($path);
					$data = GlobalCrud::getData('clientSelect');
					
					foreach ($data as $row) {
						echo '<tr>';
						echo '<td>'. $row['name'] . '</td>';
						echo '<td> <i class="fa fa-location-arrow"></i> '. $row['address'] . '</td>';
						//echo '<td>'. $row['created_date'] . '</td>';
						//echo '<td>'. $row['updated_date'] . '</td>';
						//echo '<td>'. $row['description'] . '</td>';
						echo '<td>';
						echo '<a href="#" data-toggle="tooltip" title="'. $row['description'] . '"><i class="fa fa-info-circle"></i></a>';
						echo '<a href="?content=9&id='.$row['id'].'"><i class="icon-edit"></i></a>';
						echo '<a href="?content=7&id='.$row['id'].'"  onclick="return confirm(\'Are you sure you want to delete?\')" ><i class="icon-trash"></i></a>';//'?content=16&id='.$row['id'].'
						echo '</td>';
						echo '</tr>';
					}

					function deleteRecord($idValue) {
									$sql = "clientDelete";
									$sqlValues = $idValue;
									GlobalCrud::delete($sql,$sqlValues);
									header("Location:./?content=7");
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
