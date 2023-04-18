<?php
session_start();
include("connections.php");
include("functions.php");


$user_data = check_login($conn); 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "binmaley_db";	

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

$sname = "";
$address = "";
$contact_number ="";
$SuccessMessage = "";
$ErrorMessage="";

if($_SERVER['REQUEST_METHOD']=='POST'){
   $sname = $_POST['sname'];
   $address = $_POST['address'];
   $contact_number = $_POST['contact_number'];
   do{
      if(empty($sname) || empty($address) ){
         $ErrorMessage = "All Fields are Required";
         break;
      }
 $sql= "INSERT INTO `indigentlist`(`id`, `sname`, `address`, `brgy`, `contact_number`) VALUES ('','$sname','$address','$user_data[barangay]','$contact_number')";   
 $adding = $connection->query($sql);
 if(!$adding){
   $ErrorMessage = "Invalid Query: " . $connection->error;
   break;
}
   
$SuccessMessage = "User Added Successfully";

header("location: ./brgy.php");
exit;
   }while(false);

   }



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
      <script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
   </head>
   <body>
      <div class = "container my-5">
         <h2>Register New User</h2>
         <h2>Brgy: <?php echo $user_data['barangay']?></h2>

         <?php
         if(!empty($ErrorMessage)){
            echo"
            <div class= 'alert alert-warning alert-dismissible fade show' role='alert'>
            <strong >$ErrorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>


            ";
         }
         ?>
      
         <form method="post">
            <div class="row mb-3">
               <label class = "col sm-3 col-form-label">Fullname:</label>
               <div>
                  <input type="text" class="form-control" name="sname" value="<?php echo $sname; ?>"/>
               </div>
            </div>
          
            <div class="row mb-3">
               <label class = "col sm-3 col-form-label">Address:</label>
               <div>
                  <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" onchange="getCoordinates()"/>
               </div>
            </div>
            
            <div class="row mb-3">
               <label class = "col sm-3 col-form-label">Contact Number:</label>
               <div>
               <input type="number" class="form-control" name="contact_number" value="<?php echo $contact_number; ?>"/>
               </div>
            </div>
            
          
<?php
         if(!empty($SuccessMessage)){
            echo"
            <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-6>
            <div class= 'alert alert-sucess alert-dismissible fade show' role='alert'>
            <strong >$SuccessMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
</div>
</div>

            ";
         }
?>
<div class="row mb-3">
<div class="offset-sm-3 col-sm-3 d-grid">
   <button type="submit" class="btn btn-primary"> Submit</button>
   

</div>
<div class="col-sm-3 d-grid">
   <a class= "btn btn-outline-primary" href="./brgy.php" Role = " button">Cancel</a>

</div>
   </div>
         </form>
      </div>
      </body>
</html>