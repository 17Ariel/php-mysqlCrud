<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$ID = 0;
$update = false;
$pname = "";
$pmfg = "";
$pdescp = "";
$punit = "";
$pnexp = "";


if (isset($_POST['save'])) {
	$pname = $_POST['name'];
	$pmfg = $_POST['mfg'];
	$pdescp = $_POST['descp'];
	$punit = $_POST['unit'];
	$pnexp = $_POST['exp'];
	$mysqli->query("INSERT INTO data(Name,Manufacturer,Description,Unit,Expiry)VALUES('$pname','$pmfg','$pdescp','$punit','$pnexp')") or die($mysqli->error);

	$_SESSION['message'] = "Record is Save Successfully";
	$_SESSION['msg_type'] = "success";

	header("location:index.php");
	exit();
}



if (isset($_GET['delete'])) {
	$ID = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE Id=$ID") or die($mysqli->error());

	$_SESSION['message'] = "Record is Deleted";
	$_SESSION['msg_type'] = "danger";

	header("location:index.php");
	exit();
}
if (isset($_GET['edit'])) {
	$ID = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE Id=$ID") or die($mysqli->error());
	if ($result->num_rows > 0) {
		$row = $result->fetch_array();
		$pname = $row['Name'];
		$pmfg = $row['Manufacturer'];
		$pdescp = $row['Description'];
		$punit = $row['Unit'];
		$pnexp = $row['Expiry'];
	}
}

if (isset($_POST['update'])) {
	$ID = $_POST['Id'];
	$pname = $_POST['name'];
	$pmfg = $_POST['mfg'];
	$pdescp = $_POST['descp'];
	$punit = $_POST['unit'];
	$pnexp = $_POST['exp'];

	$mysqli->query("UPDATE data SET Name='$pname',Manufacturer='$pmfg',Description='$pdescp',Unit='$punit',Expiry='$pnexp' where Id=$ID") or die($mysqli->error);

	$_SESSION['message'] = "Record has been Updated";
	$_SESSION['msg_type'] = "warning";

	header("location:index.php");
	exit();
}
