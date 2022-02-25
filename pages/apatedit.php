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

    <div class="page-title">Edit Patient:</div>

    <div class="all-data">
        <?php
            $patID = $_GET['patid'];
           $getData = $conn->query("SELECT * FROM patients WHERE pat_id = $patID")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <form action="editpat.php" method="POST">
            <input type="text" name="patname" placeholder="patient name" autocomplete="off" value="<?php echo $getData[0]['pat_name'] ;?>">
            <input type="text" name="phone" placeholder="patient phone" autocomplete="off" value="<?php echo $getData[0]['pat_phone'] ;?>">
            <input type="number" name="age" placeholder="patient age" value="<?php echo $getData[0]['pat_age'] ;?>">
            <span>Gender:</span>
            <div style="margin-left: 10%;">
                <input type="radio" name="gender" value="male" class="no" <?php if($getData[0]['pat_gender'] == 'Male'){echo "checked";}  ;?>>
                <label>Male</label>
            </div>
            <div style="margin-left: 10%;">
                <input type="radio" name="gender" value="female" class="no" <?php if($getData[0]['pat_gender'] == 'Female'){echo "checked";} ; ?>>
                <label>female</label>
            </div>
            <select name="treatid">
                <option value="0">Select Traetment doctor</option>
                <?php
                    $getTreats = $conn->query("SELECT treat_id, treat_name
                    FROM treat_doctors")->fetchAll(PDO::FETCH_KEY_PAIR);
                    foreach($getTreats as $key => $value){
                        if($key  == $getData[0]['treat_id']){
                            echo "<option value=\"" . $key . "\" selected=\"selected\">"  . $value . "</option>";
                        }
                        else{
                            echo "<option value=\"" . $key . "\">"  . $value . "</option>";
                        }
                    }
                ?>
            </select>
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