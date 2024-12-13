<?php
$user = $_SESSION["user"];
$sql = "SELECT * FROM thanhvien WHERE user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $hoten = $row["hoten"];
  $email = $row["email"];
  $diachi = $row["diachi"];
  $dienthoai = $row["dienthoai"];
}
$stmt->close();
?>
<table width="500" cellspacing="0" cellpadding="0" bordercolordark="#FFFFFF"
  style="border:1px solid #CCC;margin-left:320px">
  <tr>
    <td height="35" colspan="2" align="center" class="tieude">
      <div align="center">THÔNG TIN CÁ NHÂN CỦA KHÁCH HÀNG
        <?php echo $user ?>
      </div>
    </td>
  </tr>
  <tr bgcolor="#f9f9f9" onmouseover="style.background='#d4340c'" onmouseout="style.background='#F9F9F9'">
    <td height="35" style="padding-left:70px">
      <div align="left" style="width:120px">Tên đăng nhập:</div>
    </td>
    <td width="405" style="padding-left:15px" align="left">
      <?php echo "$user" ?>
    </td>
  </tr>
  <tr onmouseover="style.background='#d4340c'" onmouseout="style.background='#FFFFFF'">
    <td height="35" style="padding-left:70px">
      <div align="left" style="width:120px">Họ tên:</div>
    </td>
    <td width="405" style="padding-left:15px">
      <?php echo "$hoten"; ?>
    </td>
  </tr>
  <tr bgcolor="#f9f9f9" onmouseover="style.background='#d4340c'" onmouseout="style.background='#F9F9F9'">
    <td height="35" style="padding-left:70px">
      <div align="left" style="width:120px">Email:</div>
    </td>
    <td width="405" style="padding-left:15px">
      <div align="left">
        <?php echo "$email"; ?>
      </div>
    </td>
  </tr>
  <tr onmouseover="style.background='#d4340c'" onmouseout="style.background='#FFFFFF'">
    <td height="35" style="padding-left:70px">
      <div align="left" style="width:120px">Địa chỉ:</div>
    </td>
    <td width="405" style="padding-left:15px">
      <div align="left">
        <?php echo "$diachi"; ?>
      </div>
    </td>
  </tr>
  <tr bgcolor="#f9f9f9" onmouseover="style.background='#d4340c'" onmouseout="style.background='#F9F9F9'">
    <td height="35" style="padding-left:70px">
      <div align="left" style="width:120px">Điện thoại:</div>
    </td>
    <td width="405" style="padding-left:15px">
      <div align="left">
        <?php echo "$dienthoai"; ?>
      </div>
    </td>
  </tr>
  <tr>
    <td height="35" colspan="2" align="center" bgcolor="#d4340c">
      <div align="right" style="padding-right:10px">
        <a href="index.php?b=change" style="padding-right:20px">
          <font color="#FFFFFF">Thay đổi thông tin cá nhân</font>
        </a>
        <a href="index.php?b=cpw">
          <font color="#FFFFFF">Đổi mật khẩu</font>
        </a>
        <input type="hidden" name="act" />
      </div>
    </td>
  </tr>
</table>