<?php
if (isset($_COOKIE["cur_user"])) {
    $user_c = $_COOKIE["cur_user"];
}

$rl_query = "SELECT * FROM tbl_read_later WHERE user = $user_c";

$data = mysqli_query($link, $rl_query);

$rl = [];
while ($row = mysqli_fetch_assoc($data)) {
    array_push($rl, $row["article"]);
}
if (count($rl) > 0) {

    $rl = implode(", ", $rl);

    $article_query = "SELECT * FROM tbl_article WHERE id IN ($rl)";
    $data2 = mysqli_query($link, $article_query);
    ?>

        <div class="container readl">
        <h2>Read Later</h2>
        <ul class="readl-list flex">
<?php while ($row2 = mysqli_fetch_assoc($data2)) {

    $id = $row2["id"];
    $title = $row2["title"];
    $content = $row2["content"];
    $pub_date = $row2["pub_date"];
    echo "<a href='/mp/NewsApp/public_html/article.php?id=$id'>"
    ?>
        
        <li class="flex">
           
    
            
                <h3 class='th-art-title'><?php echo $title; ?></h3>
         
        
            <div class='th-art-content'><?php echo substr($content,0,200)."..."; ?></div>
            <div class='th-art-date'><?php echo $pub_date; ?></div>
        </li>
    </a>
    <?php } ?>
    </ul>
    </div>
    <?php
    

} else {
    echo "<div class='container'>Empty</div>";
}
?>

    
