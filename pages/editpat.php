<?php
session_start();
include "../master/connect.php";
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $patname = $_POST['patname'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gen = $_POST['gender'];
    $treatId = $_POST['treatid'];
    $addBy = $_SESSION['userid'];
    // $sqlInsert = $conn->prepare("INSERT INTO patients(pat_name, pat_phone, pat_age, pat_gender, treat_id,
    // user_userid) VALUES(?,?,?,?,?,?)");
    // $sqlInsert->execute([$patname, $phone, $age, $gen, $treatId, $addBy]);
    // header("location:apatients.php");
    // exit;
}