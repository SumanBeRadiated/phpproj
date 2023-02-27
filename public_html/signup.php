<?php include '../resources/config/db.php'; ?>
<?php
    global $err_msg;
    $err_msg = "";
    if(isset($_POST["submit"])) {
        try {
            
        
                $email = $_POST["email"];
                $username = $_POST["username"];
                $password = $_POST["password1"];
                $signup_query = "INSERT INTO tbl_user(email, username, password) VALUE('$email', '$username', '$password')";

            if(mysqli_query($link, $signup_query)) {
                


                $login_query = "SELECT * FROM tbl_user WHERE email = '$email' and password = '$password'";

                if($data = mysqli_query($link, $login_query)) {
                    if(mysqli_num_rows($data) > 0) {
                        $row = mysqli_fetch_assoc($data);
        
                        setcookie("cur_user", $row["id"], time() + 3600*24*30);
                        setcookie("cur_user_uname", $row["username"], time() + 3600*24*30);
                        
                        header("Location: index.php");
                        
                    }
                }

            }

        } catch (Exception $e) {
            $err_msg = "Cannot Signup";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php include '../resources/template/header.php'; ?>
    <form name="signupform" method="POST" onsubmit="return validateSignup()">
        <label>Email</label>
        <input type="email" name="email"> <br>
        <label>Username</label>
        <input type="username" name="username"> <br>
        <label>Password</label>
        <input type="password" name="password1"> <br>
        <label>Confirm Password</label>
        <input type="password" name="password2"> <br>
        <input type="submit" name="submit" value="Submit">
    </form>
     <div id="opt"></div>
    <?php echo $err_msg ?>
    <?php include '../resources/template/footer.php'; ?>

    <script src="./js/script.js"></script>

</body>
</html>


