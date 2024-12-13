<?php
$HOST = "localhost";
$USER = "root";
$PASS = "";
$DB = "shop";
$ERROR1 = "Loi mysql";
$ERROR2 = "Loi DB";
$conn = mysqli_connect($HOST, $USER, $PASS, $DB) or die($ERROR1);
mysqli_set_charset($conn, 'utf8');
?>