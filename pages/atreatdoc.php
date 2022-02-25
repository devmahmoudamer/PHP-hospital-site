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

    <div class="page-title">Traetment Doctors:</div>

    <div class="all-data">
        <form action="atreatedit.php" method="GET" style="width: 100%;">
            <table>
                <tr>
                    <th>Doctor name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Section</th>
                    <th>Added By</th>
                    <th class="hide">Select to Edit</th>
                </tr>
                <?php
                    $getTreat = $conn->query("SELECT treat_id, treat_name, treat_phone, treat_address, treat_section,
                    user_username FROM treat_doctors, users
                    WHERE treat_doctors.user_userid = users.user_userid");
                    while($row = $getTreat->fetch()):
                ?>
                    <tr>
                        <td><?php echo $row['treat_name'] ;?></td>
                        <td><?php echo $row['treat_phone'] ;?></td>
                        <td><?php echo $row['treat_address'] ;?></td>
                        <td><?php echo $row['treat_section'] ;?></td>
                        <td><?php echo $row['user_username'] ;?></td>
                        <td class="hide">
                            <input type="radio" name="treatid" id="" class="no" value="<?php echo $row['treat_id'] ;?>">
                        </td>
                    </tr>
                <?php endwhile;?>
            </table>

            <div class="data-btns">
                <a href="atreatadd.php">Add</a>
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