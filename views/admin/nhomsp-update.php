<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

$ten = "";
if (isset($_POST["act"])) {
	$ten = $_POST["ten"];
	$idn = $_POST["idn"];

	$check = mysqli_query($conn, "SELECT COUNT(*) FROM nhomsanpham WHERE tennhom='$ten'");
	$r = mysqli_fetch_array($check);
	$n = $r[0];

	if ($n != 0) {
		echo "<script>alert('Lỗi!! Nhóm sản phẩm này đã có trong cơ sở dữ liệu!');window.history.go(-1);</script>";
	} else {
		$sql = "UPDATE nhomsanpham SET tennhom='$ten' WHERE id_nhom='$idn'";
		$kq = mysqli_query($conn, $sql);

		if (!$kq) {
			echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
		} else {
			echo "<script>alert('Đã sửa');window.location='../admincp/ql-nhom-loai.php?m=mn&b=nhomsp-list'</script>";
			$ten = "";
		}
	}
}
?>

<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

$idn = $_GET["idn"];
$sql = mysqli_query($conn, "SELECT * FROM nhomsanpham WHERE id_nhom=$idn");
$r = mysqli_fetch_array($sql);
$ten = $r["tennhom"];
?>

<table width="735" border="0" cellspacing="0" cellpadding="0">
	<form method="POST">
		<tr>
			<td colspan="2" class="tieude" align="center">SỬA NHÓM SẢN PHẨM</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td width="250" style="padding-left:80px" height="30">Tên nhóm sản phẩm:</td>
			<td width="485">
				<input type="text" name="ten" style="width:240px" value="<?php echo "$ten"; ?>" />
			</td>
		</tr>
		<tr>
			<td  align="center" colspan="2" height="35">
				<input name="" type="submit" value="Sửa" class="button"
					onmouseover="style.background='url(../images/button-2-o.gif)'"
					onmouseout="style.background='url(../images/button-o.gif)'">
				<input name="" type="reset" value="Xóa trắng" class="button"
					onmouseover="style.background='url(../images/button-2-o.gif)'"
					onmouseout="style.background='url(../images/button-o.gif)'">
			</td>
		</tr>
		<input type="hidden" name="act">
		<input type="hidden" name="idn" value="<?php echo "$idn"; ?>" />
	</form>
</table>