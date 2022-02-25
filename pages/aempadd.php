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

    <div class="page-title">Add Employees:</div>

    <div class="all-data">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <span>Employee Name:</span>
            <input type="text" name="empname" autocomplete="off">
            <span>Job Title:</span>
            <select name="jobid" style="text-align: left;">
                <?php
                    $getJob = $conn->query("SELECT job_id, Job_title
                    FROM jobs")->fetchAll(PDO::FETCH_KEY_PAIR);
                    foreach($getJob as $key => $value){
                        echo "<option value=\"" . $key . "\">"  . $value . "</option>";
                    }
                ?>
            </select>
            <span>Department:</span>
            <select name="deptid" style="text-align: left;">
                <?php
                    $getDept = $conn->query("SELECT dept_id, dept_name
                    FROM departments")->fetchAll(PDO::FETCH_KEY_PAIR);
                    foreach($getDept as $key => $value){
                        echo "<option value=\"" . $key . "\">"  . $value . "</option>";
                    }
                ?>
            </select>
            <span>Salary:</span>
            <input type="number" name="salary" id="">
            <span>Hire Date:</span>
            <input type="date" name="hdate" id="">
            <span>Age:</span>
            <input type="number" name="age" id="">
            <span>Gender:</span>
            <div style="margin-left: 10%;">
                <input type="radio" name="gender" value="male" class="no">
                <label>Male</label>
            </div>
            <div style="margin-left: 10%;">
                <input type="radio" name="gender" value="female" class="no">
                <label>female</label>
            </div>
            <span>National ID:</span>
            <input type="text" name="nationid" id="" autocomplete="off">
            <span>Nationality:</span>
            <input type="text" name="nationality" id="" autocomplete="off" value="Egyptian">
            <input type="submit" value="Save">
        </form>
        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $empname = $_POST['empname'];
                $jobId = $_POST['jobid'];
                $deptId = $_POST['deptid'];
                $salary = $_POST['salary'];
                $hdate = $_POST['hdate'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $nationID = $_POST['nationid'];
                $nation = $_POST['nationality'];
                $addBy = $_SESSION['userid'];
                $sqlInsert = $conn->prepare("INSERT INTO employees(emp_name, job_id, dept_id, salary, hire_date,
                age, gender, national_id, nationality, user_userid)
                VALUES(?,?,?,?,?,?,?,?,?,?)");
                $sqlInsert->execute([$empname, $jobId, $deptId, $salary, $hdate, $age, $gender, $nationID, $nation, $addBy]);
                header("location:aemp.php");
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