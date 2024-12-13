<?php
$q = $_GET["q"];
include "../connect.php";
$sql = "SELECT * FROM loaisanpham WHERE id_nhom = '" . $q . "'";
$result = mysqli_query($conn, $sql);
echo "<select name=\"loaisp\" style=\"width:240px;\">
	  <option value=\"chonlsp\">-- Chọn loại sản phẩm --</option>";
while ($row = mysqli_fetch_array($result)) {
	$id_loai_a = $row["id_loai"];
	$tenloai = $row["tenloaisp"];
	echo "<option value=$id_loai_a>$tenloai</option>";
}
echo "</select>";
?>