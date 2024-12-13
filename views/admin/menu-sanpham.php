<style>
  .chose {
    text-decoration: none;
    color: black;
    font-weight: bold;
  }

  #back-home {
    text-decoration: none;
    font-size: 17px;
    color: black;
    font-weight: bold;
  }

  .chose:hover {
    color: red;

  }

  .tb-left {
    margin-top: 30px;
    background-color: rgb(41, 198, 255);
    border: 2px solid rgb(41, 198, 255);
  }

  .tb-left tr {
    background-color: white;
  }
</style>

<table class="tb-left" width="215" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="menu" height="30">
      <div align="left" style="color:black; font-family:Tahoma; font-size: 13px; font-weight:bold">QUẢN LÝ SẢN PHẨM:
      </div>
    </td>
  </tr>
  <tr>
    <td height="50" style="padding-left:20px">
      <div align="left">
        <img align="absmiddle" src="../images/towred1-r.gif"><a class="chose"
          href="../admincp/ql-san-pham.php?m=sp&b=sp-insert" class="admin-menu-left"> Thêm sản phẩm mới</a><br>
        <div style="height:10px"></div>
        <img align="absmiddle" src="../images/towred1-r.gif"><a class="chose"
          href="../admincp/ql-san-pham.php?m=sp&b=sp-list" class="admin-menu-left"> Danh sách sản phẩm</a>
      </div>
    </td>
  </tr>

  <tr>
    <td>
      <?php include "include/menu-tree.php"; ?>
    </td>
  </tr>
  <tr>
    <td height="30" style="padding-left:5px; background-color:rgb(151, 222, 255);">
      <a id="back-home" href="home.php">Quay Lại</a>
    </td>
  </tr>
</table>