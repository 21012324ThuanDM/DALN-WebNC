<?php
if (isset($_POST["act"])) {
	$id = $_POST["id"];
	$loaisp = $_POST["loaisp"];
	$menu = $_POST["menu"];
	$tensp = $_POST["tensp"];
	$mota = $_POST['mota'];
	$gia = $_POST["gia"];
	$ghichu = $_POST["ghichu"];
	$kd = khongdau2($_POST["tensp"]);
	$id2 = md5($kd);
	//	echo "$id - $id2";
	$file_name = $_FILES["hinh"]["name"];
	$file_type = $_FILES["hinh"]["type"];
	$file_size = $_FILES["hinh"]["size"];
	$name = $_POST["oldimage"];
	$imgInfo = explode('.', $name);
	$new = $kd . "." . $imgInfo[1];
	//	echo "$name - $new<hr>";
	if ($file_name == "" && $file_type == "" && $file_size == 0) {
		if ($id2 != $id) {
			$sql5 = "UPDATE sanpham SET id='$id2', id_loai='$loaisp', tensp='$tensp', mota='$mota', gia='$gia', ghichu='$ghichu', hinh='$new', id_menu='$menu' WHERE id='$id'";
			$kq5 = mysqli_query($conn, $sql5);
			$q = mysqli_query($conn, "UPDATE giohang SET id='$id2' WHERE id='$id'");
			$q2 = mysqli_query($conn, "UPDATE hoadon SET id='$id2' WHERE id='$id'");
			// echo "$sql5<hr>";   
			if (!$kq5) {
				echo "<script>alert('Lỗi! Sản phẩm này đã có');window.history.go(-1);</script>";
			} else {
				rename("../sanpham/large/$name", "../sanpham/large/$new");
				rename("../sanpham/small/$name", "../sanpham/small/$new");
				$n5 = mysqli_affected_rows($conn);
				echo "<script>alert('Đã sửa');window.history.go(-2);</script>";
			}
		} else {
			$sql3 = "UPDATE sanpham SET id='$id2', id_loai='$loaisp', tensp='$tensp', mota='$mota', gia='$gia', ghichu='$ghichu', id_menu='$menu' WHERE id='$id'";
			$kq3 = mysqli_query($conn, $sql3);
			if (!$kq3) {
				echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý!!');window.history.go(-1);</script>";
			} else {
				$n3 = mysqli_affected_rows($conn);
				echo "<script>alert('Đã sửa $n3 sản phẩm');window.history.go(-2);</script>";
			}
		}

	} else {
		$tmp_name = $_FILES['hinh']['tmp_name'];
		$dirToUpload = "../sanpham/large/";
		$imageInfo = pathinfo($_FILES['hinh']['name']); // Lấy thông tin về file hình ảnh
		$newName = $kd . "." . $imageInfo['extension']; // Tạo tên mới cho file hình ảnh
		unlink("../sanpham/large/$name");
		unlink("../sanpham/small/$name");

		// Tạo hình ảnh mới từ file tạm
		switch ($imageInfo['extension']) {
			case "jpg":
			case "jpeg":
				$src = imagecreatefromjpeg($tmp_name);
				break;

			case "gif":
				$src = imagecreatefromgif($tmp_name);
				break;

			case "png":
				$src = imagecreatefrompng($tmp_name);
				break;

			default:
				echo "<script>alert('Định dạng hình ảnh không được hỗ trợ!');window.history.go(-1);</script>";
				exit; // Thoát khỏi script nếu định dạng hình ảnh không được hỗ trợ
		}

		// Tạo hình mới có kích thước 170x170
		$newwidth = 170;
		$newheight = 170;
		$tmp = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, imagesx($src), imagesy($src));

		// Lưu hình ảnh mới vào thư mục
		$pathfile = $dirToUpload . $newName;
		$pathfull = "../sanpham/small/" . $newName;
		imagejpeg($tmp, $pathfile, 100);
		imagejpeg($tmp, $pathfull, 100); // Lưu hình ảnh resized vào thư mục small

		// Giải phóng bộ nhớ
		imagedestroy($src);
		imagedestroy($tmp);

		// Update thông tin sản phẩm trong cơ sở dữ liệu
		$sql4 = "UPDATE sanpham SET id='$id2', id_loai='$loaisp', tensp='$tensp', mota='$mota',hinh='$newName', gia='$gia',ghichu='$ghichu',id_menu='$menu' WHERE id='$id'";
		$kq4 = mysqli_query($conn, $sql4);
		if (!$kq4) {
			echo "<script>alert('Lỗi! sản phẩm này đã có trong cơ sở dữ liệu!');window.history.go(-1);</script>";
		} else {
			$n4 = mysqli_affected_rows($conn);
			echo "<script>alert('Đã sửa');window.history.go(-2);</script>";
		}
	}

}
//******************************* end -  xu ly ************************************
?>

<?php
function Getloaisp($idl, $conn)
{
	$sql2 = "SELECT * FROM loaisanpham ORDER BY id_nhom ASC";
	$kq2 = mysqli_query($conn, $sql2);
	$s2 = "";
	if ($kq2) {
		while ($r2 = mysqli_fetch_array($kq2)) {
			if ($r2["id_loai"] == $idl) {
				$s2 .= "<option value='" . $r2["id_loai"] . "' selected>";
			} else {
				$s2 .= "<option value='" . $r2["id_loai"] . "'>";
			}
			$s2 .= $r2["tenloaisp"] . "</option>";
		}
	} else {
		echo "Error: " . mysqli_error($conn);
	}
	return $s2;
}


