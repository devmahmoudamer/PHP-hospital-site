<?php
session_start();
include "../master/connect.php";
$patId = $_GET['q'];
$getAge = $conn->query("SELECT pat_age 
FROM patients WHERE pat_id = $patId")->fetchAll(PDO::FETCH_COLUMN);
echo $getAge[0];