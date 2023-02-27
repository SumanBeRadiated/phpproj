<?php
    $user_c = $_COOKIE["cur_user"];
    $rl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c";
    
    $data = mysqli_query($link, $rl_query);
    
    $rl = [];
    while($row = mysqli_fetch_assoc($data)) {
        array_push($rl, $row["article"]);
    }

    $rl = implode(", ", $rl);
    

    $article_query = "SELECT * FROM tbl_article WHERE id IN ($rl)";
    $data2 = mysqli_query($link, $article_query);
    while($row2 = mysqli_fetch_assoc($data2)) {
        $id = $row2["id"];
        $title = $row2["title"];
        $content = $row2["content"];
        $pub_date = $row2["pub_date"];
        echo "<li>";
        echo "<div class='th-art-title'><a href='/mp/NewsApp/public_html/article.php?id=$id'>$title</a></div>
            <div class='th-art-content'> $content</div>
            <div class='th-art-date'>$pub_date</div>";
        echo "</li>";
    }


?>