<?php
session_start();
include("connections.php");
include("functions.php");

$user_data = check_login($conn)
?>



<!DOCTYPE html>
<html>
<head>
	<title>BINMALEY INDIGENT MONITORING SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<h1>Welcome <?php echo $user_data['user_firstname'];?></h1>
    <a href="./logout.php">logout </a>
</body>
</html>