<?php

$connect;

try{
     $connect = new PDO("mysql:host=localhost;dbname=store",'root','');
}
catch(PDOException $e){
    echo "Error : ".$e->getMessage()."!<br>";
    die();
}
