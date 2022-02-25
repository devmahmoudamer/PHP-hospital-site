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
elseif(!in_array($_SESSION['user'],$stamt1)){
    header("location:out.php");
    exit();
}
include "../master/start.php";
?>

<!-- welcome message  -->
<div class="profile">Welcome <?php echo $_SESSION['usertype'] . " " . $_SESSION['user'] ; ?></div>

<!-- admin links -->
<?php
    include "../master/adminlinks.php";
?>

<!--- =================================== page data ===================================================== -->
<div class="page-data">

    <div class="page-title">Edit Traetment Doctors:</div>

    <div class="all-data">
        <?php
            $treatId = $_GET['treatid'];
            $getData = $conn->query("SELECT * FROM treat_doctors 
            WHERE treat_id = $treatId")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <form action="edittreat.php" method="POST">

            <input type="text" name="treatname" placeholder="doctor name" autocomplete="off" value="<?php echo $getData[0]['treat_name'] ; ?>">
            <input type="text" name="phone" placeholder="doctor phone" autocomplete="off" value="<?php echo $getData[0]['treat_phone'] ; ?>">
            <input type="text" name="address" placeholder="doctor address" autocomplete="off" value="<?php echo $getData[0]['treat_address'] ; ?>">
            <input type="text" name="section" placeholder="doctor section" autocomplete="off" value="<?php echo $getData[0]['treat_section'] ; ?>">
            <input type="number" name="treatid" value="<?php echo $getData[0]['treat_id'] ; ?>" style="display: none;">
            <input type="submit" value="Save">
          
        </form>
    </div>
</div>
<!-- ====================================================================================================== -->
<!-- page foot  -->
<?php 
    include "../master/foot.php";
?>

<!-- my script -->

<!-- page end -->
<?php
    include "../master/end.php";
?>