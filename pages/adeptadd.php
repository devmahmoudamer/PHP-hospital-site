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

    <div class="page-title">Add Department:</div>

    <div class="all-data">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="text" name="deptname" placeholder="department bane" autocomplete="off">
            <input type="submit" value="Save">
        </form>
        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $dept = $_POST['deptname'];
                $addBy = $_SESSION['userid'];
                $sqlInsert = $conn->prepare("INSERT INTO departments(dept_name,user_userid) VALUES(?,?)");
                $sqlInsert->execute([$dept, $addBy]);
                header("location:adept.php");
                exit;
            }
        ?>
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