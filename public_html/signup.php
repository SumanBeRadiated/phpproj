<?php include '../resources/config/db.php'; ?>
<?php
    global $err_msg;
    $err_msg = "";
    if(isset($_POST["submit"])) {
        try {
            
        
                $email = $_POST["email"];
                $username = $_POST["username"];
                $password = $_POST["password1"];
                $full_name = $_POST["full_name"];
                $signup_query = "INSERT INTO tbl_user(email, username, password, full_name) VALUE('$email', '$username', '$password', '$full_name')";

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
    <title>Signup | Infinity News</title>
         <?php include '../resources/template/head.php'; ?>
</head>
<body>

    <?php include '../resources/template/header.php'; ?>
    <div class="form-sl container">
    <h2>Signup</h2>
    <form name="signupform" method="POST" onsubmit="return validateSignup()" class="flex">
        <label>Email
        <input type="email" name="email">
        </label>
        <label>Username
        <input type="username" name="username">
        </label>
        <label>Full Name
        <input type="text" name="full_name">
        </label>
        <label>Password
        <input type="password" name="password1">
        </label>
        <label>Confirm Password
        <input type="password" name="password2">
        </label>
        <input type="submit" name="submit" value="Submit" class="btn-pri">
    </form>
     <div id="opt"></div>
    <?php echo $err_msg ?>
    </div>
    <?php include '../resources/template/footer.php'; ?>

    <script src="./js/script.js"></script>

</body>
</html>


