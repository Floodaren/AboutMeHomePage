<?php 
	session_start();
	include 'head.php';
	include 'navbarManageFiles.php';
	include 'databaseconnection.php';
	include 'databaseconnectionObject.php';
	$sql = "SELECT pathway,filename, Description FROM downloadfile";
	$result = mysqli_query($conn, $sql);
	$errortext = "";
	$counter = 1;
	if (isset($_SESSION["logInId"]))
	{
		$checkId = $_SESSION["logInId"];	
	}
	$checkCookie = $_COOKIE["Admin"];
	if (isset($_POST['saveChanges']))
	{
		if ($_POST['newText'] == "") 
		{
			$errortext = "Your description is empty, try again";
		}
		else 
		{
			$dbUpdate = new dbManagement;
			$dbUpdate->updateDescription($_POST['oldText'],$_POST['newText']);
			header("Refresh:0");
		}
	}
	if (isset($_POST['deleteFile']))
	{
		$dbDelete = new dbManagement;
		$dbDelete->deleteFile($_POST['oldText']);
		header("Refresh:0");
	}
	if (isset($checkId))
	{
		if ($checkId != "Admin")
		{
			header("Location: destroySession.php");	
		}
	}
	else if ($checkCookie != "Admin")
	{
		header("Location: destroySession.php");	
	}
?>
<script type="text/javascript">
	function removeLogInMessage()
	{
  		$("#emptyDescription").hide(800);
	}
</script>
<div class="divIndex">
	<?php include 'upload.php';
	if ($errortext == "")
	{

	}
	else 
	{
		echo "<div class='alert alert-dismissible alert-danger' onclick='removeLogInMessage()' id='emptyDescription'><button type='button' class='close' data-dismiss='alert'>&times;</button>
		<strong>$errortext</strong></div>";
	}
	?>
	<legend>My files</legend>
	<table class="table table-striped table-hover">
		<thead class="tableManagefiles">
			<tr>
				<th>#</th>
				<th>File</th>
				<th>Description</th>
				<th>Edit</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody class="tableManagefiles">
			<?php
				if (mysqli_num_rows($result) > 0)
				{
					while ($row = mysqli_fetch_assoc($result))
					{
						if ($counter % 2 == 0)
						{
							echo "<tr class='info'>";
						}
						else 
						{
							echo "<tr>";
						}
						echo "<td class='showfile'>$counter</td>"; 
						echo "<td class='showfile'><a href=".$row['pathway']." download>".$row['filename']."</a></td>";
						echo "<td class='showfile'>".$row['Description']."</td>";
						//$test = $row['Description'];
						echo "<td>
								<div>
								<a href='#' data-toggle='modal' data-target='#login$counter'>Edit</a>        
	    						<form id='logingform' method='post'>
	    						<div class='modal fade' id='login$counter' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	      						<div class='modal-dialog'>
	        					<div class='modal-content'>
	          					<div class='modal-header'>
	            				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
	            				<h4 class='modal-title' id='myModalLabel'>Edit file description</h4>
	          					</div>
	          					<div class='modal-body'>
	            				<div class='form-group has-feedback'>
	            				<label class='control-label'>Old description</label>
	            				<input type='text' class='form-control' id='inputSuccess2' name='oldText' aria-describedby='inputSuccess2Status'
	            				value='".$row['Description']."' readonly>
	              				<label class='control-label'>New description</label>
	              				<input type='text' class='form-control' id='inputSuccess2' name='newText' aria-describedby='inputSuccess2Status' placeholder='New text'>
	              				<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>
	            				</div>
	            				<input type='submit' name='saveChanges' class='btn btn-primary' value='Save Changes'>             
	          					</div>
	        					</div>
	      						</div>
	    						</div>
	    						</form>  
								</div>
								</td>";
						echo "<td>
								<div>
								<a href='#' data-toggle='modal' data-target='#remove$counter'>Remove</a>        
	    						<form id='logingform' method='post'>
	    						<div class='modal fade' id='remove$counter' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	      						<div class='modal-dialog'>
	        					<div class='modal-content'>
	          					<div class='modal-header'>
	            				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
	            				<h4 class='modal-title' id='myModalLabel2'>Remove file</h4>
	          					</div>
	          					<div class='modal-body'>
	            				<div class='form-group has-feedback'>
	            				<label class='control-label'>Are you sure you want to delete the file</label>
	            				<input type='text' class='form-control' id='inputSuccess2' name='oldText' aria-describedby='inputSuccess2Status'
	            				value='".$row['Description']."' readonly>
	              				<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>
	            				</div>
	            				<input type='submit' name='deleteFile' class='btn btn-primary' value='Delete'>             
	          					</div>
	        					</div>
	      						</div>
	    						</div>
	    						</form>  
								</div>
								</td>";
						echo "</tr>";
						$counter += 1;
					}
				}
			?>
		</tbody>
	</table>
</div>
