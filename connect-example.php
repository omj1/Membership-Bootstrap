<?php
$db = mysqli_connect('localhost', 'root', '', 'bcmembers');

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* change character set to utf8 */
if (!mysqli_set_charset($db, "utf8")) {
   // printf("Error loading character set utf8: %s\n", mysqli_error($db));
} else {
   // printf("Current character set: %s\n", mysqli_character_set_name($db));
}

//mysqli_close($link);
?>
