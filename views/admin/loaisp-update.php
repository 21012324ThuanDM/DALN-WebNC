<?php
$ten = "";
if (isset($_POST["act"])) {
	include "connect.php"; // Kết nối đến cơ sở dữ liệu

	$ten = $_POST["ten"];
	$idl = $_POST["idl"];
	$nhomsp = $_POST["nhomsp"];

	// Sử dụng prepared statement để tránh SQL injection
	$sql = "UPDATE loaisanpham SET id_nhom=?, tenloaisp=? WHERE id_loai=?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "isi", $nhomsp, $ten, $idl);
	$kq = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	if (!$kq) {
		echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
	} else {
		echo "<script>alert('Đã sửa');window.location='../admincp/ql-nhom-loai.php?m=mn&b=loaisp-list'</script>";
		$ten = "";
	}
}
?>
<?php
function Getnhomsp($idn)
{
	include "connect.php"; // Kết nối đến cơ sở dữ liệu

	$sql2 = "SELECT * FROM nhomsanpham ORDER BY id_nhom ASC";
	$kq2 = mysqli_query($conn, $sql2);
	$s2 = "";
	if ($kq2) {
		while ($r2 = mysqli_fetch_array($kq2)) {
			if ($r2["id_nhom"] == $idn) {
				$s2 .= "<option value='" . $r2["id_nhom"] . "' selected>";
			} else {
				$s2 .= "<option value='" . $r2["id_nhom"] . "'>";
			}
			$s2 .= $r2["tennhom"] . "</option>";
		}
		mysqli_free_result($kq2); // Giải phóng bộ nhớ sau khi sử dụng kết quả
	} else {
		// Xử lý lỗi nếu có
		echo "Lỗi: " . mysqli_error($conn);
	}
	return $s2;
}
?>
<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

$idl = $_GET["idl"];
$sql = mysqli_query($conn, "SELECT nhomsanpham.*, loaisanpham.* FROM nhomsanpham, loaisanpham WHERE nhomsanpham.id_nhom=loaisanpham.id_nhom AND loaisanpham.id_loai=$idl");
if ($sql) {
	$r = mysqli_fetch_array($sql);
	$ten = $r["tenloaisp"];
	$idn = $r["id_nhom"];
} else {
	// Xử lý lỗi nếu có
	echo "Lỗi: " . mysqli_error($conn);
}
?>
<table width="735" border="0" cellspacing="0" cellpadding="0">
	<form method="POST">
		<tr>
			<td colspan="2" class="tieude" align="center">SỬA LOẠI SẢN PHẨM</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td width="250" style="padding-left:80px" height="30">Nhóm sản phẩm:</td>
			<td width="485">
				<select name="nhomsp" style="width:240px;">
					<option value="chonmenu">-- Chọn nhóm sản phẩm --</option>
					<?php
					include("connect.php");
					echo Getnhomsp($idn);
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
				<input name="" type="submit" value="Sửa" class="button"
					onmouseover="style.background='url(../images/button-2-o.gif)'"
					onmouseout="style.background='url(../images/button-o.gif)'">
				<input name="" type="reset" value="Xóa trắng" class="button"
					onmouseover="style.background='url(../images/button-2-o.gif)'"
					onmouseout="style.background='url(../images/button-o.gif)'">
			</td>
		</tr>
		<input type="hidden" name="act">
		<input type="hidden" name="idl" value="<?php echo "$idl"; ?>" />
	</form>
</table>