<?php

include "../../login-systeme/php/classes/connection.php"; 

class Update extends ConnectToDb{
    // necessary info
    private $username;
    private $email;
    //optional info
    private $name;
    private $phone ;
    private $adress ;
    private $password;
    private $cpassword;
    public function __construct($username,$email,$name,$phone,$adress,$password,$cpassword){
        $this->username = $username;
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->adress = $adress;
        $this->password = $password;
        $this->cpassword = $cpassword;
    }
}













if(isset($_POST['save'])){
    //necessary to login
    $username = $_POST['username'];
    $email = $_POST['email'];
    // optional
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['home-adress'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if(empty($username) and empty( $email)){
        header('location:../update-profil.php?username_and_email_fields_are_necessary');
        exit();
    }

    
}

?>