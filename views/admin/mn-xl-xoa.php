<?php include("check-login.php") ?>
<?php
include "connect.php";
//$ma = implode($_POST["mcm"], ", ");
$macm = $_POST["chon"];
$count_cm = count($macm);
if ($count_cm == 0)
	echo "<script>alert('Chưa chọn menu cần xóa!!!');window.location='../admincp/?m=mn&b=mn-list';</script>";
else {
	for ($i = 0; $i < $count_cm; $i++) {
		$sql = "select sanpham.*,menu.* from menu,sanpham where menu.id_menu=sanpham.id_menu AND sanpham.id_menu=$macm[$i]";
		$kq = mysqli_query($conn, $sql);
		$numrow = mysqli_num_rows($kq);
		$r = mysqli_fetch_array($kq);
		$tencm = $r["tenmenu"];
		if ($numrow != 0) {
			$s[$i] = $tencm;
		} else {
			$sql2 = "select * from menu where id_menu=$macm[$i]";
			$kq2 = mysqli_query($conn, $sql2);
			$r2 = mysqli_fetch_array($kq2);
			$xoatencm = $r2["tenmenu"];
			$xoa_tencm[$i] = $xoatencm;
			$sql3 = "Delete from menu where id_menu=$macm[$i]";
			$kq3 = mysqli_query($conn, $sql3);
			if (!$kq3)
				echo "<script>alert('Có lỗi trong khi xóa!!!');window.history.go(-1);</script>";
			else {
				$n += mysqli_affected_rows($conn);
			}
		}
	}//end for

	if ($n == 0) {
		$ss = implode($s, ", ");
		echo "<script>alert('Không thể xóa menu: $ss! vì có các sản phẩm thuộc menu này');window.location='../admincp/?m=mn&b=mn-list';</script>";
	} else {
		if (isset($s))
			$ss = implode($s, ", ");
		if ($ss == "") {
			$xoa = implode($xoa_tencm, ", ");
			echo "<script>alert('Đã xóa menu: $xoa!');window.location='../admincp/?m=mn&b=mn-list';</script>";
		} else {
			$xoa = implode($xoa_tencm, ", ");
			echo "<script>alert('Không thể xóa menu: $ss! Đã xóa menu: \"$xoa\"!');window.location='../admincp/?m=mn&b=mn-list';</script>";
		}
	}

}

?>