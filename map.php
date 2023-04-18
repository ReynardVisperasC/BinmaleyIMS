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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
            <li><a href="./index.php">Register Account</a></li>
			<li><a href="./logout.php">Logout</a></li>
         </div>
         
      </nav>
		<div class="container my-5">
      <form action="map.php" method="POST">   
      Name: <input type="text" placeholder="Enter Name of Indigent" name="sname" required/> 
      <input type="submit" name="search" value="find"/>   
   </form>	
      <table class="table" id="myTable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Contact Number</th>
						<th>Address</th>
						<th>Barangay</th>
						<th>View Map</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(isset($_POST['search']))
               {
                  
                   
					$dbhost = "localhost";
					$dbuser = "root";
					$dbpass = "";
					$dbname = "binmaley_db";	

					$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
					if($connection->connect_error){
						die("Connection Error: " . $connection->connect_error);
					}
               $sname = $_POST['sname'];
            
					$sql = "SELECT * FROM indigentlist where sname = '$sname' limit 1";
					$fetching = $connection->query($sql);
					if(!$fetching){
						die("Invalid Query: " . $connection->error );
					}
					while($row = $fetching->fetch_assoc()){
						echo "
						<tr id='so'></tr>
						<td>$row[sname]</td>
						<td>$row[contact_number]</td>
						<td>$row[address]</td>
						<td>$row[brgy]</td>
                  <td><button class='btnSelect''>Select</button></td>
					</tr>";

					}
            }
              
					?>


					
				</tbody>
	</table>
   
	</div>
   <script>
$(document).ready(function(){
     $("#myTable").on('click', '.btnSelect', function() {
      // get the current row
      var currentRow = $(this).closest("tr");

      
      var col3 = currentRow.find("td:eq(3)").html(); // get current row 3rd table cell  TD value
      var data = col3;
      alert(data)
      if(data === "Amancoro"){ document.getElementById("myFrame").src = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6661.871547467035!2d120.2722316888645!3d15.99683070211113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915c47030d5c3b%3A0xa41817536ee6abd7!2sAmancoro%2C%20Binmaley%2C%20Pangasinan!5e1!3m2!1sen!2sph!4v1681680422688!5m2!1sen!2sph";
}
else if(data === "Tombor"){ document.getElementById("myFrame").src ="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6662.076402753891!2d120.305550038864!3d15.990683902449275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915cee1676cb6f%3A0x4e52045d3fa9aaf9!2sTombor%2C%20Binmaley%2C%20Pangasinan!5e1!3m2!1sen!2sph!4v1681682084366!5m2!1sen!2sph";
}
      
    });

 });
</script>   
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
      <center><iframe id="myFrame" src="" width="500" height="350"></iframe>
      </center>
      
   </body>
</html>

<?php 
?>