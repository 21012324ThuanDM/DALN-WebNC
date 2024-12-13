<style>
  table .chose {
    text-decoration: none;
    color: black;
  }

  table .chose:hover {
    color: red;
    font-size: 19px;
  }
</style>

<form method="post" id="frm" name="form">
  <table width="735" height="70" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolordark="#FFFFFF">
    <tr>
      <td style="border:1px solid #CCCCCC;">
        <div align="left"
          style="color: rgb(41, 198, 255); font-family:Tahoma; font-size: 16px; font-weight:bold; padding-left:20px">
          QUẢN LÝ NHÓM VÀ LOẠI
          SẢN PHẨM</div>
      </td>
    </tr>
  </table>

  <table width="735" border="0" cellspacing="0" cellpadding="0">
    <tr height="30" style="background-color: rgb(41, 198, 255);">
      <td align="center" width="50" style="border-left:1px solid #333;border-right:1px solid #333"><strong>
          <font color="#FFFFFF">STT</font>
        </strong></td>
      <td align="center" width="485" style="border-right:1px solid #333"><strong>
          <font color="#FFFFFF">Tên nhóm sản phẩm</font>
        </strong></td>
      <td align="center" width="100" style="border-right:1px solid #333"><strong>
          <font color="#FFFFFF">Sửa</font>
        </strong></td>
      <td align="center" width="100"><strong>
          <font color="#FFFFFF">Xóa</font>
        </strong></td>
    </tr>
    <?php
    $sql3 = "select * from nhomsanpham";
    //echo "$sql3";
    $kq3 = mysqli_query($conn, $sql3);
    $count = 1;
    if (!$kq3)
      echo "";
    else {
      while ($r3 = mysqli_fetch_array($kq3)) {
        $id_nhom = $r3["id_nhom"];
        $tennhom = $r3["tennhom"];
        ?>
        <tr>
          <td width="50" align="center"
            style="border-left:1px solid #333;border-bottom:1px solid #333; border-right:1px solid #333">
            <?php echo $count++ ?>
          </td>
          <td width="485" height="30" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
            <div align="left" style="padding-left:100px"><b>
                <?php echo "$tennhom"; ?>
              </b></div>
          </td>
          <td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
            <a class="chose" href="?m=mn&amp;b=nhomsp-update&amp;idn=<?php echo "$id_nhom"; ?>">Sửa</a>
          </td>
          <td width="100" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
            <a class="chose" href="?m=mn&b=nhomsp-del&idn=<?php echo "$id_nhom"; ?>" onclick="return check()">Xóa</a>
          </td>
        </tr>
        <?php
      }
    }
    ?>

  </table>
</form>