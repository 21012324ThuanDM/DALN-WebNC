<?php
include ("../../models/connect.php");


$user = $_POST["user"];
$pass = $_POST["pass"];

// Thực hiện truy vấn sử dụng MySQLi
$stmt = $conn->prepare("SELECT * FROM thanhvien WHERE user=? AND pass=?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();
$thanhvien = $result->fetch_assoc();
$hieuluc = $thanhvien["hieuluc"];
$n = $result->num_rows;

$stmt->close();

if ($n == 0) {
	echo "<script>alert('Thông tin bạn nhập không chính xác!');window.location='index.php';</script>";
} else {
	if ($hieuluc == 1) {
		session_start();
		$_SESSION["user"] = $user;
		$_SESSION["success"] = true;
		$_SESSION['hoten'] = $thanhvien['hoten'];
		$_SESSION["hieuluc"] = $thanhvien["hieuluc"];
		$_SESSION['capquyen'] = $thanhvien["capquyen"];
		header("location:index.php");
		exit();
	} else {
		echo "<script>alert('Bạn không có quyền truy cập!');window.location='index.php';</script>";
	}
}

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />