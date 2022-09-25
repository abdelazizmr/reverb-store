<?php
if (isset($_POST['log'])){

    echo "here";

    //grabbing data

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword){
        header("location:../sign-up.php?password_must_be_identical");
        exit();
    }

    // instatiate sign-up object
    include "classes/connection.php";
    include "classes/sign-up-class.php";
    

    $sign_up = new signUpControl($username,$email,$password);

    // error handlers 

    $sign_up->signupUser();

    // going back to the main page

    header('location:../index.php?signup=success');
    
   
}
?>
