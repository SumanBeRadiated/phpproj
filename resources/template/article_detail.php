<?php
$art_id = $_GET["id"];
if (isset($_COOKIE["cur_user"])) {
    $user_c = $_COOKIE["cur_user"];
}





if(isset($_POST["comment_post"])) {

    $comment = $_POST["comment"];
    $my_date = date("Y-m-d H:i:s");
    $comment_query = "INSERT INTO tbl_comment(article, user, comment, date) VALUE('$art_id', '$user_c', '$comment', '$my_date')";
    mysqli_query($link, $comment_query);

     header("Location: ".$_SERVER['REQUEST_URI']);
    
    
}

$article_query = "SELECT * FROM tbl_article WHERE id = '$art_id'";
if ($data = mysqli_query($link, $article_query)) {
    $row = mysqli_fetch_assoc($data);

    $auth_id = $row["author"];
    $author_query = "SELECT * FROM tbl_author WHERE id = '$auth_id'";
    if ($data2 = mysqli_query($link, $author_query)) {
        $row2 = mysqli_fetch_assoc($data2);
    }
}

if (isset($_COOKIE["cur_user"])) {
    $frl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
    $data3 = mysqli_query($link, $frl_query);

    if (isset($_POST["readl"])) {
        $rl_query = "INSERT INTO tbl_read_later(user, article) VALUE('$user_c', '$art_id')";

        mysqli_query($link, $rl_query);
        $frl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
        $data3 = mysqli_query($link, $frl_query);
        header("Location: ".$_SERVER['REQUEST_URI']);
    }
    if (isset($_POST["rm-readl"])) {
        $rl_query = "DELETE FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";

        mysqli_query($link, $rl_query);
        $frl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
        $data3 = mysqli_query($link, $frl_query);
        header("Location: ".$_SERVER['REQUEST_URI']);
    }
}
?>

<title><?php echo $row["title"]; ?> | Infinity News</title>
<main class="container flex">
    
    
    
    <article>
        <div class="article-title flex">
            <h1><?php echo $row["title"]; ?></h1>

            <div class="flex">
                <?php if (isset($_COOKIE["cur_user"])) { ?>
                <form method="POST">
                    <?php if (mysqli_num_rows($data3) > 0) {
                        $row3 = mysqli_fetch_assoc($data3); ?>
                    
                    <input type="submit" value="- Remove from read Later" name="rm-readl" />
                    <?php
                    } else {
                         ?>
                    <input type="submit" value="+ Read Later" name="readl" />
                    <?php
                    } ?>
            
                </form>
                <?php } ?>
                 <div class="art-date">
                    <?php echo $row["pub_date"]; ?>
                </div>
            </div>
        </div>
 
      <div class="auth-det"><?php echo $row2["full_name"]; ?> </div>
    <div class="art-body"><?php $x = explode("*;;*",$row["content"]);
        foreach($x as $p) {
            echo "<p>$p</p>";
        }

     ?></div>
    </article>
</main>
<div class="container"><hr></div>

<div class="comm-section container flex">
    <h2>Comments</h2>
    <?php if (isset($_COOKIE["cur_user"])) {  ?> 
    <div class="input-comment flex">
        <div class="com-prof">Commenting as <b><?php echo $_COOKIE["cur_user_uname"];  ?></b></div>
        <form method="POST">
            <textarea name="comment" cols="30" rows="10"></textarea> <br>
            <input type="submit" name="comment_post" value="Post" class="btn-pri">
        </form>
    </div>
    <?php } ?>
    <ul class="comment-list flex">
        <?php 
            $fetch_comm_query = "SELECT * FROM tbl_comment WHERE article = '$art_id'";
            $comm_data = mysqli_query($link, $fetch_comm_query);
            while($comm_list = mysqli_fetch_assoc($comm_data)) {
                    
                    $userr= $comm_list["user"];
                    $fetch_comer_query = "SELECT * FROM tbl_user WHERE id = '$userr'";
                    $comer_data = mysqli_query($link, $fetch_comer_query);
                    $comer = mysqli_fetch_assoc($comer_data);

        ?>
        <li class="flex">
            <div class="commenter-name">
                <?php echo $comer["username"] ?>
            </div>
            <div class="comment-body">
                 <?php echo $comm_list["comment"] ?>
            </div>
            <div class="comment-date">  
                <?php echo $comm_list["date"] ?>
            </div>
        </li>
        <?php } ?>

    </ul>
        
    
</div>
