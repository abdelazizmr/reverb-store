<?php

class ConnectToDb{

    public function connectToDataBase(){
        try{
            $connect  = new PDO('mysql:host=localhost:3306;dbname=e_commerce_store','root','1234');
            return $connect;
        }
        catch(PDOException $e){
            echo "Error : ".$e->getMessage()."!<br>";
            die();
        }
    }
}