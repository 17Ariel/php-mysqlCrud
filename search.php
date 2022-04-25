<!DOCTYPE html>
<html>
<head>
	<title>send</title>
	<meta name="viewport"content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="w3.css">
	<script type="text/javascript"src="bootstrap.min.js"></script>
</head>
<body>
	<div class="row justify-content-center">
		<div class="table-respnsive-sm">
			<table class="table table-striped">
		    <thead class="thead-primary">
		        <tr>
		       	<th scope="col">ProductId</th>
				<th scope="col">ProductName</th>
				<th scope="col">ProductManufacturer</th>
				<th scope="col">ProductDescription</th>
				<th scope="col">ProductUnitSize</th>
				<th scope="col">ProductExpiry</th>
				<th scope="col"colspan="2">Action</th>
		        </tr>
		    </thead>
		    <tbody>
		<?php
		$conn= new mysqli("localhost","root","", "crud") or die($conn->error);
		if(isset($_POST['btnSearch']))
		{
		    $search=$conn->real_escape_string($_POST['search']);
		    //echo $search;

		    $sql="Select * from data where Id like '%$search%' or Name like '%$search%' or Description like '%$search%'";

		    $queryRes=$conn->query($sql) or die($conn->error);
		    if($queryRes->num_rows>0){
		       
		            while($row=$queryRes->fetch_assoc()): ?>
		                <tr>
		                <td scope="row"><?php echo $row['Id'];?></th>
		                <td><?php echo $row['Name'] ;  ?></td>
		                <td><?php echo $row['Manufacturer'] ;  ?></td>
		                <td><?php echo $row['Description'] ; ?></td>
		                <td><?php echo $row['Unit'] ; ?></td>
		                <td><?php echo $row['Expiry'] ; ?></td>
		                <td>
							<a href="index.php?edit=<?php echo $row['Id'];?>"class="btn btn-info">Edit</a>
						</td>
						<td>
							<a href="process.php?delete=<?php echo $row['Id'];?>"class="btn btn-danger">Delete</a>
						</td>
		                </tr>
		            <?php endwhile;
		            echo "</table>";}
		            else
		            {
		            echo "<p>No record found</p>";}
		        }
		?>
		</div>
	</div>
			
</body>
</html>