<?php
if (isset($_POST["act"])) {
	if (isset($_POST["giaiquyet"])) {
		$user = $_POST["user"];
		$soluong = $_POST["soluong"];
		$chon = $_POST["chon"];
		$count = count($chon);
		if ($count == 0)
			echo "<script>alert('Chưa chọn sản phẩm để giải quyết');</script>";
		else {
			for ($i = 0; $i < $count; $i++) {
				$sql4 = "UPDATE giohang SET tinhtrang='damua' WHERE id=? AND user=? AND tinhtrang='dathang'";
				$stmt4 = mysqli_prepare($conn, $sql4);
				mysqli_stmt_bind_param($stmt4, "ss", $chon[$i], $user[$i]);
				mysqli_stmt_execute($stmt4);

				$sql5 = "SELECT * FROM sanpham WHERE id=?";
				$stmt5 = mysqli_prepare($conn, $sql5);
				mysqli_stmt_bind_param($stmt5, "s", $chon[$i]);
				mysqli_stmt_execute($stmt5);
				$result5 = mysqli_stmt_get_result($stmt5);

				while ($r5 = mysqli_fetch_array($result5)) {
					$sl5 = $r5["soluongban"];
					$sum[$i] = $sl5 + $soluong[$i];

					$sql6 = "UPDATE sanpham SET soluongban=? WHERE id=?";
					$stmt6 = mysqli_prepare($conn, $sql6);
					mysqli_stmt_bind_param($stmt6, "is", $sum[$i], $chon[$i]);
					mysqli_stmt_execute($stmt6);
				}
			}
		}
	}
	if (isset($_POST["xoa"])) {
		$chon = $_POST["chon"];
		$count = count($chon);
		$user = $_POST["user"];
		if ($count == 0) {
			echo "<script>alert('Chưa chọn sản phẩm để xóa');</script>";
		} else {
			for ($j = 0; $j < $count; $j++) {
				$SQL_xoagiohang = "DELETE FROM giohang WHERE user='" . $user[$j] . "' and id='" . $chon[$j] . "' and tinhtrang='dathang'";
				//	echo "$SQL_xoagiohang";
				$kq_xoagiohang = mysqli_query($conn, $SQL_xoagiohang);
				$n += mysqli_affected_rows($conn);
			}
		}
	}
}
//*******************************end- process *************************************
?>

