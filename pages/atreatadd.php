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

    <div class="page-title">Add Traetment Doctors:</div>

    <div class="all-data">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="text" name="treatname" placeholder="doctor name" autocomplete="off">
            <input type="text" name="phone" placeholder="doctor phone" autocomplete="off">
            <input type="text" name="address" placeholder="doctor address" autocomplete="off">
            <input type="text" name="section" placeholder="doctor section" autocomplete="off">
            <input type="submit" value="Save">
        </form>
        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $treatname = $_POST['treatname'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $section = $_POST['section'];
                $addBy = $_SESSION['userid'];
                if( empty($treatname) || empty($phone) || empty($address) || empty($section)){
                    echo "<div class=\"error\">you should fill all inputs to save doctor</div>";
                }
                else{
                    $sqlInsert = $conn->prepare("INSERT INTO treat_doctors(treat_name, treat_phone,
                    treat_address, treat_section, user_userid)
                    VALUES(?,?,?,?,?)");
                    $sqlInsert->execute([$treatname, $phone, $address, $section, $addBy]);
                    header("location:atreatdoc.php");
                    exit;
                }
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