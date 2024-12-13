<?php
$idl = $_GET["idl"];

$check = mysqli_query($conn, "SELECT COUNT(*) FROM sanpham WHERE id_loai='$idl'");
$r = mysqli_fetch_array($check);
$n = $r[0];

if ($n != 0) {
	echo "<script>alert('Không thể xóa!! vì có sản phẩm thuộc loại này');window.location='../admincp/?m=mn&b=loaisp-list';</script>";
} else {
	$sql = "DELETE FROM loaisanpham WHERE id_loai='$idl'";
	$kq = mysqli_query($conn, $sql);

	if (!$kq) {
		echo "<script>alert('Có lỗi trong khi xóa!!!');window.location='../admincp/ql-nhom-loai.php?m=mn&b=loaisp-list';</script>";
	} else {
		$n = mysqli_affected_rows($conn);
		echo "<script>alert('Đã xóa');window.location='../admincp/ql-nhom-loai.php?m=mn&b=loaisp-list';</script>";
	}
}
?>