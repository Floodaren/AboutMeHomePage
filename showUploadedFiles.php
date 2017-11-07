<link rel="stylesheet" type="text/css" href="Index.css">
<?php
	include 'databaseconnection.php';
	$sql = "SELECT pathway,filename, Description FROM downloadfile";
	$result = mysqli_query($conn, $sql);
	$counter = 1;
?>
<h4 class="divH4">My files</h4>
<hr class="divHr">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>File</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
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
					echo "</tr>";
					$counter += 1;
				}
			} 
		?>
	</tbody>
</table>







