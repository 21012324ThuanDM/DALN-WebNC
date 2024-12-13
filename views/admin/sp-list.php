<?php
include("connect.php");
function print_option($sql4)
{
	global $conn; // Sử dụng biến kết nối đã được thiết lập trong tệp connect.php

	$kq4 = mysqli_query($conn, $sql4); // Thực hiện truy vấn bằng mysqli_query
	if (!$kq4) {
		echo "Error: " . mysqli_error($conn); // In thông báo lỗi nếu có
	} else {
		while ($r4 = mysqli_fetch_array($kq4)) {
			echo "<option value='" . $r4[0] . "'>" . $r4[0] . " - " . $r4[1] . "</option>"; // Sử dụng mysqli_fetch_array để lấy kết quả
		}
	}
}
?>

<form method="post" id="frm" name="form">
	<table width="735" height="70" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF"
		bordercolordark="#FFFFFF">
		<tr>
			<td style="border:1px solid #CCCCCC;">
				<div align="left"
					style="color:rgb(41, 198, 255); font-family:Tahoma; font-size: 16px; font-weight:bold; padding-left:20px">QUẢN
					LÝ SẢN PHẨM
				</div>
			</td>
		</tr>
	</table>

	<table width="735" border="0" cellspacing="0" cellpadding="0">
		<tr height="30" style = "background-color: rgb(41, 198, 255);">
			<td align="center" width="50" style="border-left:1px solid #333;border-right:1px solid #333">
				<strong>STT</strong>
			</td>
			<td align="center" width="80" style="border-right:1px solid #333"><strong>Tên sản phẩm</strong></td>
			<td align="center" width="135" style="border-right:1px solid #333"><strong>Loại sản phẩm</strong></td>
			<td align="center" width="100" style="border-right:1px solid #333"><strong>Mô tả</strong></td>
			<td align="center" width="100" style="border-right:1px solid #333"><strong>Hình</strong></td>
			<td align="center" width="100" style="border-right:1px solid #333"><strong>Giá ( VND )</strong></td>
			<td align="center" width="80" style="border-right:1px solid #333"><strong>Ghi Chú</strong></td>
			<td align="center" width="50" style="border-right:1px solid #333"><strong>Sửa</strong></td>
			<td align="center" width="50"><strong>Xóa</strong></td>
		</tr>
		<?php
		include("connect.php");

		$idl = isset($_GET["idl"]) ? $_GET["idl"] : null;

		if (isset($_REQUEST["idl"])) {
			$kq = mysqli_query($conn, "SELECT COUNT(*) FROM sanpham,loaisanpham WHERE sanpham.id_loai=loaisanpham.id_loai AND sanpham.id_loai=$idl");
		} else {
			$kq = mysqli_query($conn, "SELECT COUNT(*) FROM sanpham");
		}
		$r = mysqli_fetch_array($kq);
		$numrow = $r[0];
		$pagesize = 20;
		$pagecount = ceil($numrow / $pagesize);
		$segsize = 5;
		$curpage = isset($_GET["page"]) ? $_GET["page"] : 1;
		$curpage = max(1, min($curpage, $pagecount));
		$numseg = ($pagecount % $segsize == 0) ? ($pagecount / $segsize) : (int) ($pagecount / $segsize + 1);
		$curseg = ($curpage % $segsize == 0) ? ($curpage / $segsize) : (int) ($curpage / $segsize + 1);
		$k = ($curpage - 1) * $pagesize;
        $count = $k + 1;
		if (isset($_REQUEST["idl"])) {
			$sql3 = "SELECT sanpham.*,loaisanpham.id_loai,loaisanpham.tenloaisp FROM sanpham,loaisanpham WHERE sanpham.id_loai=loaisanpham.id_loai AND sanpham.id_loai=$idl ORDER BY tensp LIMIT $k,$pagesize";
		} else {
			$sql3 = "SELECT * FROM sanpham ORDER BY tensp LIMIT $k,$pagesize";
		}
		$kq3 = mysqli_query($conn, $sql3);
		if (!$kq3) {
			echo "";
		} else {
			while ($r3 = mysqli_fetch_array($kq3)) {
				$tensp = $r3['tensp'];
				$mota = $r3['mota'];
				$ghichu = $r3["ghichu"];
				$mota = $r3["mota"];
				$hinh = $r3['hinh'];
				$gia = number_format($r3['gia'], 0, '', '.');
				$id = $r3["id"];
				$sql2 = "SELECT * FROM loaisanpham,sanpham WHERE loaisanpham.id_loai=sanpham.id_loai AND sanpham.id='$id'";
				$kq2 = mysqli_query($conn, $sql2);
				
				while ($r2 = mysqli_fetch_array($kq2)) {
					$tenloaisp = $r2["tenloaisp"];
					?>
					<tr>
						<td width="50" align="center"
							style="border-left:1px solid #333;border-bottom:1px solid #333; border-right:1px solid #333">
							<?php echo $count++ ?>
						</td>
						<td width="80" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><b>
								<?php echo "$tensp"; ?>
							</b></td>
						<td width="135" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
							<?php echo "$tenloaisp"; ?>
						</td>
						<td width="100" style="border-bottom:1px solid #333; border-right:1px solid #333">
							<div align="center" style="padding-left:3px; padding-right:3px;"
								onclick="var win=window.open('mota.php?id=<?php echo $id; ?>', 'open_window', 'width=570, height=320, left=0, top=0')">
								Xem mô tả</div>
						</td>
						<td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
							<div
								onclick="var win=window.open('../zoom.php?id=<?php echo $id; ?>', 'open_window', 'width=405, height=530, left=0, top=0')">
								<img src="../sanpham/small/<?php echo "$hinh"; ?>" width="90" height="90">
							</div>
						</td>
						<td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
							<?php echo "$gia"; ?>
						</td>
						<td width="80" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
							<?php echo "$ghichu"; ?>
						</td>
						<td width="50" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><a
								href="?m=sp&b=sp-update&id=<?php echo $id; ?>">Sửa</a></td>
						<td width="50" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><a
								href="?m=sp&b=sp-del&id=<?php echo $id; ?>" onclick="return check()">Xóa</a>
						</td>
					</tr>
					<?php
				}
			}
		}
		?>

		<tr>
			<td colspan="9" class="ketthuc" bgcolor="#ffcc99">
				<?php
				if ($numrow == 0)
					echo "Không tìm thấy sản phẩm nào!!";
				else {
					if (isset($_REQUEST["idl"])) {
						if ($curseg > 1)
							echo "<a href='?m=sp&b=sp-list&idl=$idl&page=" . (($curseg - 1) * $segsize) . "'><b>Previous</b></a> &nbsp;";
						$n = $curseg * $segsize <= $pagecount ? $curseg * $segsize : $pagecount;
						for ($i = ($curseg - 1) * $segsize + 1; $i <= $n; $i++) {
							if ($curpage == $i)
								echo "<a href='?m=sp&b=sp-list&idl=$idl&page=" . $i . "'><font color='#FF0000'>[" . $i . "]</font></a> &nbsp;";
							else
								echo "<a href='?m=sp&b=sp-list&idl=$idl&page=" . $i . "'><font color='#000'>[" . $i . "]</font></a> &nbsp;";
						}
						if ($curseg < $numseg)
							echo "<a href='?m=sp&b=sp-list&idl=$idl&page=" . (($curseg * $segsize) + 1) . "'><b>Next</b></a> &nbsp;";
					} else {
						if ($curseg > 1)
							echo "<a href='?m=sp&b=sp-list&page=" . (($curseg - 1) * $segsize) . "'><b>Previous</b></a> &nbsp;";
						$n = $curseg * $segsize <= $pagecount ? $curseg * $segsize : $pagecount;
						for ($i = ($curseg - 1) * $segsize + 1; $i <= $n; $i++) {
							if ($curpage == $i)
								echo "<a href='?m=sp&b=sp-list&page=" . $i . "'><font color='#FF0000'>[" . $i . "]</font></a> &nbsp;";
							else
								echo "<a href='?m=sp&b=sp-list&page=" . $i . "'><font color='#FFF'>[" . $i . "]</font></a> &nbsp;";
						}
						if ($curseg < $numseg)
							echo "<a href='?m=sp&b=sp-list&page=" . (($curseg * $segsize) + 1) . "'><b>Next</b></a> &nbsp;";
					}
				}
				?>
			</td>
		</tr>
	</table>
</form>