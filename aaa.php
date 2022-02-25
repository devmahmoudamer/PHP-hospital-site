<?php
    session_start();
    include "./master/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Heart</title>
        <link rel="stylesheet" href="./master/boot/css/bootstrap.css">
        <script src="./master/boot/js/bootstrap.js"></script>
        <link rel="stylesheet" href="./master/css/normalize.css">
        <link rel="stylesheet" href="./master/css/style.css">
    </head>
    <body>
        <header></header>
        <div class="abc">
            <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
                <input type="text" name="username" autocomplete="off" placeholder="username">
                <input type="password" name="pass" placeholder="password">
                <input type="submit" value="Login">
            </form>
            <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $user = $_POST['username'];
                $pass = $_POST['pass'];
                $newPass = sha1($pass);
                if( empty($user) || empty($pass) ){
                    echo "<div class=\"error\">Please write username and password to log</div>";
                }
                else{
                    $logCheck = $conn->query("SELECT user_username, user_password 
                    FROM users Where user_username = '$user' 
                    AND user_password = '$newPass'")->fetchAll(PDO::FETCH_KEY_PAIR);
                    if( count($logCheck) > 0){
                       $stamt1 = $conn->query("SELECT user_username FROM users 
                       WHERE user_usertype = 1")->fetchAll(PDO::FETCH_COLUMN);
                        $stamt2 = $conn->query("SELECT user_userid FROM users 
                        WHERE user_username = '$user'")->fetchAll(PDO::FETCH_COLUMN);
                       if( in_array($user, $stamt1) ){
                            $_SESSION['user'] = $user;
                            $_SESSION['usertype'] = "Admin";
                            $_SESSION['userid'] = $stamt2[0];
                            header("location:./pages/admin.php");
                            exit;
                       }
                       else{
                            $_SESSION['user'] = $user;
                            $_SESSION['usertype'] = "User";
                            $_SESSION['userid'] = $stamt2[0];
                            header("location:./pages/user.php");
                            exit;
                       }
                    }
                    else{
                        echo "<div class=\"error\">Invalid username or password</div>";
                    }
               
                }
            }
        ?>
        </div>

        <footer>Created By YAT</footer>
    </body>
</html>