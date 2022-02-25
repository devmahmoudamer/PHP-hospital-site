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

    <div class="page-title">Items:</div>

    <div class="all-data">
        <div class="gallery">
            <?php
                $getItems = $conn->query("SELECT * FROM items");
                while($row = $getItems->fetch()):
            ?>
            <div>
                <img src="<?php echo $row['item_photo'] ;?>" alt="">
                <div class="item-data">
                    <div class="item-name"><?php echo $row['item_name'] ;?></div>
                    <div class="item-price"><?php echo $row['item_price'] ;?></div>
                </div>
            </div>
            <?php endwhile;?>
        </div>
    </div>

    <div class="data-btns">
        <a href="aitemadd.php">Add</a>
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