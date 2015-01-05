<!DOCTYPE html>
<html lang="en">


<body>
    <div class="container-fluid">
		<div class="row">
    			<h3>Support</h3>
    		</div>
			<div class="row">
				<p>
					<a href="?content=41" class = "btn btn-default"><i class="fa fa-plus-square"></i>&nbsp;Add</a>
					<a href="./Excels/supportexcel.php" class="btn btn-default btn-lg " role="button" ><i class="fa fa-file-excel-o"></i></a>
				</p>
				Search:<input id="filter" type="text" /> 
			<table data-filter="#filter" class="footable">
		              <thead>
		                <tr>
		                  <th>Trainee Name</th>
		                  <th>Employee Name </th>
		                  <th>Start Date</th>
		                  <th>End Date</th>
		                  <th>Allotted Time</th>
		                  <th>End Client</th>
		                  <th>Technology Used</th>
		                  <th>Status</th>
		                 <!--   <th>Description</th>
 -->		                   <th data-sort-ignore="true">Action</th>
		                    
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
		               $path = $_SERVER['DOCUMENT_ROOT'];
   					   $path .= "/layout/connection/GlobalCrud.php";
   					   include_once($path);
					   $data = GlobalCrud::getData('supportSelect');
					   foreach ($data as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['trainee_name'] . '</td>';
							   	echo '<td>'. $row['employee_name'] . '</td>';
							   	echo '<td>'. $row['start_date'] . '</td>';
							   	echo '<td>'. $row['end_date'] . '</td>';
							   	echo '<td>'. $row['allotted_time'] . '</td>';
							   	echo '<td>'. $row['end_client'] . '</td>';
							   	echo '<td>'. $row['technology_used'] . '</td>';
							   	echo '<td>'. $row['status'] . '</td>';
							   //	echo '<td>'. $row['description'] . '</td>';
							   	echo '<td>';
							   	echo '<a href="#" data-toggle="tooltip" title="'. $row['description'] . '"><i class="fa fa-info-circle"></i></a>';
							   	echo '<a href="?content=42&id='.$row['id'].'"><i class="icon-edit"></i></a>';
							   	echo '<a href="?content=40&id='.$row['id'].'"  onclick="return confirm(\'Are you sure you want to delete?\')" ><i class="icon-trash"></i></a>';//'?content=16&id='.$row['id'].'
							   	echo '</td>';
							   	echo '</tr>';
					   }

					   function deleteRecord($idValue) {
									$sql = "supportDelete";
									$sqlValues = $idValue;
									GlobalCrud::delete($sql,$sqlValues);
									header("Location:./?content=40");
								}

						  if (isset($_GET['id'])) {
						    deleteRecord($_GET['id']);
						  }
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>