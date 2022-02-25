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
        <table class="big-table">
            <tr>
                <th>Employee name</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>salary</th>
                <th>Hire Date</th>
                <th>Age</th>
                <th>Gender</th>
                <th>National ID</th>
                <th>Nationality</th>
                <th>Added By</th>
            </tr>
            <?php
                $getPatient = $conn->query("SELECT emp_name, job_title, dept_name, Salary, hire_date, age,
                gender, national_id, nationality, user_username
                FROM employees, jobs, departments, users
                WHERE employees.job_id = jobs.job_id
                AND employees.dept_id = departments.dept_id
                AND employees.user_userid = users.user_userid");
                while($row = $getPatient->fetch()):
            ?>
                <tr>
                    <td><?php echo $row['emp_name'] ;?></td>
                    <td><?php echo $row['job_title'] ;?></td>
                    <td><?php echo $row['dept_name'] ;?></td>
                    <td><?php echo $row['Salary'] . " L.E";?></td>
                    <td><?php echo $row['hire_date'];?></td>
                    <td><?php echo $row['age'];?></td>
                    <td><?php echo $row['gender'];?></td>
                    <td><?php echo $row['national_id'];?></td>
                    <td><?php echo $row['nationality'];?></td>
                    <td><?php echo $row['user_username'] ;?></td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>

    <div class="data-btns">
        <a href="aempadd.php">Add</a>
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