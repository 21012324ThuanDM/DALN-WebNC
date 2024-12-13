<?php
include "../connect.php";
$idn = $_GET["idn"];
$sql = "SELECT * FROM loaisanpham WHERE id_nhom='$idn' ";
$result = mysqli_query($conn, $sql);
$s = "";
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>';
echo "<data>";
while ($r = mysqli_fetch_array($result)) {
	echo "<value>" . $r["id_loai"] . "</value>";
	echo "<text>" . $r["tenloaisp"] . "</text> ";
}
echo "</data>";
?>