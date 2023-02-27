<?php 
    $art_id = $_GET['id'];
    $user_c = $_COOKIE["cur_user"];

    $article_query = "SELECT * FROM tbl_article WHERE id = '$art_id'";

    if($data = mysqli_query($link, $article_query)) {
        $row = mysqli_fetch_assoc($data);
        
        $auth_id = $row["author"];
        $author_query = "SELECT * FROM tbl_author WHERE id = '$auth_id'";
        if($data2 = mysqli_query($link, $author_query)) {
            $row2 = mysqli_fetch_assoc($data2);
        }
        
    }

    
    
    $frl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
    $data3 = mysqli_query($link, $frl_query);

    
  


    if(isset($_POST["readl"])) {

        $rl_query = "INSERT INTO tbl_read_later(user, article) VALUE('$user_c', '$art_id')";
        
        mysqli_query($link, $rl_query);
        $frl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
        $data3 = mysqli_query($link, $frl_query);
    }
    if(isset($_POST["rm-readl"])) {

        $rl_query = "DELETE FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
        
        mysqli_query($link, $rl_query);
        $frl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c AND article = '$art_id'";
        $data3 = mysqli_query($link, $frl_query);
    }
        
?>


<main>
    
    
    <article><h2><?php echo $row["title"];?></h2>
    <div class="art-body"><?php echo $row["content"];?></div>
    <div class="art-date">
        <?php echo $row["pub_date"];?>
    </div>
    <div class="auth-det"><h5><?php echo $row2["full_name"]  ?> </h5></div>
    
    <form method="POST">
        
       <?php
            if(mysqli_num_rows($data3) > 0) {
                $row3 = mysqli_fetch_assoc($data3);
        ?>
        
        <input type="submit" value="Remove from read Later" name="rm-readl" />
        <?php
            } else {
        ?>
        <input type="submit" value="Read Later" name="readl" />
        <?php 
        }
        ?>
        

        
    </form>
    
    </article>
</main>