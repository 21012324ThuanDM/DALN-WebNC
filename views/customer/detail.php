<?php
//session_destroy();
if (isset($_POST["dathang"])) {
  $gia = $_POST["gia"];
  //	echo "$gia<hr>";
  $id = $_GET["id"];
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $query = "SELECT * FROM giohang WHERE id='$id' AND user='$user' AND tinhtrang='themgiohang'";
    $result = $conn->query($query);
    $numrow = $result->num_rows;
    if ($numrow != 0) {
      echo "<script>alert('Sản phẩm này đã có trong giỏ hàng của Quý khách');</script>";
    } else {
      $ngaydat = date("Y-m-d");
      $query2 = "INSERT INTO giohang(id, user, soluong, tinhtrang, ngaydat) VALUES ('$id', '$user', 1, 'themgiohang', '$ngaydat')";
      // echo "$query2";
      $result2 = $conn->query($query2);
      if ($result2) {
        echo "<script>window.location='index.php?b=showcart';</script>";
      } else {
        echo "<script>alert('Có lỗi xảy ra trong quá trình mua hàng!');</script>";
      }
    }
  }
}
?>
<?php
include "../../models/connect.php";

$id = $_GET["id"];

// Thực hiện kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shop");

// Kiểm tra kết nối
if (!$conn) {
  die("Lỗi kết nối: " . mysqli_connect_error());
}

// Truy vấn SQL
$sql = "SELECT sanpham.*, loaisanpham.*, nhomsanpham.* FROM sanpham
        INNER JOIN loaisanpham ON sanpham.id_loai=loaisanpham.id_loai
        INNER JOIN nhomsanpham ON loaisanpham.id_nhom=nhomsanpham.id_nhom
        WHERE sanpham.id='$id'";

// Thực hiện truy vấn
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả và xử lý
if (!$result || mysqli_num_rows($result) == 0) {
  echo "Không tìm thấy sản phẩm!";
} else {
  // Lấy dòng dữ liệu đầu tiên từ kết quả truy vấn
  $row = mysqli_fetch_assoc($result);
  $tensp = $row["tensp"];
  $tenloaisp = $row["tenloaisp"];
  $tinhtrang = $row["tinhtrang"];
  $tennhom = $row["tennhom"];
  $id_nhom = $row["id_nhom"];
  $hinh = $row["hinh"];
  $gia = $row["gia"];
  $gia2 = number_format($gia, 0, '', '.');
  $id_loai = $row["id_loai"];
  $mota = $row["mota"];
  // Kiểm tra và gán mô tả sản phẩm
  $mt = $mota ? $mota : 'Mô tả của sản phẩm này đang được cập nhật!';
}

// Đóng kết nối
mysqli_close($conn);
?>


