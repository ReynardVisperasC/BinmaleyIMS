<?php
session_start();

include("connections.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$user_name = $_POST['user_name'];
	$pass = $_POST['pass'];

	if(!empty($user_name) && !empty($pass) && !is_numeric($user_name)){
	
        $query = "select * from user_login where user_name = '$user_name' LIMIT 1";
		$result = mysqli_query($conn,$query);

		if($result){
			if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
				if($user_data['user_pass'] === $pass){
						if($user_data['user_status'] === "Admin"){
							$_SESSION['id'] = $user_data['id'];
						header("Location: index.php");
						die;
						}
						
						elseif ($user_data['user_status'] === "Barangay") {
							$_SESSION['id'] = $user_data['id'];
						header("Location: brgy.php");
						die;
						}
						
				}
				
				
				


			}
			

		}
		
		
		
 	}
	
	
	
}
	


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
	<img class="wave" src="./wave.png">
	<div class="container">
		<div class="img">
			<img src="./338700882_758428162607363_1553111908979944042_n-removebg-preview.png">
		</div>
		<div class="login-content">
			<form method="post">
				<h2 class="title">BINMALEY INDIGENT MONITORING SYSTEM</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		
           		   		<input type="text" placeholder="Username" class="input" name = "user_name">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input type="password" placeholder="Password" class="input" name= "pass">
            	   </div>
            	</div>
            
            	<input type="submit" class="btn" value="Login">
            </form>
			
        </div>
    </div>
</body>
</html>