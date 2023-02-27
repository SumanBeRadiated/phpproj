<?php 
    $user_c = $_COOKIE["cur_user"];
    $user_query = "SELECT * FROM tbl_user WHERE id = $user_c";

    $data = mysqli_query($link, $user_query);

    $row = mysqli_fetch_assoc($data);

?>

<table>
    <tr><th>Email: </th><td><?php echo $row["email"] ?></td></tr>
    <tr><th>Username: </th><td><?php echo $row["username"] ?></td></tr>
</table>