function Getmenu($idm, $conn)
{
	$sql2 = "SELECT * FROM menu";
	$kq2 = mysqli_query($conn, $sql2);
	$s2 = "";
	if ($kq2) {
		while ($r2 = mysqli_fetch_array($kq2)) {
			if ($r2["id_menu"] == $idm) {
				$s2 .= "<option value='" . $r2["id_menu"] . "' selected>";
			} else {
				$s2 .= "<option value='" . $r2["id_menu"] . "'>";
			}
			$s2 .= $r2["tenmenu"] . "</option>";
		}
	} else {
		echo "Error: " . mysqli_error($conn);
	}
	return $s2;
}


function GetGhichu($id, $conn)
{
	$sql2 = "SELECT * FROM sanpham WHERE id='$id'";
	$kq2 = mysqli_query($conn, $sql2);
	$s2 = "";
	if ($kq2) {
		$r2 = mysqli_fetch_array($kq2);
		if ($r2["ghichu"] == "new") {
			$s2 .= "<option value='new' selected>";
			$s2 .= "Mặt hàng mới";
			$s2 .= "<option value='hienthi'>";
			$s2 .= "Hiển thị";
			$s2 .= "<option value='hangdat'>";
			$s2 .= "Hàng đặt";
			$s2 .= "</option>";
		} else {
			if ($r2["ghichu"] == "hienthi") {
				$s2 .= "<option value='new'>";
				$s2 .= "Mặt hàng mới";
				$s2 .= "<option value='hienthi' selected>";
				$s2 .= "Hiển thị";
				$s2 .= "<option value='hangdat'>";
				$s2 .= "Hàng đặt";
				$s2 .= "</option>";
			} else {
				$s2 .= "<option value='new'>";
				$s2 .= "Mặt hàng mới";
				$s2 .= "<option value='hienthi'>";
				$s2 .= "Hiển thị";
				$s2 .= "<option value='hangdat' selected>";
				$s2 .= "Hàng đặt";
				$s2 .= "</option>";
			}
		}
	} else {
		echo "Error: " . mysqli_error($conn);
	}
	return $s2;
}

?>
<?php
$id = $_GET["id"];
$conn = mysqli_connect("localhost", "username", "password", "database_name");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM sanpham WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
	echo "";
} else {
	$row = mysqli_fetch_array($result);
	$id_loai = $row["id_loai"];
	$id_nhom = $row["id_nhom"];
	$tensp = $row["tensp"];
	$mota = $row["mota"];
	$hinh = $row["hinh"];
	$gia = $row["gia"];
	$ghichu = $row["ghichu"];
	$id_menu = $row["id_menu"];
	?>
	<table width="740" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="2" class="tieude" align="center">UPDATE SẢN PHẨM</td>
		</tr>
		<form method="post" enctype="multipart/form-data">
			<tr bgcolor="#FFFFFF">
				<td width="200" style="padding-left:80px" height="30">Loại sản phẩm:</td>
				<td width="519">
					<?php
					if ($id_loai != 0) {
						echo "<select name=\"loaisp\" style=\"width:240px;\">";
						echo Getloaisp($id_loai, $conn);
						echo "</select>";
					} else {
						echo "<select name=\"menu\" style=\"width:240px;\">";
						echo Getmenu($id_menu, $conn);
						echo "</select>";
					}
					?>
				</td>
			</tr>
			<tr>
				<td style="padding-left:80px" height="30">Tên sản phẩm:</td>
				<td><input type="text" name="tensp" style="width:240px" value="<?php echo "$tensp"; ?>"></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td style="padding-left:80px" height="30">Mô tả:</td>
				<td><textarea name="mota" cols="27" rows="5" style="width:240px"><?php echo "$mota" ?></textarea> </td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td style="padding-left:80px" height="30">Hình ảnh:</td>
				<td height="80"> <input name="hinh" type="file" size="30">
					<img align="middle" src="/sanpham/small/<?php echo "$hinh"; ?>" width="80" height="80">
					<input type="hidden" name="oldimage" value="<?php echo "$hinh"; ?>">
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td style="padding-left:80px" height="30">Giá:</td>
				<td><input name="gia" type="text" maxlength="20" style="width:240px" value="<?php echo "$gia"; ?>"></td>
			</tr>
			<tr>
				<td style="padding-left:80px" height="30">Ghi chú:</td>
				<td>
					<select name="ghichu" style="width:240px">
						<?php echo GetGhichu($id, $conn); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="ketthuc" colspan="2" height="35">
					<input name="" type="submit" value="Update" class="button"
						onmouseover="style.background='url(../images/button-2-o.gif)'"
						onmouseout="style.background='url(../images/button-o.gif)'">
					<input name="" type="reset" value="Reset" class="button"
						onmouseover="style.background='url(../images/button-2-o.gif)'"
						onmouseout="style.background='url(../images/button-o.gif)'">
				</td>
			</tr>
			<input type="hidden" name="act">
			<input type="hidden" name="id" value="<?php echo "$id"; ?>" />
		</form>
	</table>
	<?php
}
?>