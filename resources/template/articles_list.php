<?php

    $query_article = "SELECT * FROM tbl_article";

    $articles = mysqli_query($link, $query_article);
    

    echo "<ul>";
    while($data = mysqli_fetch_assoc($articles)) {
        $id = $data["id"];
        $title = $data["title"];
        $content = $data["content"];
        $pub_date = $data["pub_date"];
        echo "<li>";
        echo "<div class='th-art-title'><a href='/mp/NewsApp/public_html/article.php?id=$id'>$title</a></div>
    <div class='th-art-content'> $content</div>
    <div class='th-art-date'>$pub_date</div>";
        echo "</li>";
    }
    echo "</ul>";


?>


