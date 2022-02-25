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

    <div class="page-title">Examinations:</div>

    <div class="all-data">
        <table>
            <tr>
                <th>Examination ID</th>
                <th>Examination name</th>
                <th>Price</th>
                <th>Added By</th>
            </tr>
            <?php
                $getExam = $conn->query("SELECT exam_id ,exam_name, exam_price, user_username 
                FROM examinations, users
                WHERE examinations.user_userid = users.user_userid");
                while($row = $getExam->fetch()):
            ?>
                <tr>
                    <td><?php echo $row['exam_id'] ;?></td>
                    <td><?php echo $row['exam_name'] ;?></td>
                    <td><?php echo $row['exam_price'] ;?></td>
                    <td><?php echo $row['user_username'] ;?></td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>

    <div class="data-btns">
        <a href="aexamadd.php">Add</a>
        <a href="#">Edit</a>
        <a href="#">delete</a>
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