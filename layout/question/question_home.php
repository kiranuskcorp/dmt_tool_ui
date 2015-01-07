<!DOCTYPE html>
<html lang="en">


<body>
    <div class="container-fluid">
		<div class="row">
    			<h3>Question</h3>
    		</div>
			<div class="row">
				<p>
					<a href="?content=35" class = "btn btn-default"><i class="fa fa-plus-square"></i>&nbsp;Add</a>
					<a href="./Excels/questionexcel.php" class="btn btn-default btn-lg " role="button" ><i class="fa fa-file-excel-o"></i> export</a>
				</p>
				Search:<input id="filter" type="text" /> 
			<table data-filter="#filter" class="footable">
			        <thead>
		                <tr>
		                  <th>End Client</th>
		                  <th>Question</th>
		                  <th>Answers</th>
		                <!--   <th>Description</th> -->
		                  <th data-sort-ignore="true">Actions</th>
		                  </tr>
		              </thead>
		              <tbody>
		              <?php 
		               $path = $_SERVER['DOCUMENT_ROOT'];
   					   $path .= "/layout/connection/GlobalCrud.php";
   					   include_once($path);
					   $data = GlobalCrud::getData('questionSelect');
					   foreach ($data as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['interview_name'] . '</td>';
							   	echo '<td>'. $row['question'] . '</td>';
							   	echo '<td>'. $row['answers'] . '</td>';
							   	//echo '<td>'. $row['description'] . '</td>';
							   	echo '<td>';
							   	echo '<a href="#" data-toggle="tooltip" title="'. $row['description'] . '"><i class="fa fa-info-circle"></i></a>';
							   	echo '<a href="?content=36&id='.$row['id'].'"><i class="icon-edit"></i></a>';
							   	echo '<a href="?content=34&id='.$row['id'].'"  onclick="return confirm(\'Are you sure you want to delete?\')" ><i class="icon-trash"></i></a>';//'?content=16&id='.$row['id'].'
							   	echo '</td>';
							   	echo '</tr>';
					   }

					   function deleteRecord($idValue) {
									$sql = "questionDelete";
									$sqlValues = $idValue;
									GlobalCrud::delete($sql,$sqlValues);
									header("Location:./?content=34");
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