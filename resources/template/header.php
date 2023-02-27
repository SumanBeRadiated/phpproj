<header>
    
    <?php 
        include '../resources/template/nav.php'; 
        if(isset($_POST["logout"])) {
            setcookie("cur_user", "", time() - 3600*24*30);
            setcookie("cur_user_uname", "", time() - 3600*24*30);
            header("Refresh:0");
        }
    ?>

        <?php if(isset($_COOKIE["cur_user"])) { ?>

        <ul>
            <li>
                <a href="/mp/NewsApp/public_html/profile.php"><?php echo $_COOKIE["cur_user_uname"]; ?></a>
            </li>
            <li>
                <form method="POST">
                    <input type="submit" value="Logout" name="logout" />
                </form>
            </li>
        </ul>

        <?php } else { ?>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            </ul>

        <?php } ?>


</header>