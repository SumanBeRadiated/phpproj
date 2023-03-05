<header class="container flex">
    <div class="header-logo">
        <a href="/mp/NewsApp/public_html/index.php">
        <h1>Infinity News</h1>
        </a>
    </div>
    <?php 
        include '../resources/template/nav.php'; 
        if(isset($_POST["logout"])) {
            setcookie("cur_user", "", time() - 3600*24*30);
            setcookie("cur_user_uname", "", time() - 3600*24*30);
            header("Refresh:0");
        }
    ?>

        <?php if(isset($_COOKIE["cur_user"])) { ?>

        <ul class="user-nav flex">
            <li>
                <a href="/mp/NewsApp/public_html/profile.php"><b><?php echo $_COOKIE["cur_user_uname"]; ?></b></a>
            </li>
            <li>
                <a href="/mp/NewsApp/public_html/readlater.php">Read Later</a>
            </li>
            <li>
                <form method="POST">
                    <input type="submit" value="Logout" name="logout" class="btn-sec "/>
                </form>
            </li>
        </ul>

        <?php } else { ?>
            <ul class="user-nav flex ">
                <li><a href="signup.php" class="btn-pri">Signup</a></li>
                <li><a href="login.php" class="btn-sec">Login</a></li>
            </ul>

        <?php } ?>

        


</header>
<div class="container headerdis">
    <hr>
    </div>