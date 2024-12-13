<?php
$timkiem = $_GET["text_content"];
?>
<div class="productForm">
	<div class="product-top-1">
		<h1>KẾT QUẢ
			TÌM KIẾM VỚI TỪ KHÓA:
			<?php echo $timkiem; ?>
		</h1>
	</div>
	<?php
	$sql = "SELECT COUNT(*) AS total FROM sanpham WHERE hinh LIKE ? OR tensp LIKE ? OR mota LIKE ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
	$searchParam = '%' . $timkiem . '%';
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$numrow = $row['total'];

	$pagesize = 15;
	$pagecount = ceil($numrow / $pagesize);

	if ($pagecount > 3 || $pagecount == 0) {
		$segsize = 3;
	} else {
		$segsize = $pagecount;
	}

	if (!isset($_GET["page"])) {
		$curpage = 1;
	} else {
		$curpage = $_GET["page"];
	}

	$curpage = max(1, min($curpage, $pagecount));

	$numseg = ceil($pagecount / $segsize);
	$curseg = ceil($curpage / $segsize);
	?>
	<table width="1120px" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" style="padding-left:50px">
				<?php
				include "../../models/connect.php";
				$sql2 = "SELECT * FROM sanpham WHERE hinh LIKE '%" . $timkiem . "%' OR tensp LIKE '%" . $timkiem . "%' OR mota LIKE '%" . $timkiem . "%' LIMIT " . ($curpage - 1) * $pagesize . ", $pagesize";
				$result2 = $conn->query($sql2);
				if (!$result2) {
					echo "";
				} else {
					while ($r2 = $result2->fetch_array()) {
						$id = $r2["id"];
						$tensp = $r2["tensp"];
						$hinh = $r2["hinh"];
						$gia = $r2["gia"];
						$s = ($gia == 0) ? "(liên hệ)" : $gia;
						echo "<div class=divshow2 style=\"margin-right: 38px; margin-bottom:15px\">
        <table width=175 height=220 border=0 cellspacing=0 cellpadding=0 background=\"../../assets/customer/images/box.gif\" style=\"border:1px dotted #999\">
          <tr>
            <td height=170><a href=?b=ct&id=$id><img src='../../assets/sanpham/small/$hinh' width=170px height=170 border=0> </a></td>
          </tr>
          <tr>
            <td height=25 style=\"font-size:14px; color:#F00\"><strong>$tensp</strong></td>
          </tr>
          <tr>
            <td height=25>Giá: $s</td>
          </tr>
        </table>		
        </div>";
					}
				}
				?>

			</td>
		</tr>
	</table>

	<?php
	if ($numrow == 0)
		echo "<table width=560 border=0 cellspacing=0 cellpadding=0 style=\"padding-top:5px; \">
		<tr>
			<td><img src=\"../../assets/customer/images/ErrorMessage.gif\" width=16 height=16/></td>
			<td>Không có sản phẩm nào phù hợp với từ khóa:<b> $timkiem</b></td>
		  </tr>
		  <tr>
			<td><br><img src=\"../../assets/customer/images/InfoMessage.gif\" width=16 height=16/></td>
			<td><br>Đề xuất:</td>
		  </tr>
		  <tr>
			<td style=\"line-height:25px\" colspan=2>
			<ul>
			<li>Phải chắc rằng các từ ngữ được ghi đúng chính tả</li>
			<li>Thử từ khóa khác</li>
			<li>Thử dùng từ khóa tổng quát khác</li>
			</ul>
			</td>    
		  </tr>
		  <tr>
			<td><br><img src=\"../../assets/customer/images/9.png\" width=16 height=16/></td>
			<td><br>Mẹo tìm kiếm:</td>
		  </tr>
		  <tr>
		  	<td style=\"line-height:25px\" colspan=2><ul>
			<li>Tất cả các từ khóa tìm kiếm đều liên quan với tên sản phẩm, mô tả, và mã sản phẩm.</li>
			<li>Cố gắng nhập từ khóa ngắn và liên quan đến sản phẩm cần tìm.</li>			
			</ul></td>
		  </tr>
		</table>";
	else {
		echo "<div align=center>Số trang :&nbsp;";
		$tk = $_REQUEST["text_content"];
		if ($curseg > 1)
			echo "<a href='/BTLWebNC/shoppc/?b=tk&text_content=$tk&page=" . (($curseg - 1) * $segsize) . "'><b>Previous</b></a> &nbsp;&nbsp;&nbsp;";
		$n = $curseg * $segsize <= $pagecount ? $curseg * $segsize : $pagecount;
		for ($i = ($curseg - 1) * $segsize + 1; $i <= $n; $i++) {
			if ($curpage == $i)
				echo "<a href='/BTLWebNC/shoppc/?b=tk&text_content=$tk&page=" . $i . "'><font color='#0000FF'>[" . $i . "]</font></a> &nbsp;&nbsp;&nbsp;";
			else
				echo "<a href='/BTLWebNC/shoppc/?b=tk&text_content=$tk&page=" . $i . "'>[" . $i . "]</a> &nbsp;&nbsp;&nbsp;";
		}
		if ($curseg < $numseg)
			echo "<a href='/BTLWebNC/shoppc/?b=tk&text_content=$tk&page=" . (($curseg * $segsize) + 1) . "'><b>Next</b></a> &nbsp;&nbsp;&nbsp;";

	}
	?>


</div>