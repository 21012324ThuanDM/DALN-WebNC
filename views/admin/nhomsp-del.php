<?php
include("connect.php");
$idn = $_GET["idn"];
$check = mysqli_query($conn, "select count(*) from loaisanpham where id_nhom='$idn'");
$r = mysqli_fetch_array($check);
$n = $r[0];
if ($n != 0)
	echo "<script>alert('Không thể xóa!! vì có loại sản phẩm thuộc nhóm sản phẩm này');window.location='../admincp/?m=mn&b=nhomsp-list';</script>";
else {
	$sql = "delete from nhomsanpham where id_nhom='$idn'";
	$kq = mysqli_query($conn, $sql);
	if (!$kq)
		echo "<script>alert('Có lỗi trong khi xóa!!!');window.location='../admincp/ql-nhom-loai.php?m=mn&b=nhomsp-list';</script>";
	else {
		$n = mysqli_affected_rows($conn);
		echo "<script>alert('Đã xóa');window.location='../admincp/ql-nhom-loai.php?m=mn&b=nhomsp-list';</script>";
	}
}
?>