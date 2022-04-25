<!DOCTYPE html>
<html>

<head>
	<title>CRUDAPP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="w3.css">
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>

<body>
	<div class="container-fluid">
		<nav class="navbar navbar-dark" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Product Crud</a>
			</div>
			<form class="navbar-form navbar-right" role="search" action="search.php" method="POST">
				<div class="form-group" style="padding-top: 10px;">
					<input name="search" placeholder="Type..." style="height:33px;">
					<button class="btn btn-light" name="btnSearch">Search</button>
				</div>
			</form>
		</nav>
	</div>
	<?php require_once 'process.php' ?>
	<div class="container">
		<form action="index.php" method="POST">
			<?php
			if (isset($_SESSION['message'])) : ?>
				<div class="alert alert-<?= $_SESSION['msg_type'] ?>">
					<?php
					echo $_SESSION['message'];
					unset($_SESSION['message']);
					?>
				</div>
			<?php endif; ?>
			<input type="hidden" name="Id" value="<?php echo $ID; ?>">
			<!-- <div class="text-center">Product Crud</div> -->
			<div class="row jumbotron" style="margin-top: 30px;">
				<div class="col-lg-6 col-xs-6">
					<label>Product Name:</label>
					<input type="text" name="name" class="form-control form-control-sm" required placeholder="Enter the Product Name" value="<?php echo $pname; ?>">
				</div>
				<div class="col-lg-6 col-xs-6">
					<label>Product Manufacturer:</label>
					<input type="text" name="mfg" class="form-control form-control-sm" required placeholder="Enter the Product Manufacturer" value="<?php echo $pmfg; ?>">
				</div>
				<div class="col-lg-12 col-xs-12">
					<label>Product Description:</label>
					<input type="text" name="descp" class="form-control form-control-sm" required placeholder="Enter the Product Description" value="<?php echo $pdescp; ?>">
				</div>
				<div class="col-lg-6 col-xs-6">
					<label>Product Unitsize:</label>
					<input type="text" name="unit" class="form-control form-control-sm" required placeholder="Enter the Product Unitsize" value="<?php echo $punit; ?>">
				</div>
				<div class="col-lg-6 col-xs-6">
					<label>Product Expiry:</label>
					<input type="date" name="exp" class="form-control form-control-sm" required placeholder="Enter the Product Expiry" value="<?php echo $pnexp; ?>">
				</div>
				<div class="col-lg-12 col-xs-12" style="margin-top: 10px;margin-bottom: 20px;text-align:center;">
					<?php
					if ($update == true) :
					?>
						<button style="font-weight: bold;color:white;margin-top: 20px;text-align: center;width:200px;" type="submit" name="update" class="btn btn-info">Update</button>
					<?php else : ?>
						<button style="font-weight: bold;color:white;margin-top: 20px;text-align: center;width:200px; " type="submit" name="save" class="btn btn-primary">Save</button>
					<?php endif; ?>
				</div>

			</div>
		</form>


		<?php
		$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
		$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
		//pre_r($result);
		?>
		<div class="row justify-content-center">
			<div class="table-responsive-sm">
				<table class="table table-striped">
					<thead class="thead-primary">
						<tr>
							<th scope="col">ProductId</th>
							<th scope="col">ProductName</th>
							<th scope="col">ProductManufacturer</th>
							<th scope="col">ProductDescription</th>
							<th scope="col">ProductUnitSize</th>
							<th scope="col">ProductExpiry</th>
							<th scope="col" colspan="2">Action</th>
						</tr>
					</thead>
					<?php
					while ($row = $result->fetch_assoc()) : ?>
						<tr>
							<td><?php echo $row['Id']; ?></td>
							<td><?php echo $row['Name']; ?></td>
							<td><?php echo $row['Manufacturer']; ?></td>
							<td><?php echo $row['Description']; ?></td>
							<td><?php echo $row['Unit']; ?></td>
							<td><?php echo $row['Expiry']; ?></td>
							<td>
								<a href="index.php?edit=<?php echo $row['Id']; ?>" class="btn btn-info">Edit</a>
							</td>
							<td>
								<a href="process.php?delete=<?php echo $row['Id']; ?>" class="btn btn-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</table>
				<?php
				function pre_r($array)
				{
					echo '<pre>';
					print_r($array);
					echo '</pre>';
				}
				?>
			</div>
		</div>

	</div>
</body>

</html>