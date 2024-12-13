<?php
$id = $_GET["id"];
$sql2 = "select * from sanpham where id='$id'";
//echo "$sql2<hr>";
$kq2 = mysqli_query($conn, $sql2);
$r2 = mysqli_fetch_array($kq2);
$hinh = $r2["hinh"];
$tensp = $r2["tensp"];
//	echo "$hinh<hr>";
unlink("../sanpham/large/$hinh");
unlink("../sanpham/small/$hinh");

$sql = "delete from sanpham where id='$id'";
$kq = mysqli_query($conn, $sql);
if (!$kq)
	echo "<script>alert('Có lỗi trong khi xóa!!!');window.location='../admincp/?b=sp-list';</script>";
else {
	$n = mysqli_affected_rows($conn);
	echo "<script>alert('Đã xóa sản phẩm $tensp & hình ảnh của sản phẩm đó'); window.history.go(-1);</script>";
}
?>