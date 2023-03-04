<?php

    $query_article = "SELECT * FROM tbl_article";

    $articles = mysqli_query($link, $query_article);
    
    ?>

    <div class="latest-section container">

    
    <ul class="ls-news flex">
        <?php   

            while($data = mysqli_fetch_assoc($articles)) {
                $id = $data["id"];
                $title = $data["title"];
                $content = $data["content"];
                $pub_date = $data["pub_date"];
        
        ?>
        <?php echo "<a href='/mp/NewsApp/public_html/article.php?id=$id'>" ?>
        
        <li class="flex">
            <h3><?php echo $title; ?></h3>
            <div class='th-art-date'><?php echo $pub_date; ?></div>
            <div class='th-art-content'><?php echo substr($content, 0, 200)."..."; ?></div>
            <hr>
        </li>
        </a>
        
    
        <?php } ?>

    </ul>
    </div>





