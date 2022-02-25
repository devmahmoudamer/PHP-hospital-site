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

    <div class="page-title">Add Patient:</div>

    <div class="all-data">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="text" name="patname" placeholder="patient name" autocomplete="off">
            <input type="text" name="phone" placeholder="patient phone" autocomplete="off">
            <input type="number" name="age" placeholder="patient age">
            <span>Gender:</span>
            <div style="margin-left: 10%;">
                <input type="radio" name="gender" value="male" class="no">
                <label>Male</label>
            </div>
            <div style="margin-left: 10%;">
                <input type="radio" name="gender" value="female" class="no">
                <label>female</label>
            </div>
            <select name="treatid">
                <option value="0">Select Traetment doctor</option>
                <?php
                    $getTreats = $conn->query("SELECT treat_id, treat_name
                    FROM treat_doctors")->fetchAll(PDO::FETCH_KEY_PAIR);
                    foreach($getTreats as $key => $value){
                        echo "<option value=\"" . $key . "\">"  . $value . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Save">
        </form>
        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $patname = $_POST['patname'];
                $phone = $_POST['phone'];
                $age = $_POST['age'];
                $gen = $_POST['gender'];
                $treatId = $_POST['treatid'];
                $addBy = $_SESSION['userid'];
                $sqlInsert = $conn->prepare("INSERT INTO patients(pat_name, pat_phone, pat_age, pat_gender, treat_id,
                user_userid) VALUES(?,?,?,?,?,?)");
                $sqlInsert->execute([$patname, $phone, $age, $gen, $treatId, $addBy]);
                header("location:apatients.php");
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