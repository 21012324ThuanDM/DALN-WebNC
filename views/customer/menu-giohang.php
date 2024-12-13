<table width="195" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="195" height="35" background="images/bgn_giohang2.png">
			<div align="left" style="color:#FFF; font-family:Tahoma; font-size: 14px; padding-left:25px">THÔNG TIN GIỎ
				HÀNG</div>
		</td>
	</tr>
	<tr>
		<td background="images/toplist-content.gif"
			style="border-left: 1px solid #CCCCCC;border-right: 1px solid #CCCCCC;border-bottom: 1px solid #CCCCCC; background-repeat:repeat-x">
			<div style="padding-left:30px; line-height:25px;">
				&raquo; Sản phẩm:
				<?php
				$user = $_SESSION["user"];
				$sql = "SELECT COUNT(*) FROM giohang WHERE user=? AND tinhtrang='themgiohang'";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("s", $user);
				$stmt->execute();
				$stmt->bind_result($numrow);
				$stmt->fetch();

				if ($numrow == 0) {
					echo "0";
				} else {
					echo "$numrow";
				}
				echo "<br>&raquo; <a href=\"index.php?b=showcart\">Xem Giỏ Hàng</a><br>";

				// Đóng statement sau khi sử dụng xong
				$stmt->close();
				?>

			</div>
		</td>
	</tr>
</table>