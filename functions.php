<?php


function check_login($conn){
    if(isset($_SESSION['id'])){
        
        $id = $_SESSION['id'];
        $query = "select * from user_login where id = $id LIMIT 1";
        $result = mysqli_query($conn,$query);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }
  


    //redirect to login page

    header("Location: login.php");
    die;
}

function check_user($conn){
    if(isset($_SESSION['id'])){
        
        $name = 2;
        $query = "select * from indigentlist where id = $name LIMIT 1";
        $result = mysqli_query($conn,$query);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }
  


   
}




?>