<script>
	function danhmuc(j) {

		objName = "danhmuc[" + j + "]";
		var obj = document.getElementById(objName);
		//alert(objName);
		var objImg = obj.parentNode.getElementsByTagName("img")[0];
		objImg.src = "../../assets/customer/images/arrow-square.gif";

		if (obj.style.display == "none") {
			obj.style.display = "block";
			objImg.src = "../../assets/customer/images/arrow-square.gif";


		} else {
			obj.style.display = "none";
			objImg.src = "../../assets/customer/images/arrow-square2.gif";
		}
	}
</script>
<table width="195" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="height:35px" background="../../assets/customer/images/bgn_menu2.png">
			<div align="left" style="color:#FFF; font-family:Tahoma; font-size: 14px; padding-left:30px;">DANH MỤC SẢN
				PHẨM</div>
		</td>
	</tr>
	<?php
	include "../../models/connect.php";
	$sql = "SELECT * FROM nhomsanpham";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($r = $result->fetch_assoc()) {
			$id_nhom = $r["id_nhom"];
			$tennhom = $r["tennhom"];
			if ($id_nhom == 1) {
				echo "<tr><td height=30 background='../../assets/customer/images/bg_menu.png' style=\"padding-left:30px\">				
					<a href=?b=nsp&idn=$id_nhom style=\"color:#fff\" onMouseOver=\"style.color='#ffcc00'\" onMouseOut=\"style.color='#FFF'\">$tennhom</a></td></tr>";

				$sql2 = "SELECT * FROM loaisanpham WHERE id_nhom=1";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
					while ($r2 = $result2->fetch_assoc()) {
						$tenloai = $r2["tenloaisp"];
						$id_loai = $r2["id_loai"];
						$c1 = $conn->query("SELECT COUNT(*) FROM sanpham WHERE id_loai=$id_loai AND (ghichu='hienthi' OR ghichu='new')");
						$nc1 = $c1->fetch_array()[0];
						echo "<tr><td height=30 background='../../assets/customer/images/bg_menu42.png'><div style=\"padding-left:25px\"><a href=?b=lsp&idl=$id_loai style=\"color:#000\" onMouseOver=\" Tip('Có $nc1 sản phẩm');style.color='#d4340c';\" onMouseOut=\"style.color='#000'\">$tenloai</a></div></td></tr>";
					}
				}
			} else {
				echo "<tr><td height=30 background='../../assets/customer/images/bg_menu.png' style='padding-left:30px'>			
					<a href=?b=nsp&idn=$id_nhom style=\"color:#fff\" onMouseOver=\"style.color='#ffcc00'\" onMouseOut=\"style.color='#fff'\">$tennhom</a></td></tr>";

				$sql2 = "SELECT * FROM loaisanpham WHERE id_nhom=$id_nhom";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
					while ($r2 = $result2->fetch_assoc()) {
						$tenloai = $r2["tenloaisp"];
						$id_loai = $r2["id_loai"];
						$c1 = $conn->query("SELECT COUNT(*) FROM sanpham WHERE id_loai=$id_loai");
						$nc1 = $c1->fetch_array()[0];
						echo "<tr><td height=30 background='../../assets/customer/images/bg_menu42.png'><div style=\"padding-left:25px\"><a href=?b=lsp&idl=$id_loai style=\"color:#000000\" onMouseOver=\"Tip('Có $nc1 sản phẩm');style.color='#FFFFFF'\" onMouseOut=\"style.color='#000000'\">$tenloai</a></div></td></tr>";
					}
				}
			}
		}
	} else {
		echo "0 results";
	}

	?>
</table>