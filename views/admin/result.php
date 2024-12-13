<?php
include "../connect.php";
$timkiem = $_GET["text_content"];
?>
<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

$sql = "SELECT count(*) FROM sanpham WHERE hinh LIKE '%$timkiem%' OR tensp LIKE '%$timkiem%' OR mota LIKE '%$timkiem%'";
$kq = mysqli_query($conn, $sql);
// Xác định số lượng bản ghi
$r = mysqli_fetch_array($kq);
$numrow = $r[0];
// Số bản ghi cho mỗi trang
$pagesize = 21;
// Tính tổng số trang
$pagecount = ceil($numrow / $pagesize);
// Xác định số trang cho mỗi lần hiển thị
if ($pagecount > 3 || $pagecount == 0) {
	$segsize = 3;
} else {
	$segsize = $pagecount;
}
// Thiết lập trang hiện tại
if (!isset($_GET["page"])) {
	$curpage = 1;
} else {
	$curpage = $_GET["page"];
}
if ($curpage < 1) {
	$curpage = 1;
}
if ($curpage > $pagecount) {
	$curpage = $pagecount;
}
// Xác định số phân đoạn của trang
$numseg = ($pagecount % $segsize == 0) ? ($pagecount / $segsize) : (int) ($pagecount / $segsize) + 1;
// Xác định phân đoạn hiện tại của trang
$curseg = ($curpage % $segsize == 0) ? ($curpage / $segsize) : (int) ($curpage / $segsize) + 1;

//*************************** Hiển thị nội dung ***************************************
?>
<table width="735" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="9" class="tieude" align="center">DANH SÁCH SẢN PHẨM</td>
	</tr>
	<tr height="30" bgcolor="#FFCC99">
		<td align="center" width="130" style="border-left:1px solid #333;border-right:1px solid #333"><strong>Tên sản
				phẩm</strong></td>
		<td align="center" width="135" style="border-right:1px solid #333"><strong>Loại sản phẩm</strong></td>
		<td align="center" width="100" style="border-right:1px solid #333"><strong>Mô tả</strong></td>
		<td align="center" width="100" style="border-right:1px solid #333"><strong>Hình</strong></td>
		<td align="center" width="100" style="border-right:1px solid #333"><strong>Giá ( VND )</strong></td>
		<td align="center" width="80" style="border-right:1px solid #333"><strong>Ghi Chú</strong></td>
		<td align="center" width="50" style="border-right:1px solid #333"><strong>Sửa</strong></td>
		<td align="center" width="50"><strong>Xóa</strong></td>
	</tr>
	<?php
	include "connect.php";
	$sql2 = "SELECT * FROM sanpham WHERE hinh LIKE '%$timkiem%' OR tensp LIKE '%$timkiem%' OR mota LIKE '%$timkiem%' LIMIT " . ($curpage - 1) * $pagesize . ", $pagesize";
	//	echo "$sql2<hr>";
	$kq2 = mysqli_query($conn, $sql2);
	//	echo "$sql2";
	if (!$kq2) {
		echo "";
	} else {
		while ($r2 = mysqli_fetch_array($kq2)) {
			$id = $r2["id"];
			$tensp = $r2["tensp"];
			$hinh = $r2["hinh"];
			$gia = $r2["gia"];
			$gia2 = number_format($gia, 0, '', '.');
			$mota = $r2["mota"];
			$ghichu = $r2["ghichu"];
			$id_loai = $r2["id_loai"];
			if ($gia == 0)
				$s = "(liên hệ)";
			else {
				$s = $gia2;
			}
			if ($id_loai != 0)
				$sql3 = "SELECT loaisanpham.*,sanpham.* FROM loaisanpham,sanpham WHERE loaisanpham.id_loai=sanpham.id_loai AND sanpham.id='$id'";
			else
				$sql3 = "SELECT menu.*,sanpham.* FROM menu,sanpham WHERE menu.id_menu=sanpham.id_menu AND sanpham.id='$id'";
			$kq3 = mysqli_query($conn, $sql3);
			//	echo "$sql3<hr>";
			while ($r3 = mysqli_fetch_array($kq3)) {
				$tenloaisp = $r3["tenloaisp"];
				$tenmenu = $r3["tenmenu"];
				//		echo "$tenmenu";
				?>
				<tr>
					<td width="130" align="center"
						style="border-left:1px solid #333;border-bottom:1px solid #333; border-right:1px solid #333"><b>
							<?php echo "$tensp"; ?>
						</b></td>
					<td width="135" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
						<?php if ($id_loai != 0)
							echo "$tenloaisp";
						else
							echo "$tenmenu"; ?>
					</td>
					<td width="100" style="border-bottom:1px solid #333; border-right:1px solid #333">
						<div align="center" style="padding-left:3px; padding-right:3px; overflow:auto"
							onclick="var win=window.open('mota.php?id=<?php echo $id; ?>', 'open_window', 'width=570, height=320, left=0, top=0')">
							Xem mô tả</div>
					</td>
					<td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
						<div
							onclick="var win=window.open('/zoom.php?id=<?php echo $id; ?>', 'open_window', 'width=405, height=530, left=0, top=0')">
							<img src="../sanpham/small/<?php echo "$hinh"; ?>" width="90" height="90" border="0">
						</div>
					</td>
					<td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><strong>
							<?php echo "$s"; ?>
						</strong></td>
					<td width="80" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
						<?php echo "$ghichu"; ?>
					</td>
					<td width="50" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><a
							href="?m=sp&b=sp-update&id=<?php echo $id; ?>">Sửa</a></td>
					<td width="50" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><a
							href="?m=sp&b=sp-del&id=<?php echo $id; ?>" onclick="return check()">Xóa</a></td>
				</tr>
				<?php
			}
		}
	}
	?>
</table>

<tr>
	<td colspan="9" class="ketthuc">
		<?php
		if ($numrow == 0)
			echo "<table width=560 border=0 cellspacing=0 cellpadding=0 style=\"padding-top:5px; \">
		<tr>
			<td><img src=\"images/ErrorMessage.gif\" width=16 height=16/></td>
			<td>Không có sản phẩm nào phù hợp với từ khóa:<b> $timkiem</b></td>
		  </tr>		  
		</table>";
		else {
			echo "<div align=center>Số trang :&nbsp;";
			$tk = $_REQUEST["text_content"];
			if ($curseg > 1)
				echo "<a href='../admincp/?m=sp&b=tk&text_content=$tk&page=" . (($curseg - 1) * $segsize) . "'><b>Previous</b></a> &nbsp;&nbsp;&nbsp;";
			$n = $curseg * $segsize <= $pagecount ? $curseg * $segsize : $pagecount;
			for ($i = ($curseg - 1) * $segsize + 1; $i <= $n; $i++) {
				if ($curpage == $i)
					echo "<a href='../admincp/?m=sp&b=tk&text_content=$tk&page=" . $i . "'><font color='#00FF00'>[" . $i . "]</font></a> &nbsp;&nbsp;&nbsp;";
				else
					echo "<a href='../admincp/?m=sp&b=tk&text_content=$tk&page=" . $i . "'>[" . $i . "]</a> &nbsp;&nbsp;&nbsp;";
			}
			if ($curseg < $numseg)
				echo "<a href='../admincp/?m=sp&b=tk&text_content=$tk&page=" . (($curseg * $segsize) + 1) . "'><b>Next</b></a> &nbsp;&nbsp;&nbsp;";
		}
		?>
	</td>
</tr>
</table>