<?php

if (isset($_POST['log'])){

    echo 'this is login instances <br>';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($_POST['remember'])){
        setcookie('username',$username,time() + (60*60*24*30*12), '/');
        setcookie('password',$password,time() + (60*60*24*30*12),'/');
    }

    // instatiate sign-up object
    include "classes/login-class.php";
    

    $login = new Login($username,$password);

    // error handlers 

    $login->loginUser();

    // going back to the main page

    header('location:../welcome.php');

}

?>
