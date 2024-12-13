<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

$ten = "";
if (isset($_POST["act"])) {
	$nhomsp = $_POST["nhomsp"];
	$ten = $_POST["ten"];

	// Sử dụng prepared statement và binding parameters để chèn dữ liệu vào câu lệnh SQL
	$stmt = $conn->prepare("SELECT COUNT(*) FROM loaisanpham WHERE tenloaisp=?");
	$stmt->bind_param("s", $ten);
	$stmt->execute();
	$stmt->bind_result($n);
	$stmt->fetch();
	$stmt->close();

	if ($n != 0) {
		echo "<script>alert('Lỗi!! Loại sản phẩm này đã có trong cơ sở dữ liệu!');window.history.go(-1);</script>";
	} else {
		$stmt = $conn->prepare("INSERT INTO loaisanpham(id_loai, id_nhom, tenloaisp) VALUES (?, ?, ?)");
		$stmt->bind_param("iss", $id, $nhomsp, $ten);
		$id = getidl(); // Chắc chắn rằng hàm getidl được định nghĩa ở đâu đó
		$stmt->execute();

		if ($stmt->affected_rows > 0) {
			echo "<script>alert('Đã thêm');window.location='../admincp/ql-nhom-loai.php?m=mn&b=loaisp-list'</script>";
			$ten = "";
		} else {
			echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
		}
		$stmt->close();
	}
}
?>

<?php include("check-login.php") ?>
<?php
include("connect.php");

function print_option($conn, $sql)
{
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error: " . mysqli_error($conn);
		return;
	}

	while ($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row[0] . "'> >> " . $row[1] . "</option>";
	}

	mysqli_free_result($result);
}
?>

<table width="735" border="0" cellspacing="0" cellpadding="0">
	<form method="POST" onsubmit="return loaisp_insert(nhomsp.value,ten.value);" id="form" name="form">
		<tr>
			<td colspan="2" class="tieude" align="center">THÊM LOẠI SẢN PHẨM</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td width="250" style="padding-left:80px" height="30">Nhóm sản phẩm:</td>
			<td width="485">
				<select name="nhomsp" style="width:240px;">
					<option value="chonmenu">Chọn nhóm sản phẩm...</option>
					<?php
					$query = "select id_nhom, tennhom from nhomsanpham";
					$result = mysqli_query($conn, $query);
					if (!$result) {
						echo "Error: " . mysqli_error($conn);
						return;
					}

					while ($row = mysqli_fetch_array($result)) {
						echo "<option value='" . $row[0] . "'> >> " . $row[1] . "</option>";
					}

					?>
				</select>
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td width="250" style="padding-left:80px" height="30">Tên loại sản phẩm:</td>
			<td width="485">
				<input type="text" name="ten" style="width:240px" value="<?php echo "$ten"; ?>" />
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2" height="35">
				<input name="" type="submit" value="Thêm" class="button"
					onmouseover="style.background='url(../images/button-2-o.gif)'"
					onmouseout="style.background='url(../images/button-o.gif)'">
				<input name="" type="reset" value="Xóa trắng" class="button"
					onmouseover="style.background='url(../images/button-2-o.gif)'"
					onmouseout="style.background='url(../images/button-o.gif)'">
			</td>
		</tr>
		<input type="hidden" name="act">
	</form>
</table>