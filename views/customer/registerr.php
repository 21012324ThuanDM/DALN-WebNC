<?php
$act = "";
$hoten = "";
$diachi = "";
$email = "";
$dienthoai = "";
$user = "";
$pass = "";
$apass = "";
$check = 0;

if (isset($_POST["act"])) {
  include "../../models/connect.php";

  $user = $_POST["user"];
  $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');

  $pass = $_POST["pass"];
  $apass = $_POST["apass"];
  if ($user == "") {
    echo "<script>alert('tên tài khoản không được để trống')</script>";
  } else {
    if (strlen($user) < 4)
      echo "<script>alert('Tài khoản phải có ký tự lớn hơn 4')</script>";
    else if (strlen($pass) < 4)
      echo "<script>alert('Mật khẩu phải có độ dài lớn hơn 4')</script>";
    else if ($pass != $apass)
      echo "<script>alert('Mật khẩu nhập lại không trùng')</script>";
    else if ($user == "administrator" || $user == "admin" || $user == "quantrivien" || $user == "Admin" || $user == "Administrator")
      echo "<script>alert('Không được sử dụng tên này để đăng ký')</script>";
    else {
      $sql = "SELECT * FROM thanhvien WHERE user='$user'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) != 0) {
        echo "<script> alert('Tên tài khoản: $user đã có người sử dụng. hãy sử dụng tên khác'); </script>";
      } else {
        $check = 1;
      }
    }
  }


  if ($check == 1) {
    $hoten = $_POST["hoten"];
    $hoten = $hoten = htmlspecialchars($hoten, ENT_QUOTES, 'UTF-8');
    $diachi = $_POST["diachi"];
    $diachi = htmlspecialchars($diachi, ENT_QUOTES, 'UTF-8');
    $email = $_POST["email"];
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $dienthoai = $_POST["dienthoai"];
    $dienthoai = htmlspecialchars($dienthoai, ENT_QUOTES, 'UTF-8');
    $user = $_POST["user"];
    $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');
    $pass = md5($_POST["pass"]); {
      $sql = "INSERT INTO thanhvien(hoten, diachi, email, dienthoai, user, pass, hieuluc, capquyen) VALUES (?, ?, ?, ?, ?, ?, 1, 3)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssss", $hoten, $diachi, $email, $dienthoai, $user, $pass);
      if ($stmt->execute()) {
        echo "<script>alert('Chúc mừng $user! Quý khách đã đăng ký thành công! ');window.location='loginn.php';</script>";
      } else {
        echo "<script>alert('Có lỗi SQL! Nhập lại!');</script>";
      }
      $stmt->close();
    }
  }

}
?>


<div class="bodyLogin">
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    .bodyLogin {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: url('../../assets/customer/images/Background.png') no-repeat;
      background-size: cover;
      background-position: center;
    }

    .login {
      width: 500px;
      background-color: rgb(102, 164, 184);
      height: 400px;
      position: relative;
      border-radius: 20px;
    }

    .signUp {
      width: 500px;
      background-color: rgb(102, 164, 184);
      height: 700px;
      position: relative;
      border-radius: 20px;
    }

    h1 {
      font-family: 'Lora', serif;
      text-align: center;
      margin-bottom: 30px;
    }

    .formLogin {
      margin-top: 40px;
    }

    .input-box {
      width: 100%;
      height: 50px;
      margin-top: 20px;
    }

    .input-box i {
      position: absolute;
      right: 65px;
      margin-top: 12px;
      font-size: 20px;
    }

    .input-box input {
      margin-left: 10%;
      width: 80%;
      height: 46px;
      border-radius: 10px;
      border: none;
      outline: none;
      padding: 10px;
      font-size: 16px;
    }


    .show {
      margin-left: 50px;
      display: flex;
      font-size: 15px;
    }

    .btnLogin {
      width: 130px;
      height: 40px;
      border-radius: 10px;
      outline: none;
      border: none;
      margin-left: 185px;
      margin-top: 20px;
      background-color: aqua;
      font-size: 20px;
      font-weight: 600;
      color: rgb(83, 81, 81);
    }

    .btnLogin:hover {
      background-color: rgb(41, 112, 235);
      color: white;
      cursor: pointer;
    }

    .dk,
    .dn {
      width: 50%;
      margin: 20px 0 0 150px;
    }

    .login {
      display: none;
    }

    .signUp {
      display: block;
    }
  </style>

  <div class="signUp">
    <form class="formLogin" action="" method="POST"
      onSubmit="return thanhvien_insert(user.value,pass.value,apass.value,hoten.value,email.value,diachi.value,dienthoai,anti.value);"
      name="formthanhvien" id="formthanhvien">
      <h1>Đăng ký</h1>
      <div class="input-box">
        <input name="user" type="text" placeholder="Tên tài khoản" value="<?php echo "$user"; ?>" onBlur="process()">
        <i class='bx bx-user'></i>
      </div>
      <div class="input-box">
        <input name="pass" id="pass" type="password" placeholder="Mật khẩu" value="<?php echo "$pass"; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input id="pass" name="apass" type="password" placeholder="Nhập lại mật khẩu" value="<?php echo "$apass"; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input id="pass" name="hoten" type="text" placeholder="Họ tên" value="<?php echo "$hoten"; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input id="pass" name="email" type="text" placeholder="Email" value="<?php echo "$email"; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input id="pass" name="diachi" type="text" placeholder="Địa chỉ" value="<?php echo "$diachi"; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input id="pass" name="dienthoai" type="text" placeholder="Điện thoại" value="<?php echo "$dienthoai"; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button class='btnLogin' name="act" value="Đăng ký" type="submit">Đăng ký</button>
      <div class='dn'>
        <p>Đã có tài khoản? <a href="loginn.php">Đăng nhập</a></p>
      </div>
    </form>
  </div>
</div>