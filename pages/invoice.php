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

    <div class="page-title">Invoice:</div>

    <div class="all-data">
        <form action="invo.php" style="width: 100%;" method="POST">
            <table class="inv">
                <!-- invoice head -->
                <tr>
                    <th>Patient</th>
                    <td>
                        <select name="patid" id="patid">
                            <option value="">Select Patient</option>
                            <?php
                                $getPat = $conn->query("SELECT pat_id, pat_name
                                FROM patients")->fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach($getPat as $key => $value):
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td></td>
                    <th>date</th>
                    <td>
                        <input type="text" autocomplete="off" name="date" id="inv-date">
                    </td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>
                        <input type="text" name="phone" id="mob">
                    </td>
                    <td></td>
                    <th>Time</th>
                    <td>
                        <input type="text" name="time" id="inv-time">
                    </td>
                </tr>

                <tr>
                    <th>Age</th>
                    <td>
                        <input type="text" name="age" id="age">
                    </td>
                    <td></td>
                    <th>Invoice No.</th>
                    <td>
                        <input type="number" name="invid">
                    </td>
                </tr>

                <!-- space -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <!-- invoice details -->
                <tr>
                    <th colspan="2" class="detail">Examinations</th>
                    <th class="detail">Price</th>
                    <th class="detail">Discount</th>
                    <th class="detail">Amount</th>
                </tr>

                <tr>
                    <td colspan="2" class="detail">
                        <select name="examid[]" id="exam1">
                            <option value="">Select Examination</option>
                            <?php
                                $getExam = $conn->query("SELECT exam_id, exam_name
                                FROM examinations")->fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach($getExam as $key => $value):
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td class="detail">
                        <input type="number" name="price[]" id="price1">
                    </td>
                    <td class="detail">
                        <input type="number" name="discount[]" id="">
                    </td>
                    <td class="detail">
                        <input type="number" name="amount[]" id="">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="detail">
                        <select name="examid[]" id="exam2">
                        <option value="">Select Examination</option>
                            <?php
                                foreach($getExam as $key => $value):
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td class="detail">
                        <input type="number" name="price[]" id="price2">
                    </td>
                    <td class="detail">
                        <input type="number" name="discount[]" id="discount2">
                    </td>
                    <td class="detail">
                        <input type="number" name="amount[]" id="amount2">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="detail">
                        <select name="examid[]" id="exam3">
                        <option value="">Select Examination</option>
                            <?php
                                foreach($getExam as $key => $value):
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td class="detail">
                        <input type="number" name="price[]" id="price3">
                    </td>
                    <td class="detail">
                        <input type="number" name="discount[]" id="discount3">
                    </td>
                    <td class="detail">
                        <input type="number" name="amount[]" id="amount3">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="detail">
                        <select name="examid[]" id="exam4">
                        <option value="0">Select Examination</option>
                            <?php
                                foreach($getExam as $key => $value):
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td class="detail">
                        <input type="number" name="price[]" id="price4">
                    </td>
                    <td class="detail">
                        <input type="number" name="discount[]" id="discount4">
                    </td>
                    <td class="detail">
                        <input type="number" name="amount[]" id="amount4">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="detail">
                        <select name="examid[]" id="exam5">
                        <option value="">Select Examination</option>
                            <?php
                                foreach($getExam as $key => $value):
                            ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td class="detail">
                        <input type="number" name="price[]" id="price5">
                    </td>
                    <td class="detail">
                        <input type="number" name="discount[]" id="discount5">
                    </td>
                    <td class="detail">
                        <input type="number" name="amount[]" id="amount5">
                    </td>
                </tr>

                <tr>
                    <th class="detail" colspan="4" style="text-align: right; padding-right : 2%">Total</th>
                    <td class="detail">
                        <input type="number" name="total" id="total">
                    </td>
                </tr>

                <tr>
                    <th>Treatment Doctor</th>
                    <td>
                        <input type="text" name="treatdoc" id="tdoc">
                    </td>
                    <td></td>
                    <th>Exam. Doctor</th>
                    <td>
                        <select name="" id=""></select>
                    </td>
                </tr>

                <tr>
                    <th>
                        employee
                    </th>
                    <td>
                        <input type="text" value="<?php echo $_SESSION['user'];?>">
                    </td>
                </tr>
            </table>
            <input type="submit" value="Save" style="width: 25%; display:block; margin : 1% auto">
        </form>
    </div>
</div>
<!-- ====================================================================================================== -->
<!-- page foot  -->
<?php 
    include "../master/foot.php";
?>

<!-- my script -->
<script src="../master/js/invoice.js"></script>
<!-- page end -->
<?php
    include "../master/end.php";
?>