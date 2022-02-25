<?php
session_start();
include "../master/connect.php";
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $treat_id = $_POST['treatid'];
    $treatname = $_POST['treatname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $section = $_POST['section'];
    $addBy = $_SESSION['userid'];
    echo $treat_id;
    $sqlInsert = $conn->prepare("REPLACE INTO treat_doctors(treat_id,treat_name, treat_phone,
    treat_address, treat_section, user_userid)
    VALUES(?,?,?,?,?,?)");
    $sqlInsert->execute([$treat_id,$treatname, $phone, $address, $section, $addBy]);
    header("location:atreatdoc.php");
    exit;
}