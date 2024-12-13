<style>
  .dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0;
  }
</style>

<div>
  <nav class="navbar fixed-top navbar-expand-lg bg-primary-subtle">

    <div style="width:1200px; margin: auto" class="container-fluid">
      <img style="width: 100%" src="../../assets/customer/images/DH-HOTSALE-1200-44-1200x44.webp">
    </div>
  </nav>


  <nav style="height: 70px; margin-top:50px" class="navbar fixed-top navbar-expand-lg bg-primary-subtle">

    <div style="width:1200px; margin: auto" class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="../../assets/customer/images/Logo.png" alt=""> ABCShop</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>
        <form class="d-flex" role="search" action="?b=tk" method="GET" onsubmit="return tk(text_content.value);">
          <input type="hidden" name="b" value="tk" />
          <input class="form-control me-2" placeholder="Search" aria-label="Search" type="search" name="text_content"
            id="text_content">
          <button class="btn btnNavbar btn-outline-success" type="submit">Tìm kiếm</button>
        </form>

        <button class="btn btnNavbar btn-outline-success" type="button"><a href="index.php?b=showcart">
            <i class="fa-solid fa-cart-shopping"></i><span>Giỏ hàng</span></a>
        </button>

        <?php
        if (isset($_SESSION["success"])) {
          include "login_success.php";
        } else {
          echo '<form class="loginForm" action="../../views/customer/loginn.php" method="POST">';
          echo '<button class="btn btnNavbar btn-outline-success" type="submit"><i class="fa-solid fa-user"></i> Đăng nhập</button>';
          echo '</form>';
        }
        ?>


      </div>
    </div>
  </nav>

  <nav style="height: 30px; top: 120px" class="navbar fixed-top navbar-expand-lg bg-primary-subtle menuu">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul style="width: 1200px; margin: auto" class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          $query = "SELECT * FROM nhomsanpham";
          $result = mysqli_query($conn, $query);

          $count = 0;

          if (mysqli_num_rows($result) > 0) {
            while (($row = mysqli_fetch_assoc($result)) && $count < 10) {
              $id = $row['id_nhom'];
              echo '<li class="nav-item dropdown">';
              echo '<a class="nav-link dropdown-toggle" href="?b=nsp&idn=' . $id . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
              echo '<b>' . $row['tennhom'] . '</b>';
              echo '</a>';
              echo '<ul class="dropdown-menu">';
              $query = 'SELECT * FROM loaisanpham WHERE id_nhom = ' . $row['id_nhom'];
              $result_loai = mysqli_query($conn, $query);

              while ($row_loai = mysqli_fetch_assoc($result_loai)) {
                echo '<li><a class="dropdown-item" href="?b=lsp&idl=' . $row_loai['id_loai'] . '">' . $row_loai['tenloaisp'] . '</a></li>';
              }

              echo '</ul>';
              echo '</li>';
              $count++;
            }
          }
          ?>


        </ul>
      </div>
    </div>
  </nav>

</div>