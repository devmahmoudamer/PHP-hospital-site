<?php
session_start();
include "../master/connect.php";
$patId = $_GET['q'];
$getMob = $conn->query("SELECT pat_phone 
FROM patients WHERE pat_id = $patId")->fetchAll(PDO::FETCH_COLUMN);
echo $getMob[0];