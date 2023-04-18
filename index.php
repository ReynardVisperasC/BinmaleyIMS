<?php
session_start();
include("connections.php");
include("functions.php");

$user_data = check_login($conn); 

?>	




<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Binmaley Indigent Monitoring System</title>
      <link rel="stylesheet" href="navstyle.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"/>
   </head>
   <body>
      <nav>
         <div class="menu-icon">
            <span class="fas fa-bars"></span>
         </div>
         <div class="logo">
		 <h1>BIMS</h1>
         </div>
         <div class="nav-items">
           
			<li><a href="./map.php">Search Indigent</a></li>
            <li><a href="#">Register Account</a></li>
			<li><a href="./logout.php">Logout</a></li>
         </div>
         
      </nav>
    
	  <div class="container my-5">
         <h2>List of Users</h2>
		 <a class="btn btn-primary" href="createUser.php"  role="Button">New User</a>
		 <br>
		 <table class="table">
			<thead>
				<tr>
					<th>UserName</th>
					<th>Barangay/Municipality</th>
					<th>User Role</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$dbhost = "localhost";
				$dbuser = "root";
				$dbpass = "";
				$dbname = "binmaley_db";	

				$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
				if($connection->connect_error){
					die("Connection Error: " . $connection->connect_error);
				}

				$sql = "SELECT * FROM user_login";
				$fetching = $connection->query($sql);
				if(!$fetching){
					die("Invalid Query: " . $connection->error );
				}
				while($row = $fetching->fetch_assoc()){
					echo "
					<tr>
					<td>$row[user_name]</td>
					<td>$row[barangay]</td>
					<td>$row[user_status]</td>
				</tr>";
				}


				?>
				
			</tbody>
</table>
   </div>
      <script>
         const menuBtn = document.querySelector(".menu-icon span");
         const searchBtn = document.querySelector(".search-icon");
         const cancelBtn = document.querySelector(".cancel-icon");
         const items = document.querySelector(".nav-items");
         const form = document.querySelector("form");
         menuBtn.onclick = ()=>{
           items.classList.add("active");
           menuBtn.classList.add("hide");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
        
      </script>
	
   </body>
</html>

<?php 
?>