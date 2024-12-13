<?php
include "../connect.php";

$query = "SELECT giohang.*, sanpham.* FROM giohang INNER JOIN sanpham ON giohang.id = sanpham.id";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {
  $user_q = $row["user"];
  $soluong_q = $row["soluong"];
  $gia_q = $row["gia"];
  $tien_q = $soluong_q * $gia_q;
  $tien_q2 = number_format($tien_q, 0, '', '.');
}

?>

<table width="735" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" class="tieude" align="center">DANH SÁCH ĐƠN HÀNG ĐÃ GIẢI QUYẾT CHO THÀNH VIÊN</td>
  </tr>
  <tr height="30" bgcolor="#FFCC99">
    <td align="center" width="200" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Ngày đặt</strong></td>
    <td align="center" width="200" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Khách hàng</strong></td>
    <td align="center" width="265" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Tổng tiền</strong></td>
    <td align="center" width="70" style="border-right:1px solid #333; background-color: rgb(41, 198, 255)"><strong>Chi tiết</strong></td>
  </tr>
  <?php
  $kq2 = mysqli_query($conn, "SELECT COUNT(*) FROM giohang WHERE tinhtrang='damua'");
  $r2 = mysqli_fetch_array($kq2);
  $numrow = $r2[0];
  $pagesize = 20;
  $pagecount = ceil($numrow / $pagesize);
  $segsize = 3;
  if (!isset($_GET["page"]))
    $curpage = 1;
  else
    $curpage = $_GET["page"];
  if ($curpage < 1)
    $curpage = 1;
  if ($curpage > $pagecount)
    $curpage = $pagecount;
  $numseg = ($pagecount % $segsize == 0) ? ($pagecount / $segsize) : (int) ($pagecount / $segsize + 1);
  $curseg = ($curpage % $segsize == 0) ? ($curpage / $segsize) : (int) ($curpage / $segsize + 1);
  $k = ($curpage - 1) * $pagesize;

  // Nội dung trang
  $sql3 = "SELECT user, ngaydat FROM giohang WHERE tinhtrang='damua' GROUP BY user, ngaydat LIMIT $k, $pagesize";
  $kq3 = mysqli_query($conn, $sql3);

  if ($kq3) {
    while ($r3 = mysqli_fetch_array($kq3)) {
      $ngaydat = $r3["ngaydat"];
      $day = ConvertDate_time_db($ngaydat); // Chưa biết hàm ConvertDate_time_db nằm ở đâu
      $user3 = $r3["user"];
      $tongtien3 = $r3["tongtien"];
      $tt3 = number_format($tongtien3, 0, '', '');
      ?>
      <tr height="30">
        <td align="center" width="200"
          style="border-bottom:1px solid #333; border-left:1px solid #333;border-right:1px solid #333;">
          <strong>
            <?php echo $day; ?>
          </strong>
        </td>
        <td align="center" width="200" style="border-right:1px solid #333; border-bottom:1px solid #333;">
          <strong>
            <?php echo $user3; ?>
          </strong>
        </td>
        <td align="center" width="265" style="border-right:1px solid #333; border-bottom:1px solid #333;">
          <strong>
            <?php echo "$tt3 VND"; ?>
          </strong>
        </td>
        <td align="center" width="70" style="border-right:1px solid #333; border-bottom:1px solid #333;">
          <a href="?m=dh&b=gh-chitiet&u=<?php echo $user3; ?>&ngay=<?php echo $ngaydat; ?>">Xem</a>
        </td>
      </tr>
      <?php
    }
  }
  ?>
  <tr>
    <td class="ketthuc" colspan="5">
      <?php
      // Xuất số trang
      if ($numrow == 0) {
        echo "Hiện tại chưa có đơn hàng nào!";
      } else {
        if ($curseg > 1)
          echo "<a href='?m=dh&b=get-list-end&page=" . (($curseg - 1) * $segsize) . "'><b>Quay lại</b></a> &nbsp;";
        $n = $curseg * $segsize <= $pagecount ? $curseg * $segsize : $pagecount;
        for ($i = ($curseg - 1) * $segsize + 1; $i <= $n; $i++) {
          if ($curpage == $i)
            echo "<a href='?m=dh&b=get-list-end&page=" . $i . "'><font color='#FFFFFF'>[" . $i . "]</font></a> &nbsp;";
          else
            echo "<a href='?m=dh&b=get-list-end&page=" . $i . "'>[" . $i . "]</a> &nbsp;";
        }
        if ($curseg < $numseg)
          echo "<a href='?m=dh&b=get-list-end&page=" . (($curseg * $segsize) + 1) . "'><b>Tiếp</b></a> &nbsp;";
      }
      ?>
    </td>
  </tr>
</table>