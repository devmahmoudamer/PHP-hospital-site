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

    <div class="page-title">Jobs:</div>

    <div class="all-data">
        <table>
            <tr>
                <th>Job ID</th>
                <th>Job Title</th>
                <th>Added By</th>
            </tr>
            <?php
                $getJobs = $conn->query("SELECT job_id, job_title, user_username 
                FROM jobs, users
                WHERE jobs.user_userid = users.user_userid");
                while($row = $getJobs->fetch()):
            ?>
                <tr>
                    <td><?php echo $row['job_id'] ;?></td>
                    <td><?php echo $row['job_title'] ;?></td>
                    <td><?php echo $row['user_username'] ;?></td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>

    <div class="data-btns">
        <a href="ajobsadd.php">Add</a>
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