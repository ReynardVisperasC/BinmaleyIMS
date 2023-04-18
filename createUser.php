<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "binmaley_db";	

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

$user_name = "";
$barangay = "";
$user_role = "";
$user_pass = "";

$SuccessMessage = "";
$ErrorMessage="";

if($_SERVER['REQUEST_METHOD']=='POST'){
   $user_name = $_POST['user_name'];
   $barangay = $_POST['barangay'];
   $user_role = $_POST['user_status'];
   $user_pass = $_POST['user_pass'];
   do{
      if(empty($user_name) || empty($user_pass) ){
         $ErrorMessage = "All Fields are Required";
         break;
      }
 $sql= "INSERT INTO `user_login`(`id`, `user_name`, `user_pass`, `user_status`, `barangay`) VALUES ('','$user_name','$user_pass','$user_role','$barangay')";   
 $adding = $connection->query($sql);
 if(!$adding){
   $ErrorMessage = "Invalid Query: " . $connection->error;
   break;
}
   
$SuccessMessage = "User Added Successfully";

header("location: ./index.php");
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
         <h2>New User</h2>
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
               <label class = "col sm-3 col-form-label">Username</label>
               <div>
                  <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>"/>
               </div>
            </div>
         
            <div class="row mb-3">
               <label class = "col sm-3 col-form-label">Password</label>
               <div>
                  <input type="text" class="form-control" name="user_pass" value="<?php echo $user_pass; ?>"/>
               </div>
            </div>
           <label class = "col sm-3 col-form-label">Barangay/Municipality</label>
            <select name="barangay" value="<?php echo $option; ?>">
    <option value= "Binmaley">Binmaley</option>
    <?php 
    $query ="SELECT barangay_name FROM barangaylist ";
    $result = $connection->query($query);
    if($result->num_rows> 0){
        while($optionData=$result->fetch_assoc()){
        $option =$optionData['barangay_name'];
    ?>
    <option value = <?php echo $option; ?> ><?php echo $option; ?> </option>
   <?php
    }}
    ?>
</select>
<br>
<label class = "col sm-3 col-form-label">User Role</label>
            <select name="user_status" value="<?php echo $user_role?>">
    <option name="hehe">Admin</option>
    
    <option name="hehe">Barangay</option>
</select>
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
   <a class= "btn btn-outline-primary" href="./index.php" Role = " button">Cancel</a>

</div>
   </div>
         </form>
      </div>
</body>
</html>