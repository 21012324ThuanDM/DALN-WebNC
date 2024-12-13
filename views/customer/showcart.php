<?php
if (isset($_POST["act"])) {
	if (isset($_POST["capnhatgiohang"])) {
		$id_form = $_POST["id_form"];
		$countid = count($id_form);
		$sl = $_POST["soluong"];
		$tong = $_POST["tong"];
		if (isset($_SESSION["user"])) {
			for ($i = 0; $i < $countid; $i++) {
				if ($sl[$i] <= 0) {
					$stmt_del = $conn->prepare("DELETE FROM giohang WHERE id = ? AND tinhtrang = 'themgiohang'");
					$stmt_del->bind_param("i", $id_form[$i]);
					$stmt_del->execute();
					$stmt_del->close();
				} else {
					$tt[$i] = $tong[$i] * $sl[$i];
					$stmt_update = $conn->prepare("UPDATE giohang SET soluong = ? WHERE user = ? AND id = ? AND tinhtrang = 'themgiohang'");
					$stmt_update->bind_param("isi", $sl[$i], $user, $id_form[$i]);
					$stmt_update->execute();
					$stmt_update->close();
				}
			}
		}
	}

	if (isset($_POST["xoagiohang"])) {
		$xoa = $_POST["xoa"];
		$xoacount = count($_POST["xoa"]);
		if ($xoacount == 0)
			echo "<script>alert('Chưa chọn sản phẩm cần xóa');</script>";
		else {
			for ($j = 0; $j < $xoacount; $j++) {
				$stmt_xoagiohang = $conn->prepare("DELETE FROM giohang WHERE user=? AND id=? AND tinhtrang='themgiohang'");
				$stmt_xoagiohang->bind_param("si", $user, $xoa[$j]);
				$stmt_xoagiohang->execute();
				$n += $stmt_xoagiohang->affected_rows;
				$stmt_xoagiohang->close();
			}
		}
	}

	if (isset($_POST["dathang"])) {
		$id_form = $_POST["id_form"];
		$countid = count($id_form);
		$now = date("Y-m-d H:i:s");
		$soluong = $_POST["soluong"];
		for ($k = 0; $k < $countid; $k++) {
			$sql_kt = "SELECT * FROM giohang WHERE id=? AND user=? AND tinhtrang='dathang'";
			$stmt_kt = $conn->prepare($sql_kt);
			$stmt_kt->bind_param("is", $id_form[$k], $user);
			$stmt_kt->execute();
			$result_kt = $stmt_kt->get_result();
			if ($result_kt->num_rows == 0) {
				$sql_dathang = "UPDATE giohang SET tinhtrang='dathang', ngaydat=? WHERE id=? AND user=? AND tinhtrang='themgiohang'";
				$stmt_dathang = $conn->prepare($sql_dathang);
				$stmt_dathang->bind_param("ssi", $now, $id_form[$k], $user);
				$stmt_dathang->execute();
				echo "<script>window.location='index.php?b=listcart';</script>";
				$stmt_dathang->close();
			} else {
				while ($r_kt = $result_kt->fetch_assoc()) {
					$sl_kt = $r_kt["soluong"];
					$stmt_del = $conn->prepare("DELETE FROM giohang WHERE user=? AND id=? AND tinhtrang='themgiohang'");
					$stmt_del->bind_param("si", $user, $id_form[$k]);
					$stmt_del->execute();
					$stmt_del->close();
					$soluong_moi = $sl_kt + $soluong[$k];
					$sql_dathang = "UPDATE giohang SET ngaydat=?, soluong=? WHERE id=? AND user=? AND tinhtrang='dathang'";
					$stmt_dathang = $conn->prepare($sql_dathang);
					$stmt_dathang->bind_param("sisi", $now, $soluong_moi, $id_form[$k], $user);
					$stmt_dathang->execute();
					echo "<script>window.location='index.php?b=listcart';</script>";
					$stmt_dathang->close();
				}
			}
			$stmt_kt->close();
		}
	}
}

