<style> 
  .admin-menu-left {
    text-decoration: none;
    color: black;
  }
  #back-home{
    text-decoration: none; 
    font-size: 17px; 
    color: black; 
    font-weight: bold;
  }
  #back-home:hover{
    color: blue;
  }
</style>

<table class ='drop-mn' width="215" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="menu" height="30">
      <div align="left" style="color:#FFF; font-family:Tahoma; font-size: 13px; font-weight:bold">NHÓM &amp; LOẠI SẢN
        PHẨM</div>
    </td>
  </tr>
  <tr>
    <td  height="30" style="padding-left:5px; background-color:rgb(151, 222, 255);">
      <strong> NHÓM SẢN PHẨM</strong>
    </td>
  </tr>
  <tr>
    <td height="60" style="padding-left:5px">
      <div align="left">
        <img align="absmiddle" src="../images/towred1-r.gif"><a href="../admincp/ql-nhom-loai.php?m=mn&b=nhomsp-insert"
          class="admin-menu-left"> Thêm nhóm sản phẩm</a>
        <div style="height:10px"></div>
        <img align="absmiddle" src="../images/towred1-r.gif"><a href="../admincp/ql-nhom-loai.php?m=mn&b=nhomsp-list"
          class="admin-menu-left"> Danh sách nhóm sản phẩm</a>
      </div>
    </td>
  </tr>
  <tr>
    <td height="30" style="padding-left:5px; background-color:rgb(151, 222, 255);">
      <strong> LOẠI SẢN PHẨM</strong>
    </td>
  </tr>
  <tr>
    <td height="50" style="padding-left:5px">
      <div align="left">
        <img align="absmiddle" src="../images/towred1-r.gif"><a href="../admincp/ql-nhom-loai.php?m=mn&b=loaisp-insert"
          class="admin-menu-left"> Thêm loại sản phẩm</a>
        <div style="height:10px"></div>
        <img align="absmiddle" src="../images/towred1-r.gif"><a href="../admincp/ql-nhom-loai.php?m=mn&b=loaisp-list"
          class="admin-menu-left"> Danh sách tất cả loại sản phẩm</a>
      </div>
    </td>
  </tr>
  <tr bgcolor="#ffcc99">
    <td style="padding-left:5px; background-color:rgb(151, 222, 255);" height="25"><strong>LOẠI SẢN PHẨM THEO NHÓM</strong></td>
  </tr>
  <tr>
    <td>
      <?php
      $sql3 = mysqli_query($conn, "select * from nhomsanpham");
      while ($r3 = mysqli_fetch_array($sql3)) {
        $tennhom = $r3["tennhom"];
        $id_nhom = $r3["id_nhom"];
        echo "<tr><td>
		<div style=\"padding-left:20px;\">
		<table border=0 cellspacing=0 cellpadding=0 >
		<tr><td height=30px width=100%>		
		&nbsp;&nbsp;&nbsp;<img src=\"../admincp/img/file_uf.gif\" width=20 height=20 />
		<a style=\"color:#000000\" onMouseOver=\"style.color='#0099CC'\" onMouseOut=\"style.color='#000000'\" href='../admincp/ql-nhom-loai.php?m=mn&b=loaisp-get-list&idn=$id_nhom'>$tennhom</a>
		</td></tr>		
		</table>
		</div></td></tr>";
      }
      ?>
    </td>
  </tr>
  <tr>
  <td  height="30" style="padding-left:5px; background-color:rgb(151, 222, 255);">
      <a id = "back-home" href = "home.php">Quay Lại</a>
    </td>
    </tr>
</table>