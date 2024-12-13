<?php
// Kiểm tra xem có dữ liệu được gửi từ form không
if (isset($_POST["chon"])) {
	$ma = $_POST["chon"];
	$count = count($ma);
	// Kiểm tra xem có sản phẩm nào được chọn không
	if ($count == 0) {
		echo "<script>alert('Chưa chọn sản phẩm cần xóa!!!');window.history.go(-1);</script>";
	} else {
		// Kết nối CSDL
		$conn = mysqli_connect("localhost", "username", "password", "database_name");
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$n = 0; // Biến đếm số sản phẩm đã xóa
		// Lặp qua các sản phẩm được chọn để xóa
		for ($i = 0; $i < $count; $i++) {
			$id = $ma[$i];
			$sql3 = "DELETE FROM sanpham WHERE id='$id'";
			$kq3 = mysqli_query($conn, $sql3);
			if (!$kq3) {
				echo "<script>alert('Có lỗi trong khi xóa!!!');</script>";
			} else {
				$n += mysqli_affected_rows($conn);
			}
		}
		// Đóng kết nối CSDL
		mysqli_close($conn);
		echo "<script>alert('Đã xóa $n sản phẩm!');window.location='../admincp/?m=sp&b=sp-list';</script>";
	}
} else {
	echo "<script>alert('Không có dữ liệu được gửi từ form!');window.history.go(-1);</script>";
}
?>