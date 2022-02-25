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

    <div class="page-title">departments:</div>

    <div class="all-data">
        <table>
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Added By</th>
            </tr>
            <?php
                $getDept = $conn->query("SELECT dept_id, dept_name, user_username 
                FROM departments, users
                WHERE departments.user_userid = users.user_userid");
                while($row = $getDept->fetch()):
            ?>
                <tr>
                    <td><?php echo $row['dept_id'] ;?></td>
                    <td><?php echo $row['dept_name'] ;?></td>
                    <td><?php echo $row['user_username'] ;?></td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>

    <div class="data-btns">
        <a href="adeptadd.php">Add</a>
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