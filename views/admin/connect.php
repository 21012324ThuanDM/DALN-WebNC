<?php
$HOST = "localhost";
$USER = "root";
$PASS = "";
$DB = "shop";
// Các thông báo lỗi
$ERROR1 = "Loi mysql";
$ERROR2 = "Loi DB";

// Kết nối đến cơ sở dữ liệu sử dụng MySQLi
$conn = new mysqli($HOST, $USER, $PASS, $DB);

// Kiểm tra kết nối
if ($conn->connect_error) {
	die($ERROR1);
}

// Đặt kết nối với bảng mã UTF-8 để hỗ trợ tiếng Việt có dấu
$conn->set_charset("utf8");
?>