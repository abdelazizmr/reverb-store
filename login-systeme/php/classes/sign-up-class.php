<?php

include_once("connection.php");

class signUpControl extends signUp {

    private $username;
    private $email;
    private $password;

    public function __construct($username,$email,$password){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function emptyField(){
        if (empty($this->username) || empty($this->email) || empty($this->password)){
            return false;
        }
        return true;
    }


    public function validUsername(){
        if (!preg_match("/^[a-zA-Z]*[0-9]*$/",$this->username)){
            return false;
        }
        return true;
    }


    public function validEmail(){
        if(filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    

    public function matched(){
        // calling the method from signup class
        
        if (!$this->checkuser($this->username,$this->email)){
            return false;
        }else{
            return true;
        }
    }

    public function signupUser(){

        if($this->emptyField() == false){
            // echo empty field error
            header('location:../sign-up.php?error=emptyField');
            exit();
        }

        if($this->validUsername() == false){
            // echo username error
            header('location:../sign-up.php?error=invalidUsername');
            exit();
        }

        if($this->validEmail() == false){
            // echo email error
            header('location:../sign-up.php?error=invalidEmail');
            exit();
        }

        if($this->matched() == false){
            // echo taken username and email error
            header('location:../sign-up.php?error=takenEmailOrUsername');
            exit();
        }

        // else : sign up this user in db

        $this->setUser($this->username,$this->email,$this->password);



    }

}












class signUp extends ConnectToDb {

    // checking if the user has already an account 

    public function checkuser($username,$email){
        $stmt = $this->connectToDataBase()->prepare('select client_username from clients where client_username = ? or client_email = ?');

        // checking if the query failed

        if (!$stmt->execute(array($username,$email))){
            $stmt = null;
            header('location:../../sign-up.php?error=failedQueryConnection');
            exit();
        }

        // checking how many rows the db has returned


        if ($stmt->rowCount() > 0 ){
            return false;
        }else{
            return true;
        }
    }

    

    // adding user to the data base

    public function setUser($username,$email,$password){
        $stmt = $this->connectToDataBase()->prepare('insert into clients(client_username, client_email, client_password) values (?,?,?);');

        // checking if the query failed

        if (!$stmt->execute(array($username,$email,$password))){
            $stmt = null;
            header('location:../../sign-up.php?error=failedQueryConnection');
            exit();
        }

        $stmt = null;
    }

    


}