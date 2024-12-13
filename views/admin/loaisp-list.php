<style>
  table .chose {
    color: black;
    text-decoration: none;
  }

  table .chose:hover{
    color: red;
    font-size: 19px;
  }
</style>

<form method="post" id="frm" name="form">
  <table width="735" height="70" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolordark="#FFFFFF">
    <tr>
      <td style="border:1px solid #CCCCCC;">
        <div align="left"
          style="color: rgb(41, 198, 255); font-family:Tahoma; font-size: 16px; font-weight:bold; padding-left:20px">QUẢN LÝ LOẠI
          SẢN PHẨM</div>
      </td>
    </tr>
  </table>

  <table width="735" border="0" cellspacing="0" cellpadding="0">
    <tr height="30" style = "background-color: rgb(41, 198, 255)">
      <td align="center" width="50" style="border-left:1px solid #333;border-right:1px solid #333"><strong>
          <font color="#FFFFFF">STT</font>
        </strong></td>
      <td align="center" width="235" style="border-right:1px solid #333"><strong>
          <font color="#FFFFFF">Nhóm sản phẩm</font>
        </strong></td>
      <td align="center" width="250" style="border-right:1px solid #333"><strong>
          <font color="#FFFFFF">Loại sản phẩm</font>
        </strong></td>
      <td align="center" width="100" style="border-right:1px solid #333"><strong>
          <font color="#FFFFFF">Sửa</font>
        </strong></td>
      <td align="center" width="100"><strong>
          <font color="#FFFFFF">Xóa</font>
        </strong></td>
    </tr>
    <?php
    $sql3 = "SELECT nhomsanpham.tennhom, loaisanpham.* FROM nhomsanpham, loaisanpham WHERE nhomsanpham.id_nhom = loaisanpham.id_nhom ORDER BY nhomsanpham.id_nhom ASC";
    // echo "$sql3";
    $kq3 = mysqli_query($conn, $sql3);
    $count = 1;
    if (!$kq3) {
      echo "";
    } else {
      while ($r3 = mysqli_fetch_array($kq3)) {
        $id_nhom = $r3["id_nhom"];
        $tennhom = $r3["tennhom"];
        $id_loai = $r3["id_loai"];
        $tenloai = $r3["tenloaisp"];
        ?>
        <tr>
          <td width="50" align="center"
            style="border-left:1px solid #333;border-bottom:1px solid #333; border-right:1px solid #333">
            <?php echo $count++ ?>
          </td>
          <td width="235" height="30" align="left"
            style="border-bottom:1px solid #333; border-right:1px solid #333; padding-left:20px">
            <?php echo "$tennhom"; ?>
          </td>
          <td width="250" align="left" style="border-bottom:1px solid #333; border-right:1px solid #333; padding-left:20px">
            <?php echo "$tenloai"; ?>
          </td>
          <td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
          <a class = "chose" href="?m=mn&amp;b=loaisp-update&idl=<?php echo "$id_loai"; ?>">Sửa</a>
        </td>
          <td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
          <a class = "chose" href="?m=mn&b=loaisp-del&idl=<?php echo "$id_loai"; ?>" onclick="return check()">Xóa</a>
          </td>
        </tr>
        <?php
      }
    }
    ?>
  </table>
</form>