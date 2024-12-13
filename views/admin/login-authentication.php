<?php
include("connect.php");

if (!isset($_POST["user"])) {
	echo "<script>alert('Bạn chưa nhập tên đăng nhập');window.history.go(-1);</script>";
} else {
	$user = $_POST["user"];
	if (!isset($_POST["pass"])) {
		echo "<script>alert('Bạn chưa nhập mật khẩu');window.history.go(-1);</script>";
	} else {
		$pass = $_POST["pass"];
		$sql = "SELECT * FROM thanhvien WHERE user='$user' AND pass='$pass'";
		$kq = mysqli_query($conn, $sql);
		$thanhvien = mysqli_fetch_array($kq);
		$hieuluc = $thanhvien["hieuluc"];
		$n = mysqli_num_rows($kq);
		if ($n == 0) {
			echo "<script>alert('Thông tin bạn nhập không chính xác!');window.history.go(-1);</script>";
		} else {
			if ($hieuluc == 1) {
				if (!isset($_SESSION)) {
					session_start();
				}
				$_SESSION["useradmin"] = $user;
				$_SESSION["success"] = true;
				$_SESSION['hotenadmin'] = $thanhvien['hoten'];
				$_SESSION["hieuluc"] = $thanhvien["hieuluc"];
				$_SESSION['capquyen'] = $thanhvien["capquyen"];
				header("location:home.php");
				exit(); // Đảm bảo kết thúc kịch bản sau khi chuyển hướng
			} else {
				echo "<script>alert('Bạn không có quyền truy cập!');window.location='login.php'</script>";
			}
		}
	}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />