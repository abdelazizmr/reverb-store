<?php

include_once("connection.php");

class Login extends ConnectToDb{

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

    // connecting to db and checking for the user username and pwd

    public function getUser($username,$password){
        $stmt = $this->connectToDataBase()->prepare('select client_password from clients where client_username = ?');

        // checking if the query failed

        if (!$stmt->execute(array($username))){
            $stmt = null;
            header('location:../index.php?error=failedQueryConnection');
            exit();
        }

        // checking how many rows the db has returned

        if ($stmt->rowCount() === 0 ){
            $stmt = null;
            header("location:../index.php?error=invalid_login");
            exit();
        }

        //grabbed pwd from the db
        $pwdGrabbed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        if ($password !== $pwdGrabbed[0]["client_password"]){
            echo header('location:../index.php?uncorrect_password');
            exit();
        }
        // the ability to login uusing username and email
        else if ($password == $pwdGrabbed[0]["client_password"]){
            $stmt = $this->connectToDataBase()->prepare('select * from clients where client_username = ? and client_password = ?');

            if (!$stmt->execute(array($username,$password))){
            $stmt = null;
            header('location:../../index.php?error=failedQueryConnection');
            exit();
            }

            if ($stmt->rowCount() == 0 ){
            $stmt = null;
            header("loaction:../index.php?error=invalid_login");
            exit();
            }

            //sitting the username from the database to a global session

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();

            $_SESSION["USERNAME"] = $user[0]["client_username"];
            $_SESSION["ID"] = $user[0]["client_id"];

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











