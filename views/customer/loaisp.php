<?php
include ('../../models/connect.php');
$idl = $_GET["idl"];
$sql = "SELECT loaisanpham.*, nhomsanpham.* FROM loaisanpham INNER JOIN nhomsanpham ON loaisanpham.id_nhom=nhomsanpham.id_nhom WHERE loaisanpham.id_loai=$idl";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$id_nhom = $row["id_nhom"];
$tennhom = $row["tennhom"];
$id_loai = $row["id_loai"];
$tenloaisp = $row["tenloaisp"];

?>


<?php
$sql2 = "SELECT * FROM loaisanpham WHERE id_loai='$idl'";
$kq2 = mysqli_query($conn, $sql2);
if ($r2 = mysqli_fetch_array($kq2)) {
	$id_loai = $r2["id_loai"];
	$tenloaisp = $r2["tenloaisp"];
	$query = "SELECT COUNT(*) FROM sanpham WHERE id_loai='$id_loai'";
	$kq_query = mysqli_query($conn, $query);
	$r_query = mysqli_fetch_array($kq_query);
	$n_query = $r_query[0];
	if ($n_query > 0) {
		?>
		<div class="productForm">
			<div class="product-top-1">
				<a href="?b=lsp&idl=<?php echo $id_loai; ?>"
					style="color: #FFF; font-size:27px; font-weight:bold; margin-left: 20px">
					<img src="../../assets/customer/images/new-icon.png" />
					<?php echo $tenloaisp; ?>
				</a>
			</div>

			<?php
			echo '<div class="container text-center"> <div class="row">';

			$query = "SELECT COUNT(*) FROM sanpham WHERE id_loai='$id_loai' AND ghichu='new'";
			$kq_query = mysqli_query($conn, $query);
			$r_query = mysqli_fetch_array($kq_query);
			$n = $r_query[0];

			$sql3 = "SELECT * FROM sanpham WHERE id_loai='$id_loai' ORDER BY RAND() LIMIT 0,5";
			$kq3 = mysqli_query($conn, $sql3);

			$tmp = 0;
			while ($r3 = mysqli_fetch_array($kq3)) {
				$id = $r3["id"];
				$tensp = $r3["tensp"];
				$hinh = $r3["hinh"];
				$gia = $r3["gia"];
				$gia2 = number_format($gia, 0, '', '.');
				$s = $gia2 . " VND";

				echo "<div class='col'> 
                 <div class='colProduct'>
                    <a href=?b=ct&id=$id><img src='../../assets/sanpham/small/$hinh' width='200px' border='0'></a> <br>
                    <a href='?b=ct&id=$id' class='a-mm'><strong>$tensp</strong></a> <br>
                    <span style='color: red'> <b>Giá: $s </b> </span> <br> <br>
                  </div>
                </div>";
				$tmp++;
			}

			$tmp = 4 - $tmp;
			while ($tmp > 0) {
				echo "<div class='col'> 
                 <div style='background-color: inherit' class='colProduct'>
                   
                  </div>
                </div>";
				$tmp--;
			}
			?>
		</div>
		</div>
		</div>

		<?php
	} else {
		echo "Loại sản phẩm này đang được cập nhật";
	}
}
?>