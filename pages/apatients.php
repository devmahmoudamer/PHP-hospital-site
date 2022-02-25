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

    <div class="page-title">Patients:</div>

    <div class="all-data" style="width: 100%;">
        <form action="apatedit.php" style="width: 100%;" method="GET">
            <table style="width : 99%" cellspacing="0">
                <tr>
                    <th>Patient name</th>
                    <th>Phone</th>
                    <th>age</th>
                    <th>Gender</th>
                    <th>Treatment Doctor</th>
                    <th>Added By</th>
                    <th class="hide">Select To edit</th>
                </tr>
                <?php
                    $getPatient = $conn->query("SELECT pat_id,pat_name, pat_phone, pat_age, pat_gender, treat_name,
                    user_username FROM patients,treat_doctors, users
                    WHERE patients.treat_id = treat_doctors.treat_id
                    AND patients.user_userid = users.user_userid");
                    while($row = $getPatient->fetch()):
                ?>
                    <tr>
                        <td><?php echo $row['pat_name'] ;?></td>
                        <td><?php echo $row['pat_phone'] ;?></td>
                        <td><?php echo $row['pat_age'] ;?></td>
                        <td><?php echo $row['pat_gender'] ;?></td>
                        <td><?php echo $row['treat_name'] ;?></td>
                        <td><?php echo $row['user_username'] ;?></td>
                        <td class="hide">
                            <input type="radio" name="patid" class="no" value="<?php echo $row['pat_id'] ;?>">
                        </td>
                    </tr>
                <?php endwhile;?>
            </table>

            
            <div class="data-btns">
                <a href="apatadd.php">Add</a>
                <span class="sub-a" id="e-click">Edit</span>
                <input type="submit" value="Edit" class="sub-a no" id="show" style="display: none;">
                <a href="#">delete</a>
            </div>
        </form>
    </div>


</div>
<!-- ====================================================================================================== -->
<!-- page foot  -->
<?php 
    include "../master/foot.php";
?>

<!-- my script -->
<script src="../master/js//edit.js"></script>
<!-- page end -->
<?php
    include "../master/end.php";
?>