<div class="productDetail">
  <div>
    <a href="index.php"><img src="../../assets/customer/images/Home.gif" width="16" height="16" border="0"></a>
    <img src="../../assets/customer/images/towred1-r.gif" width="16" height="9">
    <a href="?b=nsp&idn=<?php echo $id_nhom; ?>">
      <?php echo "$tennhom"; ?>
    </a>
    <img src="../../assets/customer/images/towred1-r.gif" width="16" height="9">
    <a href="?b=lsp&idl=<?php echo $id_loai; ?>">
      <?php echo "$tenloaisp"; ?>
    </a>
    <img src="../../assets/customer/images/towred1-r.gif" width="16" height="9">
    <a href="?b=ct&id=<?php echo $id ?>">
      <?php echo "$tensp"; ?>
    </a>
  </div>
  <div style="margin-bottom: 20px">
    <span style="font-size: 20px"> <b>
        <?php echo " $tenloaisp"; ?>:
        <?php echo " $tensp"; ?>
      </b> </span>
  </div>

  <div class="container text-center">
    <div class="row">
      <div class="col-5">
        <img style="width: 100%" src="../../assets/sanpham/small/<?php echo $hinh; ?>"><br />
      </div>
      <div class="col">
        <br>
        <div><span style="font-size: 20px"><b>Thông tin sản phẩm</b></span> </div>
        <br>
        <div class="container text-center">
          <div style="height: 30px" class="row bg-light">
            <div class="col-4">
              <span>Mã sản phẩm</span>
            </div>
            <div class="col">
              <?php echo $tensp; ?>
            </div>
          </div>

          <div style="height: 30px" class="row bg-secondary">
            <div class="col-4">
              <span>Giá</span>
            </div>
            <div class="col">
              <?php echo "$gia2 VND"; ?>
            </div>
          </div>

          <div style="height: 30px" class="row bg-light">
            <div class="col-4">
              <span>Thuế VAT</span>
            </div>
            <div class="col">
              Giá trên chưa bao gồm thuế
            </div>
          </div>

          <div style="height: 30px" class="row bg-secondary">
            <div class="col-4">
              <span>Bảo hành</span>
            </div>
            <div class="col">
              12 Tháng.
            </div>
          </div>

          <div style="height: 30px" class="row bg-light">
            <div class="col-4">
              <span>Vận chuyển</span>
            </div>
            <div class="col">
              Giao hàng toàn quốc
            </div>
          </div>

          <div style="height: 30px" class="row bg-secondary">
            <div class="col-4">
              <span>Thời gian giao hàng</span>
            </div>
            <div class="col">
              <?php
              if ($tinhtrang == 0)
                echo "<strong>7 ngày</strong> sau khi đặt hàng";
              else
                echo "<strong>1 ngày</strong> sau khi đặt hàng";
              ?>
            </div>
          </div>

          <div style="height: 30px" class="row bg-light">
            <div class="col-4">
              <span>Hình thức thanh toán</span>
            </div>
            <div class="col">
              Thanh toán khi nhận hàng.
            </div>
          </div>


          <div style="height: 30px" class="row">
          </div>

          <div class="row">

            <form method="post" name="form">
              <input type="hidden" name="dathang" />
              <input type="hidden" value=<?php echo "$id"; ?> name="catid" />
              <input type="hidden" name="gia" value="<?php echo "$gia"; ?>" />
              <?php
              if (isset($_SESSION["user"])) {
                echo "<a class = \"orderBtn\"  onClick=\"document.form.submit();\">
                Thêm vào giỏ
         </a>";

              } else
                echo "<a href=\"index.php?b=gh&id=$id&g=$gia\"><img src=\"../../assets/customer/images/chovaogiohang.jpg\" width=\"151\" height=21 border=0> </a>";
              ?>
            </form>

          </div>



        </div>


      </div>

    </div>


  </div>


</div>


<div class="mota">
  <div></div>
  <div>
    <?php echo $mt ?>
  </div>
</div>

<div class="productForm" style="height: 310px">
  <div class="product-top-1">
    <h1>Sản phẩm tương tự</h1>
  </div>

  <?php
  include "connect.php";
  $sql2 = "SELECT * from sanpham where id_loai=$id_loai and ( ghichu='hienthi' or ghichu='new' ) and id<>'$id' order by rand() limit 0,27";
  $kq2 = mysqli_query($conn, $sql2); // assuming $conn is your MySQLi connection
  while ($r2 = mysqli_fetch_array($kq2)) {
    $id2 = $r2["id"];
    $tensp2 = $r2["tensp"];
    $hinh2 = $r2["hinh"];
    $gia2 = $r2["gia"];
    $gia3 = number_format($gia2, 0, '', '.');
    if ($gia2 == 0)
      $s2 = "(liên hệ)";
    else {
      $s2 = $gia3;
    }
    if ($id2 == $id)
      echo "";
    else {
      echo "<div class=divshow2 style=\"margin-left: 10px; margin-right:15px\">
<table width=175 height=220 border=0 cellspacing=0 cellpadding=0 background=\"../../assets/customer/images/box.gif\" style=\"border:1px dotted #999\">
    <tr>
        <td height=170><a href=?b=ct&id=$id2><img src='../../assets/sanpham/small/$hinh2' width=170px height=170 border=0> </a></td>
    </tr>
    <tr>
        <td height=25 style=\"font-size:14px; color:#F00\"><strong>$tensp2</strong></td>
    </tr>
    <tr>
        <td height=25>Giá: $s2</td>
    </tr>
</table>		
</div>";
    }
  }
  ?>

  <div>