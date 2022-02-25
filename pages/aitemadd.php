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

    <div class="page-title">Add Item:</div>

    <div class="all-data">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="itemname" placeholder="item name" autocomplete="off">
            <input type="number" name="price" placeholder="item price">
            <input type="number" name="quantity" placeholder="item quantity">
            <span>item photo</span>
            <input type="file" name="uploadimage">
            <input type="submit" value="Save">
        </form>
        <?php   
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $itemName = $_POST['itemname'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $filepath = dirname(__FILE__,2). "/" . "upload/";
                $fileUp = $filepath . $_FILES['uploadimage']['name'];
                $image_path = "../upload/" .  $_FILES['uploadimage']['name'];
                move_uploaded_file($_FILES['uploadimage']['tmp_name'], $fileUp);
                $sqlInsert = $conn->prepare("INSERT INTO items(item_name, item_price, item_quantity, item_photo)
                VALUES(?,?,?,?)");
                $sqlInsert->execute([$itemName,$price,$quantity,$image_path]);
                header("location:items.php");
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