?>
<table width="1200" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #333">
	<form method="post" name="form">
		<tr>
			<td colspan="6" class="tieude" align="center">GIỎ HÀNG CỦA QUÝ KHÁCH</td>
		</tr>
		<tr bgcolor="#ad2200" align="center" height="30" style="font-weight:bold">
			<td width="100" style="border-right:1px solid #666">
				<font color="#FFFFFF">STT</font>
			</td>
			<td width="220" style="border-right:1px solid #666">
				<font color="#FFFFFF">Sản phẩm</font>
			</td>
			<td width="120" style="border-right:1px solid #666">
				<font color="#FFFFFF">Số lượng</font>
			</td>
			<td width="190" style="border-right:1px solid #666">
				<font color="#FFFFFF">Giá</font>
			</td>
			<td width="190" style="border-right:1px solid #666">
				<font color="#FFFFFF">Tổng</font>
			</td>
			<td width="100">
				<font color="#FFFFFF">Xóa</font>
			</td>
		</tr>
		<?php
		$user = $_SESSION["user"];
		$sql = "SELECT giohang.*, sanpham.* FROM giohang JOIN sanpham ON giohang.id=sanpham.id WHERE giohang.user=? AND giohang.tinhtrang='themgiohang'";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $user);
		$stmt->execute();
		$result = $stmt->get_result();
		$i = 0;
		$tongtien = 0;
		if ($result->num_rows == 0) {
			echo "<tr><td colspan=6 height=30 align=center>Không có sản phẩm nào trong giỏ hàng của Quý khách!</td></tr>";
		} else {
			while ($r = $result->fetch_assoc()) {
				$id = $r["id"];
				$tensp = $r["tensp"];
				$soluong = isset($_SESSION["soluong"]) ? $_SESSION["soluong"] : $r["soluong"];
				$gia = $r["gia"];
				$gia2 = number_format($gia, 0, '', '.');
				$s = ($gia == 0) ? "(liên hệ)" : $gia2 . " VND";
				$tong = $gia * $soluong;
				$tong2 = number_format($tong, 0, '', '.');
				$t = ($tong == 0) ? "(liên hệ)" : $tong2 . " VND";
				$tongtien += $tong;
				$tongtien2 = number_format($tongtien, 0, '', '.');
				$tt = ($tongtien == 0) ? "(liên hệ)" : $tongtien2 . " VND";
				$i++;
				?>
				<tr align="center" height="30">
					<td width="100" style="border-right:1px solid #666; border-bottom:1px solid #666">
						<?php echo $i; ?>
					</td>
					<td width="220" style="border-right:1px solid #666; border-bottom:1px solid #666">
						<?php echo $tensp; ?>
					</td>
					<td width="120" style="border-right:1px solid #666; border-bottom:1px solid #666">
						<input type="text" name="soluong[]" value="<?php echo $soluong ?>" style="width:30px" />
						<input type="hidden" name="id_form[]" value="<?php echo "$id"; ?>" />
						<input type="hidden" name="tong[]" value="<?php echo "$tong"; ?>" />
					</td>
					<td align="right" width="190"
						style="border-right:1px solid #666; border-bottom:1px solid #666; padding-right:3px">
						<?php echo $s; ?>
					</td>
					<td align="right" width="190"
						style="border-right:1px solid #666; border-bottom:1px solid #666; padding-right:3px">
						<?php echo $t; ?>
					</td>
					<td width="100" style="border-bottom:1px solid #666"><input type="checkbox" name="xoa[]"
							value="<?php echo "$id"; ?>" /></td>
				</tr>
				<?php
			}
		}
		if ($result->num_rows == 0) {
			echo "";
		} else {
			echo "<tr>
  <td height=30 colspan=6 align=right style=\"padding-right:5px; padding-bottom:5px; color:#000\">Tổng số tiền phải thanh toán: $tt </td></tr>
  <tr>
  	<td colspan=\"6\" style=\" border-bottom:1px solid #666\" bgcolor=\"#fff\" align=\"center\" height=\"35\">
    <input type=\"button\" name=\"tieptucmuahang\" value=\"Tiếp Tục Mua Hàng\" class=\"button3\" onmouseover=\"style.background='url(../../assets/customer/images/button-150-2-o.png)'\" onmouseout=\"style.background='url(../../assets/customer/images/button-150-o.png)'\" onclick=\"document.form.action='index.php'; document.form.submit();\" />
    
    <input type=\"submit\" name=\"capnhatgiohang\" value=\"Cập Nhật\" class=\"button\" onmouseover=\"style.background='url(../../assets/customer/images/button-2-o.gif)'\" onmouseout=\"style.background='url(../../assets/customer/images/button-o.gif)'\" onclick=\"document.form.submit();\" />
    
    
	<input type=\"submit\" name=\"dathang\" value=\"Đặt Hàng\" class=\"button2\" onmouseover=\"style.background='url(../../assets/customer/images/button-110-2-o.png)'\" onmouseout=\"style.background='url(../../assets/customer/images/button-110-o.png)'\" onclick=\"document.form.submit();\"/>
    </td>
  </tr>";
		}
		?>

		<input type="hidden" name="act" />
	</form>
</table>
<div style='font-size:11px; line-height:20px; color:#FF0000; width:560px'></div>