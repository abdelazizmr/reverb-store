<?php

class ConnectToDb{

    public function connectToDataBase(){
        try{
            //!you are now connection from the user => store_app  1234
            $connect  = new PDO('mysql:host=localhost:3306;dbname=e_commerce_store','store_app','1234');
            return $connect;
        }
        catch(PDOException $e){
            echo "Error : ".$e->getMessage()."!<br>";
            die();
        }
    }
}