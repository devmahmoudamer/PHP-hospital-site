<?php
session_start();
include "../master/connect.php";
$patId = $_GET['q'];
$getTreat = $conn->query("SELECT pat_id, treat_name
FROM patients, treat_doctors WHERE patients.treat_id = treat_doctors.treat_id
AND patients.pat_id = $patId")->fetchAll(PDO::FETCH_KEY_PAIR);
echo $getTreat[$patId];