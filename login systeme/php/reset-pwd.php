<?php

include "classes/connection.php";


class ResetPwd extends ConnectToDb{
    public $username;
    public $Npassword;

    public function __construct($username,$Npassword){
        $this->username = $username;
        $this->password = $Npassword;
    }

    function changepwd($username,$Npassword){
        // $connect = '';
        // try{
        //     $connect = new PDO('mysql:host=localhost:3307;dbname=login','root','');
        // }catch(PDOException $e){
        //     echo "Error : ".$e->getMessage()."<br>";
        //     die();
        // }

        $sql = "SELECT * from clients where client_username = '$username' ";

        $stmt = $this->connectToDataBase()->query($sql); 

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($username !== $results['client_username']){
            header('location:../reset.php?error=UserNotFound');
            exit();
        }

        $update = "UPDATE clients set client_password='$Npassword' where client_username ='$username' ";

        $this->connectToDataBase()->query($update);



    }

    public function reset($username,$password){
        $this->changepwd($username,$password);
    }

    
}

if (isset($_POST['reset'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (empty($username) or empty($password) or empty($cpassword)){
        header('location:../reset.php?error=EmptyField');
        exit();
    }

    if ($password !== $cpassword){
        header('location:../reset.php?error=Password_not_identical');
        exit();
    }

    $change = new ResetPwd($username,$password);
    $change->reset($username,$password);
    header('location:../index.php?success=password_changed_successfully');
    exit();
}



?>