<table width="735" border="0" cellspacing="0" cellpadding="0">
	<form method="post">
		<tr>
			<td colspan="7" class="tieude" align="center">DANH SÁCH ĐƠN HÀNG CHỜ GIẢI QUYẾT</td>
		</tr>
		<tr height="30" bgcolor="#ffcc99">
			<td align="center" width="50" style="border-left:1px solid #333;border-right:1px solid #333; background-color: rgb(41, 198, 255)">
				<strong>Chọn</strong>
			</td>
			<td align="center" width="150" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Ngày đặt</strong></td>
			<td align="center" width="140" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Khách Hàng</strong></td>
			<td align="center" width="145" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Tên sản phẩm</strong></td>
			<td align="center" width="100" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Số lượng </strong></td>
			<td align="center" width="150" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Hình ảnh</strong></td>
		</tr>
		<?php
		$kq2 = mysqli_query($conn, "SELECT COUNT(*) FROM giohang INNER JOIN sanpham ON giohang.id = sanpham.id INNER JOIN thanhvien ON thanhvien.user = giohang.user WHERE giohang.tinhtrang = 'dathang'");
		$r2 = mysqli_fetch_array($kq2);
		$numrow = $r2[0];
		//số record cho 1 trang
		$pagesize = 20;
		//Tính tổng số trang
		$pagecount = ceil($numrow / $pagesize);
		//Xác định số trang cho mỗi lần hiển thị
		$segsize = 5;
		//Thiết lập trang hiện hành
		if (!isset($_GET["page"]))
			$curpage = 1;
		else
			$curpage = $_GET["page"];
		if ($curpage < 1)
			$curpage = 1;
		if ($curpage > $pagecount)
			$curpage = $pagecount;
		//Xác định số phân đoạn của trang
		$numseg = ($pagecount % $segsize == 0) ? ($pagecount / $segsize) : (int) ($pagecount / $segsize + 1);
		//Xác định phân đoạn hiện hành của trang
		$curseg = ($curpage % $segsize == 0) ? ($curpage / $segsize) : (int) ($curpage / $segsize + 1);
		$k = ($curpage - 1) * $pagesize;

		//******************************** Nội Dung *********************************//  
		
		$sql = "select * from giohang,sanpham,thanhvien where thanhvien.user=giohang.user AND giohang.id=sanpham.id and giohang.tinhtrang='dathang' order by ngaydat DESC limit $k,$pagesize";
		$kq = mysqli_query($conn, $sql);
		if (!$kq) {
			echo "";
		} else {
			while ($r = mysqli_fetch_array($kq)) {
				$id = $r["id"];
				$user = $r["user"];
				$id_giohang = $r["id_giohang"];
				$hinhanh = $r["hinh"];
				$hoten = $r["hoten"];
				$tensp = $r["tensp"];
				$gia = $r["gia"];
				$gia2 = number_format($gia, 0, '', '.');
				$soluong = $r["soluong"];
				$ngaydat = ConvertDate_time_db($r["ngaydat"]);
				$diachi = $r["diachi"];
				$email = $r["email"];
				$dt = $r["dienthoai"];
				$str_dt = strlen($dt);
				if ($str_dt == 9)
					$t = "0" . $dt;
				else
					$t = "" . $dt;
				?>
				<tr height="30">
					<td align="center" width="50"
						style="border-left:1px solid #333;border-right:1px solid #333;border-bottom:1px solid #333;">
						<strong><input type="checkbox" name="chon[]" value="<?php echo "$id"; ?>"></strong>
					</td>
					<td align="center" width="150" style="border-right:1px solid #333; border-bottom:1px solid #333;">
						<strong></strong>
						<?php echo "$ngaydat"; ?></strong>
					</td>
					<td align="center" width="140" style="border-right:1px solid #333; border-bottom:1px solid #333;"><strong><a
								onmouseover="Tip('<?php echo "Họ tên: $hoten<hr>Địa chỉ: $diachi<hr>Email: $email<hr>Điện thoại: $t"; ?>')">
								<?php echo "$hoten"; ?>
							</a></strong></td>
					<td align="center" width="145" style="border-right:1px solid #333; border-bottom:1px solid #333;"><strong>
							<?php echo "$tensp"; ?>
						</strong></td>
					<td align="center" width="100" style="border-right:1px solid #333; border-bottom:1px solid #333;"><strong>
							<?php echo "$soluong"; ?>
						</strong></td>
					<td align="center" width="150" style="border-right:1px solid #333; border-bottom:1px solid #333;">
						<strong><img src="../sanpham/small/<?php echo "$hinhanh"; ?>" width="90" height="90"><br />
							<?php echo "$gia2 VND"; ?>
						</strong>
					</td>
				</tr>
				<input type="hidden" name="user[]" value="<?php echo "$user"; ?>">
				<input type="hidden" name="soluong[]" value="<?php echo "$soluong"; ?>">
				<input type="hidden" name="act">

				<?php
			}
		}
		?>
		<tr>
			<td class="ketthuc" colspan="7">
				<?php
				if ($numrow == 0)
					echo "Hiện tại không có đơn đặt hàng nào!";
				else {
					?>
					<table width="735" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center">

								<input type="submit" name="giaiquyet" value="Giải Quyết" class="button"
									onmouseover="style.background='url(../images/button-2-o.gif)'"
									onmouseout="style.background='url(../images/button-o.gif)'"
									onclick="document.form.submit();">
								<input type="submit" name="xoa" value="Xóa" class="button"
									onmouseover="style.background='url(../images/button-2-o.gif)'"
									onmouseout="style.background='url(../images/button-o.gif)'"
									onclick="return check()"><br />
							<td width="400" align="right">

								<?php
								if ($curseg > 1)
									echo "<a href='?m=dh&b=gh-list&page=" . (($curseg - 1) * $segsize) . "'><b>Previous</b></a> &nbsp;";
								$n = $curseg * $segsize <= $pagecount ? $curseg * $segsize : $pagecount;
								for ($i = ($curseg - 1) * $segsize + 1; $i <= $n; $i++) {
									if ($curpage == $i)
										echo "<a href='?m=dh&b=gh-list&page=" . $i . "'><font color='#FF0000'>[" . $i . "]</font></a> &nbsp;";
									else
										echo "<a href='?m=dh&b=gh-list&page=" . $i . "'><font color='#FFF'>[" . $i . "]</font></a> &nbsp;";
								}
								if ($curseg < $numseg)
									echo "<a href='?m=dh&b=gh-list&page=" . (($curseg * $segsize) + 1) . "'><b>Next</b></a> &nbsp;";
				}
				?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</form>
</table>