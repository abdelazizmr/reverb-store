<?php

include "classes/connection.php";
include "classes/login-class.php";


class AdminLogin extends ConnectToDb{
    private $username;
    private $password;

    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }

    public function emptyField(){
        if (empty($this->username) || empty($this->password)){
            return false;
        }
        return true;
    }

    public function getUser($username,$password){
        $stmt = $this->connectToDataBase()->prepare('select admin_password from admins where admin_username = ?');

        // checking if the query failed

        if (!$stmt->execute(array($username))){
            $stmt = null;
            header('location:../admin.php?error=failedQueryConnection');
            exit();
        }

        // checking how many rows the db has returned

        
        if ($stmt->rowCount() === 0){
            $stmt = null;
            header("location:../admin.php?error=invalid_login");
            exit();
        }

        //grabbed pwd from the db
        $pwdGrabbed = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $password;
        echo '<br>';

        print_r($pwdGrabbed);

        if ($password !== $pwdGrabbed["admin_password"]){
            echo header('location:../admin.php?uncorrect_password');
            exit();
        }

        else if ($password == $pwdGrabbed["admin_password"]){
            $stmt = $this->connectToDataBase()->prepare('select * from admins where admin_username = ? and admin_password = ?');

            if (!$stmt->execute(array($username,$password))){
            $stmt = null;
            header('location:../../admin.php?error=failedQueryConnection');
            exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            
            //print_r($user);

            $_SESSION["USERNAME"] = $user[0]["admin_username"];
            $_SESSION["ID"] = $user[0]["admin_id"];
            $stmt = null;
        }

        $stmt = null;
    }


    public function loginUser(){

        if($this->emptyField() == false){
            // echo empty field error
            echo '<script>alert("Erorr! empty field")</script>';
            exit();
        }

        $this->getUser($this->username,$this->password);

        
    }
    
    
    
}



// instatinating objects
if (isset($_POST['log'])){
    //ausername stands for admin username
    $ausername = $_POST['username'];
    $apassword = $_POST['password'];


    if (empty($ausername) or empty($apassword)){
        header('location:../admin.php?error=EmptyField');
        exit();
    }

    $login = new AdminLogin($ausername,$apassword);
    $login->loginUser();
    header('location:../../home/home.php?admin=true');
    exit();
}



?>