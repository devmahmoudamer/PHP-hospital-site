<?php
$hostname = "localhost";
$dbname = "heart_aug";
$username = "root";
$password = "";
try{
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "connection Failed " . $e->getMessage();
}