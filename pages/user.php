<!-- start page -->
<?php
session_start();
include "../master/connect.php";
$stamt1 = $conn->query("SELECT user_username FROM users 
WHERE user_usertype = 1")->fetchAll(PDO::FETCH_COLUMN);
if( !isset($_SESSION['user']) ){
    header("location:../aaa.php");
    exit();
}   
elseif(in_array($_SESSION['user'],$stamt1)){
    header("location:out.php");
    exit();
}
include "../master/start.php";
?>

<!-- welcome message  -->
<div class="profile">Welcome <?php echo $_SESSION['usertype'] . " " . $_SESSION['user'] ; ?></div>

<!-- admin links -->
<?php
    include "../master/userlinks.php";
?>

<!-- page data  -->
<div class="page-data">
    <h3 style="text-align: center;">User dashboard</h3>
</div>

<!-- page foot  -->
<?php 
    include "../master/foot.php";
?>

<!-- my script -->

<!-- page end -->
<?php
    include "../master/end.php";
?>