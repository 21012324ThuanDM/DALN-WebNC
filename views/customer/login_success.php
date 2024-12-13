<form class="loginForm" action="../../views/customer/logout.php" method="POST">
    <button class="btn btnNavbar btn-outline-success" type="submit"><i class="fa-solid fa-user"></i>
        <?php echo $_SESSION['user']; ?>
    </button>
    <a href="index.php?b=ttcn" class="btn btnNavbar btn-outline-success"><i class="fa-solid fa-user-circle"></i> Thông
        tin cá nhân</a>
    <button class="btn btnNavbar btn-outline-success" type="submit"><i class="fa-solid fa-sign-out-alt"></i> Đăng
        xuất</button>
</form>