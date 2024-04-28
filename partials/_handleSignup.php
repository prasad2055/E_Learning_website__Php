<?php
$showErro= "false";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require '_dbconnect.php';
    $user_name = $_POST['fullName'];
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    $sql = "SELECT * FROM `users` WHERE user_email='$user_email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        // User already exists
        $showError="User already exists. Please choose a different email address.";
    } else {
        if($pass == $cpass){
            $password_hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user_name, user_email, user_pass, timestamp) VALUES ( '$user_name', '$user_email', '$password_hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;
                header("Location:/login_system/index.php?userid=true");
                exit();
            }

        } else {

           $showError="Password or Email do not match";
        }
        
    }

    header("Location: /login_system/index.php?userid=false&error=$showError");  
    

}



?>