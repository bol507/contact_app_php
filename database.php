<?php
$host = "localhost";
$database = "contact_app";
$user = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$host;dbname=$database",$user,$password);
}catch(PDOException $e){
    die("PDO connection error: ". $e->getMessage());
}